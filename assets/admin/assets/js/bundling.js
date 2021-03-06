$(document).ready(function () {

	$('#deskripsi').summernote({
		  toolbar: [
		// [groupName, [list of button]]
		['style', ['bold', 'italic', 'underline', 'clear']],
		['font', ['strikethrough', 'superscript', 'subscript']],
		['fontsize', ['fontsize']],
		['color', ['color']],
		['para', ['ul', 'ol', 'paragraph']],
		['height', ['height']]
	]
	});
	$('#btnExport').on('click', function () {

		var tipe_produk = $('#dt_filter_produk option:selected').val();
		var status = $('#dt_filter_status option:selected').val();
		// console.log(tipe_produk);return(false);dt_filter_status
		var url = bu + 'Export/master_list_bundling_export/?tipe_produk=' + tipe_produk;
		url += '&status=' + status;

		window.location = url;

		console.log(url);
		return (false);

	});


	$('#idSpek').on('change', function () {
		var id_spek = $('#idSpek option:selected').html();
		var id_spekno = $('#idSpek option:selected').val();
		var id_tipe_produk = $('#idTipeProduk option:selected').val();



		getHarga();

		// console.log(id_spekno);
		$('#judul').val(id_spek);
		return (false);


		// return false;

	});



	var url_form_tambah = bu + 'admin/tambah_bundling_proses';
	var url_form_ubah = bu + 'admin/ubah_bundling_proses';
	var url_form = bu + 'admin/tambah_bundling_proses';
	var url_form_copy = bu + 'admin/copy_tambah_bundling_proses';
	var url_form_tambah_produk = bu + 'admin/tambah_bundling_produk_proses';
	var maxFoto = 5;
	var _draft = 1; //jika 1 maka tampil atau jika 0 maka masuk draft

	var datatable = $('#tableBundling').DataTable({
		'lengthMenu': [
			[5, 10, 25, 50, -1],
			[5, 10, 25, 50, 'All']
		],
		'pageLength': 10,
		"processing": true,
		"language": {
			processing: '....loading<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>loading....<span class="sr-only">Loading...</span> '
		},

		
		"serverSide": true,
		"columnDefs": [{
				"targets": 0,
				"className": "dt-body-center dt-head-center",
				"width": "20px",
				"orderable": false
			},
			{
				"targets": 1,
				"className": "dt-head-center"
			},
			{
				"targets": 2,
				"className": "dt-body-center dt-head-center"
			},
			{
				"targets": 3,
				"className": "dt-body-center dt-head-center"
			},
			{
				"targets": 4,
				"className": "dt-body-center dt-head-center"
			},
			{
				"targets": 5,
				"className": "dt-body-center dt-head-center"
			},
			{
				"targets": 6,
				"className": "dt-body-center dt-head-center"
			},
			{
				"targets": 7,
				"className": "dt-body-center dt-head-center",
				"orderable": false
			},
		],
		"order": [
			[2, "desc"]
		],
		'ajax': {
			url: bu + 'admin/getAllBundling',
			type: 'POST',
			"data": function (d) {
				d.id_tipe_produk = $('#dt_filter_produk').children('option:selected').val();
				d.id_tipe_bid = $('#dt_filter_tipe_bid').children('option:selected').val();
				d.status = $('#dt_filter_status').children('option:selected').val();
				return d;
			}
		},
	});

	$('#btnUbah').on('click', function () {


		// console.log("ini e bua");return(false);
		var _idTipeProduk = cekIdTipeProduk();
		var _judul = cekJudul();
		var _deskripsi = cekDeskripsi();
		var _stok = cekStok();
		var _hargaAwal = cekHargaAwal();
		// var _hargaPasaran = ecekHargaPasaran();
		var _kelipatanBid = cekKelipatanBid();
		var _maksimumBid = cekMaksimumBid();
		var _foto = cekFoto();


		console.log(_idTipeProduk);
		// return(false);


		if (
			_idTipeProduk &&
			_judul && _deskripsi &&
			_hargaAwal &&
			_kelipatanBid && _maksimumBid &&
			_stok && _foto && _draft
		) {
			$("#form").submit();
			// console.log($("#form").submit());
			// return;
			// console.log("draft");
		}
		return false;
	});

	$('#dt_filter_produk').on('change', function () {
		datatable.ajax.reload();
	});
	$('#dt_filter_tipe_bid').on('change', function () {
		datatable.ajax.reload();
	}); // belum
	$('#dt_filter_status').on('change', function () {
		datatable.ajax.reload();
	}); // belum

	$('.btnTambah').on('click', function () {
		url_form = url_form_tambah;
		$('.modalProdukTitleTambah').show();
		$('.modalProdukTitleUbah').hide();
		$('#addsmartphone').show();
		$('#addsmartwatch').hide();
		$('#btnDraft')[0].innerHTML = '<i class="fa fa-bookmark"></i> Draft';
		$('#btnTambah').show();
		$('#btnUbah').hide();
		$('#btnCopy').hide();
		$('#btnTampil').hide();
		$('.modalFotoUbah').hide();
		// $('#fotoTambah').show();
		// $('#fotoUbah').hide();
		$('#listFoto').html('');
		$('#foto_wrapper').html('');

			datatable3s.ajax.reload();


		// $('input').val('');
	});
	// $('#idTipeProduk').on('change', function () {
	// 	cekIdTipeProduk();

	// });

	$('.inputHarga').on('keyup', function () {
		// format number
		$(this).val(function (index, value) {
			return formatHarga(value);
		});
	});
	$('#stok').on('keyup', function () {
		// format number
		$(this).val(function (index, value) {
			return value
				.replace(/\D/g, "");
		});
		cekStok();
	});

	function cekStok() {
		var stok = $('#stok').val();
		if (stok == '') {
			validasi('#stok', false, 'Silahkan isi stok produk');
			return false;
		} else {
			validasi('#stok', true);
			return true;
		}
	}

	function ecekStok() {
		var stok = $('#editjumlah').val();
		if (stok == '') {
			validasi('#editjumlah', false, 'Silahkan isi stok produk');
			return false;
		} else {
			validasi('#editjumlah', true);
			return true;
		}
	}
	$('#hargaAwal').on('keyup', function () {
		cekHargaAwal()
	});
	$('#hargaPasaran').on('keyup', function () {
		cekHargaPasaran()
	});
	$('#kelipatanBid').on('keyup', function () {
		cekKelipatanBid()
	});
	$('#maksimumBid').on('keyup', function () {
		cekMaksimumBid()
	});
	// $('.inputJam').timepicker(
	//     { 'timeFormat': 'H:i:s' }
	// );
	$('#tipeBid').on('change', function () {
		cekTipeBid()
	});

	// function getSpek(id = '') {
	// 	$.ajax({
	// 		url: bu + 'admin/getSpek',
	// 		method: 'post',
	// 		dataType: 'json',
	// 		data: {
	// 			idTipeProduk: $('#idTipeProduk option:selected').val(),
	// 		},
	// 	}).done(function (e) {
	// 		// console.log(e);
	// 		if (e.status) {
	// 			var html = '<option value="" selected disabled>Pilih Spesifikasi</option>';
	// 			$.each(e.data, function (key, val) {
	// 				html += '<option value="' + val.value + '">' + val.html + '</option>';
	// 			});
	// 			$('#idSpek').html(html);
	// 			setTimeout(() => {
	// 				if (id != '') {
	// 					$('#idSpek').val(id)
	// 				}
	// 			}, 100);
	// 		} else {
	// 			alert('Spek untuk ' + $('#idTipeProduk option:selected').html() + ' belum tersedia!');
	// 		}
	// 	}).fail(function (e) {
	// 		console.log(e);
	// 		notifikasi('#alertNotif', 'Terjadi kesalahan!', true);
	// 	});
	// }

	// function getGrade(id = '') {
	// 	$.ajax({
	// 		url: bu + 'admin/getGrade',
	// 		method: 'post',
	// 		dataType: 'json',
	// 		data: {
	// 			idTipeProduk: $('#idTipeProduk option:selected').val(),
	// 		},
	// 	}).done(function (e) {
	// 		console.log(e);
	// 		if (e.status) {
	// 			var html = '<option value="" selected disabled>Pilih Grade</option>';
	// 			$.each(e.data, function (key, val) {
	// 				html += '<option value="' + val.value + '">' + val.html + '</option>';
	// 			});
	// 			$('#grade').html(html);
	// 			setTimeout(() => {
	// 				if (id != '') {
	// 					$('#grade').val(id)
	// 				}
	// 			}, 100);
	// 		} else {
	// 			alert('Grade untuk ' + $('#idTipeProduk option:selected').html() + ' belum tersedia!');
	// 		}
	// 	}).fail(function (e) {
	// 		console.log(e);
	// 		notifikasi('#alertNotif', 'Terjadi kesalahan!', true);
	// 	});
	// }

	function getHarga(id = '') {
		$.ajax({
			url: bu + 'admin/getHarga',
			method: 'post',
			dataType: 'json',
			data: {
				idSpekNo: $('#idSpek option:selected').val(),
			},
		}).done(function (e) {
			// console.log(e);
			// return(false);
			var alert = '';
			$('#hargaAwal').val(e);
		}).fail(function (e) {
			console.log(e);
			// return(false);
			console.log('gagal');
			// $('#judul').val(e.output.message);
			// console.log(e);
			var message = 'Terjadi Kesalahan. #JSMUT12';
		}).always(function () {
			// console.log('selesai');
		});;
		return false;

	}

	function getFoto(id = '') {
		$.ajax({
			url: bu + 'admin/getFotoProdukBundling',
			method: 'post',
			dataType: 'json',
			data: {
				idProduk: id,
			},
		}).done(function (e) {
			// console.log(e);
			if (e.status) {
				var html = '';
				$.each(e.data, function (key, val) {
					maxFoto--;
					html += '' +
						'<div>' +
						'    <span class="fas fa-times hapusFoto" data-id_foto="' + val.id_foto + '"></span>' +
						'    <img class="img-fluid" src="' + bu + 'assets/uploads/bundling/' + val.foto + '" />' +
						'</div>';
				});
				$('#foto_wrapper').html(html);
			} else {
				// alert('Grade untuk ' + $('#idTipeProduk option:selected').html() + ' belum tersedia!');
			}
		}).fail(function (e) {
			console.log(e);
			notifikasi('#alertNotif', 'Terjadi kesalahan!', true);
		});
	}
	$('#idTipeProduk').on('change', function () {
		cekIdTipeProduk();
		var tipe_produk = $('#idTipeProduk option:selected').val();
		console.log(tipe_produk);
		if (tipe_produk == '1') {
			$('#addsmartphone').show();
			$('#addsmartwatch').hide();
		} else {
			$('#addsmartphone').hide();
			$('#addsmartwatch').show();
		}
	});

	function egetFoto(id = '') {
		$.ajax({
			url: bu + 'admin/getFotoProduk',
			method: 'post',
			dataType: 'json',
			data: {
				idProduk: id,
			},
		}).done(function (e) {
			// console.log(e);
			if (e.status) {
				var html = '';
				$.each(e.data, function (key, val) {
					maxFoto--;
					html += '' +
						'<div>' +
						'    <span class="fas fa-times hapusFoto" data-id_foto="' + val.id_foto + '"></span>' +
						'    <img class="img-fluid" src="' + bu + 'assets/uploads/produk/' + val.foto + '" />' +
						'</div>';
				});
				$('#editfoto_wrapper').html(html);
			} else {
				alert('foto masih kosong');
			}
		}).fail(function (e) {
			console.log(e);
			notifikasi('#alertNotif', 'Terjadi kesalahan!', true);
		});
	}

	$('#idSpek').on('change', function () {
		cekIdSpek()
	});

	$('#imei').on('change', function () {
		cekImei()
	});


	$('#grade').on('change', function () {
		cekGrade()
	});

	$('#judul').on('keyup', function () {
		cekJudul()
	});

	$('#deskripsi').on('keyup', function () {
		cekDeskripsi()
	});

	$('#foto').on('change', function () {
		cekFoto()
	});
	$('body').on('click', '.btnDetail', function () {
		var status = $(this).data('status');

		window.location = bu + 'admin/bundling_detail_produk/' + $(this).data('id_tipe_produk') + '/' + $(this).data('id_bundling') + '/' + status;
	});

	// $('#DetailBundlingList').DataTable().destroy(); $('#DetailBundlingList').html('');

	$('#btnTambah').on('click', function () {
		var _idTipeProduk = cekIdTipeProduk();
		var _judul = cekJudul();
		var _deskripsi = cekDeskripsi();
		var _hargaAwal = cekHargaAwal();
		var _kelipatanBid = cekKelipatanBid();
		var _maksimumBid = cekMaksimumBid();
		var _foto = cekFoto();
		
		datatable3s.ajax.reload();

		// console.log(_deskripsi); return(false);
		if (
			_idTipeProduk &&
			_judul && _deskripsi &&
			_hargaAwal &&
			_kelipatanBid && _maksimumBid &&
			_foto
		) {
			$('#draft').val("1");
			$("#form").submit();
		}
		$('#btnTambah').show();
		return false;

	});

	function cekIdTipeProduk() {
		var idTipeProduk = $('#idTipeProduk option:selected').val();
		// console.log(idTipeProduk);return(false);
		if (idTipeProduk == '') {
			validasi('#idTipeProduk', false, 'Silahkan pilih Tipe Produk');
			return false;
		} else {
			validasi('#idTipeProduk', true);
			return true;
		}
	}

	function ecekIdTipeProduk() {
		var idTipeProduk = $('#editidTipeProduk option:selected').val();
		// console.log(idTipeProduk);return(false);
		if (idTipeProduk == '') {
			validasi('#editidTipeProduk', false, 'Silahkan pilih Tipe Produk');
			return false;
		} else {
			validasi('#editidTipeProduk', true);
			return true;
		}
	}

	function cekIdSpek() {
		var idSpek = $('#idSpek option:selected').val();
		if (idSpek == '') {
			validasi('#idSpek', false, 'Silahkan pilih Spesifikasi Produk');
			return false;
		} else {
			validasi('#idSpek', true);
			return true;
		}
	}

	function cekTradein() {

	}

	function cekImei() {
		var imei = $('#imei').val();
		if (imei == '') {
			validasi('#imei', false, 'Silahkan isi imei');
			return false;
		} else {
			validasi('#imei', true);
			return true;
		}
	}

	function cekTipeBid() {
		var tipeBid = $('#tipeBid option:selected').val();
		if (tipeBid == '') {
			validasi('#tipeBid', false, 'Silahkan pilih Tipe Bid');
			return false;
		} else {
			validasi('#tipeBid', true);
			return true;
		}
	}

	function cekGrade() {
		var tipeBid = $('#grade option:selected').val();
		if (tipeBid == '') {
			validasi('#grade', false, 'Silahkan pilih Grade');
			return false;
		} else {
			validasi('#grade', true);
			return true;
		}
	}

	function cekJudul() {
		var judul = $('#judul').val();
		if (judul == '') {
			validasi('#judul', false, 'Silahkan isi Judul');
			return false;
		} else {
			validasi('#judul', true);
			return true;
		}
	}

	function ecekJudul() {
		var judul = $('#editJudul').val();
		if (judul == '') {
			validasi('#editJudul', false, 'Silahkan isi Judul');
			return false;
		} else {
			validasi('#editJudul', true);
			return true;
		}
	}

	function cekDeskripsi() {
		var deskripsi = $('#deskripsi').val();
		if (deskripsi == '') {
			validasi('#deskripsi', false, 'Silahkan isi Deskripsi');
			return false;
		} else {
			validasi('#deskripsi', true);
			return true;
		}
	}

	function ecekDeskripsi() {
		var deskripsi = $('#editdeskripsi').val();
		if (deskripsi == '') {
			validasi('#editdeskripsi', false, 'Silahkan isi Deskripsi');
			return false;
		} else {
			validasi('#editdeskripsi', true);
			return true;
		}
	}

	function cekJumlah() {
		var jumlah = $('#jumlah').val();
		if (jumlah == '') {
			validasi('#jumlah', false, 'Silahkan isi jumlah produk');
			return false;
		} else {
			validasi('#jumlah', true);
			return true;
		}
	}

	function cekHargaAwal() {
		var hargaAwal = $('#hargaAwal').val();
		if (hargaAwal == '') {
			validasi('#hargaAwal', false, 'Silahkan isi Harga Awal');
			$('#hargaAwal')
				.parent()
				.find('.input-group-text')
				.addClass('form-control is-invalid');
			return false;
		} else {
			validasi('#hargaAwal', true);
			$('#hargaAwal')
				.parent()
				.find('.input-group-text')
				.removeClass('form-control is-invalid');
			return true;
		}
	}

	function ecekHargaAwal() {
		var hargaAwal = $('#edithargaAwal').val();
		if (hargaAwal == '') {
			validasi('#edithargaAwal', false, 'Silahkan isi Harga Awal');
			$('#edithargaAwal')
				.parent()
				.find('.input-group-text')
				.addClass('form-control is-invalid');
			return false;
		} else {
			validasi('#edithargaAwal', true);
			$('#edithargaAwal')
				.parent()
				.find('.input-group-text')
				.removeClass('form-control is-invalid');
			return true;
		}
	}

	function cekHargaPasaran() {
		var hargaPasaran = $('#hargaPasaran').val();
		if (hargaPasaran == '') {
			validasi('#hargaPasaran', false, 'Silahkan isi Harga Pasaran');
			$('#hargaPasaran')
				.parent()
				.find('.input-group-text')
				.addClass('form-control is-invalid');
			return false;
		} else {
			validasi('#hargaPasaran', true);
			$('#hargaPasaran')
				.parent()
				.find('.input-group-text')
				.removeClass('form-control is-invalid');
			return true;
		}
	}


	function cekKelipatanBid() {
		var kelipatanBid = $('#kelipatanBid').val();
		if (kelipatanBid == '') {
			validasi('#kelipatanBid', false, 'Silahkan isi Harga Pasaran');
			$('#kelipatanBid')
				.parent()
				.find('.input-group-text')
				.addClass('form-control is-invalid');
			return false;
		} else {
			validasi('#kelipatanBid', true);
			$('#kelipatanBid')
				.parent()
				.find('.input-group-text')
				.removeClass('form-control is-invalid');
			return true;
		}
	}

	function ecekKelipatanBid() {
		var kelipatanBid = $('#editkelipatanBid').val();
		if (kelipatanBid == '') {
			validasi('#editkelipatanBid', false, 'Silahkan isi Harga Pasaran');
			$('#editkelipatanBid')
				.parent()
				.find('.input-group-text')
				.addClass('form-control is-invalid');
			return false;
		} else {
			validasi('#editkelipatanBid', true);
			$('#editkelipatanBid')
				.parent()
				.find('.input-group-text')
				.removeClass('form-control is-invalid');
			return true;
		}
	}

	function cekMaksimumBid() {
		var maksimumBid = $('#maksimumBid').val();
		if (maksimumBid == '') {
			validasi('#maksimumBid', false, 'Silahkan isi Harga Pasaran');
			$('#maksimumBid')
				.parent()
				.find('.input-group-text')
				.addClass('form-control is-invalid');
			return false;
		} else {
			validasi('#maksimumBid', true);
			$('#maksimumBid')
				.parent()
				.find('.input-group-text')
				.removeClass('form-control is-invalid');
			return true;
		}
	}

	function ecekMaksimumBid() {
		var maksimumBid = $('#editmaksimumBid').val();
		if (maksimumBid == '') {
			validasi('#editmaksimumBid', false, 'Silahkan isi Harga Pasaran');
			$('#editmaksimumBid')
				.parent()
				.find('.input-group-text')
				.addClass('form-control is-invalid');
			return false;
		} else {
			validasi('#editmaksimumBid', true);
			$('#editmaksimumBid')
				.parent()
				.find('.input-group-text')
				.removeClass('form-control is-invalid');
			return true;
		}
	}

	function cekFoto() {
		//get the input and UL list
		var input = document.getElementById('foto');
		// var list = $('#listFoto');

		// $(list).html('');
		//for every file...
		var html = '';
		// console.log(input.files);
		if (input.files.length < maxFoto) {
			for (var x = 0; x < input.files.length; x++) {
				// console.log(x, input.files[x].name);
				html += '<li>#' + (x + 1) + ':  ' + input.files[x].name + '</li>';
			}
		}
		// console.log(input.files);
		$('#listFoto').html(html);
		// console.log(maxFoto);
		if (
			(
				(input.files.length > 0 && maxFoto == 5) // jika tambah
				||
				maxFoto != 5 // jika ubah
			) &&
			input.files.length <= maxFoto
		) {
			validasi('#foto', true);
			return true;
		} else if (input.files.length > maxFoto) {
			validasi('#foto', false, 'Silahkan pilih maksimal ' + maxFoto + ' Foto lagi');
			$('#foto').val('');
			return false;
		} else {
			validasi('#foto', false, 'Silahkan pilih minimal 1 Foto');
			$('#foto').val('');
			return false;
		}
	}

	function ecekFoto() {
		//get the input and UL list
		var input = document.getElementById('editfoto');
		// var list = $('#listFoto');

		// $(list).html('');
		//for every file...
		var html = '';
		// console.log(input.files);
		if (input.files.length < maxFoto) {
			for (var x = 0; x < input.files.length; x++) {
				// console.log(x, input.files[x].name);
				html += '<li>#' + (x + 1) + ':  ' + input.files[x].name + '</li>';
			}
		}
		// console.log(input.files);
		$('#editlistFoto').html(html);
		// console.log(maxFoto);
		if (
			(
				(input.files.length > 0 && maxFoto == 5) // jika tambah
				||
				maxFoto != 5 // jika ubah
			) &&
			input.files.length <= maxFoto
		) {
			validasi('#editfoto', true);
			return true;
		} else if (input.files.length > maxFoto) {
			validasi('#editfoto', false, 'Silahkan pilih maksimal ' + maxFoto + ' Foto lagi');
			$('#editfoto').val('');
			return false;
		} else {
			validasi('#editfoto', false, 'Silahkan pilih minimal 1 Foto');
			$('#editfoto').val('');
			return false;
		}
	}

	function validasi(id, valid, message = '') {
		if (valid) {
			$(id)
				// .addClass('is-valid')
				.removeClass('is-invalid')
				.parent()
				.find('small')
				// .addClass('valid-feedback')
				.removeClass('invalid-feedback')
				.html(message);
		} else {
			$(id)
				// .removeClass('is-valid')
				.addClass('is-invalid')
				.parent()
				.find('small')
				// .removeClass('valid-feedback')
				.addClass('invalid-feedback')
				.html(message);
		}
	}

	// Button Ubah
	$('body').on('click', '.btnUbah', function () {
		var id_bundling = $(this).data('id_bundling');
		var id_tipe_produk = $(this).data('id_tipe_produk');
		var status = $(this).data('status');
		var judul = $(this).data('judul');
		var deskripsi = $(this).data('deskripsi');
		var jumlah_produk = $(this).data('jumlah');
		var fullset = $(this).data('fullset');
		var harga_awal = formatHarga($(this).data('harga_awal'));
		var kelipatan_bid = formatHarga($(this).data('kelipatan_bid'));
		var maksimum_bid = formatHarga($(this).data('maksimum_bid'));

		// console.log(fullset);
		// return false;

		$('#id_bundling').val(id_bundling);
		$('#judul').val(judul);
		$('#status').val(status);
		$('#deskripsi').val(deskripsi);
		$('#jumlah_produk').val(jumlah_produk);
		$('#hargaAwal').val(harga_awal);
		$('#kelipatanBid').val(kelipatan_bid);
		$('#maksimumBid').val(maksimum_bid);
		$('#btnDraft')[0].innerHTML = '<i class="fa fa-bookmark"></i> Draft';

		$('#idTipeProduk').val(id_tipe_produk);
		$('#fullset').val(fullset);

		getFoto(id_bundling);

		// datatable3s.ajax.hide();
		// $("#DetailBundlingList").hide()
		$('#DetailBundlingList').parents('div.dataTables_wrapper').first().hide();
		$('#addsmartphone').hide();
		
		// console.log(status);

		url_form = url_form_ubah;
		// console.log(url_form);
		// url_form = url_form_ubah;
		$('#modalProduk').modal('show');
		$('.modalProdukTitleUbah').show();
		$('.modalBundlingTitleTambah').hide();
		$('.modalProdukTitleTambah').hide();


		$('.modalFotoUbah').hide();
		$('#btnTambah').hide();
		$('#btnCopy').hide();


		if (status == 1) {
			$('#btnDraft').show();
			$('#btnTampil').hide();

		} else if (status == 2) {
			$('#btnDraft').hide();
			$('#btnTampil').hide();

		} else {
			$('ebtnDraft').hide();
			$('#btnTampil').show();

		}
		$('#btnUbah').show();


		// $('#btnUbah').show();
		// $('#btnTampil').show();
		// $('#btnDraft').show();
		// $('#fotoTambah').hide();
		// $('#fotoUbah').show();
		// $('#modalBundling').modal('show');
		$('#listFoto').html('');

		// if (
		//     _idTipeProduk && _idSpek &&
		//     _tipeBid && _grade &&
		//     _judul && _deskripsi &&
		//     _hargaAwal && _hargaPasaran &&
		//     _kelipatanBid && _maksimumBid &&
		// 	_stok && _foto && _draft
		// ) {
		//     $('#draft').val("0");
		//     $("#form").submit();
		//     console.log(draft);
		//     // return;
		//     // console.log("draft");
		// }

		// return false;
	});
	$('body').on('click', '.btnCopy', function () {
		var id_produk = $(this).data('id_produk');
		var id_tipe_produk = $(this).data('id_tipe_produk');
		var id_spek = $(this).data('id_spek');
		var id_tipe_bid = $(this).data('id_tipe_bid');
		var id_grade = $(this).data('id_grade');
		var judul = $(this).data('judul');
		var deskripsi = $(this).data('deskripsi');
		var status = $(this).data('status');
		var imei = $(this).data('imei');
		var stok = $(this).data('stok');
		var harga_awal = formatHarga($(this).data('harga_awal'));
		var harga_pasaran = formatHarga($(this).data('harga_pasaran'));
		var kelipatan_bid = formatHarga($(this).data('kelipatan_bid'));
		var maksimum_bid = formatHarga($(this).data('maksimum_bid'));
		var _foto = cekFoto();
		// var _idTipeProduk = cekFoto();

		$('#idProduk').val(id_produk);
		// $('#foto').val(_idTipeProduk);
		$('#judul').val(judul);
		$('#deskripsi').val(deskripsi);
		$('#imei').val("");
		$('#stok').val(stok);
		$('#hargaAwal').val(harga_awal);
		$('#hargaPasaran').val(harga_pasaran);
		$('#kelipatanBid').val(kelipatan_bid);
		$('#maksimumBid').val(maksimum_bid);
		$('#btnDraft')[0].innerHTML = '<i class="fa fa-bookmark"></i> Draft';

		$('#idTipeProduk').val(id_tipe_produk);
		$('#tipeBid').val(id_tipe_bid);
		getSpek(id_spek);
		getGrade(id_grade);
		// getFoto(id_produk);
		console.log(id_produk, judul, harga_awal, stok);

		url_form = url_form_copy;
		// url_form=url_form_tambah;

		$('.modalProdukTitleTambah').hide();
		$('.modalProdukTitleUbah').hide();
		$('.modalProdukTitleCopy').show();
		$('.modalFotoUbah').show();
		$('#btnTambah').hide();
		$('#btnCopy').show();
		$('#btnDraft').show();
		$('#btnUbah').hide();
		$('#btnTampil').hide();
		// $('#fotoTambah').hide();
		// $('#fotoUbah').show();
		$('#modalProduk').modal('show');
		$('#listFoto').html('');



		if (status == 1) {
			$('#btnDraft').show();
			$('#btnTampil').hide();

		} else if (status == 2) {
			$('#btnDraft').hide();
			$('#btnTampil').hide();
			$('#btnUbah').hide();


		} else {
			$('#btnDraft').hide();
			$('#btnTampil').show();

		}
		// return false;
	});
	// $('body').on('click', '.tombolSell', function () {
	// 	var kode_tradein = $(this).data('kode_tradein');
	// 	var imei = $(this).data('imei');
	// 	var harga_jual = formatHarga($(this).data('harga_jual'));
	// 	var grade_jual = $(this).data('grade_jual');
	// 	var merk = $(this).data('merk');
	// 	var storage = $(this).data('storage');
	// 	var model = $(this).data('model');
	// 	// var _idTipeProduk = cekFoto();

	// 	$('#kode_tradein').val(kode_tradein);
	// 	// $('#foto').val(_idTipeProduk);
	// 	$('#imei').val(imei);
	// 	$('#harga_jual').val(harga_jual);
	// 	$('#grade_jual').val(grade_jual);
	// 	$('#merk').val(merk);
	// 	$('#storage').val(storage);
	// 	$('#model').val(model);

	// 	url_form = url_form_tambah_produk;
	// 	// url_form=url_form_tambah;

	// 	$('.modalProdukTitleTambah').hide();
	// 	$('.modalProdukTitleUbah').hide();
	// 	$('.modalProdukTitleCopy').show();
	// 	$('.modalFotoUbah').show();
	// 	$('#btnTambah').hide();
	// 	$('#btnCopy').show();
	// 	$('#btnDraft').show();
	// 	$('#btnUbah').hide();
	// 	$('#btnTampil').hide();
	// 	// $('#fotoTambah').hide();
	// 	// $('#fotoUbah').show();
	// 	$('#modalProduk').modal('show');
	// 	$('#listFoto').html('');



	// 	if (status == 1) {
	// 		$('#btnDraft').show();
	// 		$('#btnTampil').hide();

	// 	} else if (status == 2) {
	// 		$('#btnDraft').hide();
	// 		$('#btnTampil').hide();
	// 		$('#btnUbah').hide();


	// 	} else {
	// 		$('#btnDraft').hide();
	// 		$('#btnTampil').show();

	// 	}
	// 	// return false;
	// });

	// Button Hapus
	$('body').on('click', '.tombolSell', function () {
		var kode_tradein = $(this).data('kode_tradein');
		var imei = $(this).data('imei');
		var harga_jual = formatHarga($(this).data('harga_jual'));
		var grade_jual = $(this).data('grade_jual');
		var merk = $(this).data('merk');
		var storage = $(this).data('storage');
		var model = $(this).data('model');
		var tipe = $(this).data('tipe');


		$.ajax({
			url: bu + 'admin/tambah_bundling_produk_proses',
			dataType: 'json',
			method: 'POST',
			data: {
				kode_tradein: kode_tradein,
				imei: imei,
				harga_jual: harga_jual,
				grade_jual: grade_jual,
				merk: merk,
				storage: storage,
				model: model,
				tipe: tipe,
			}
		}).done(function (e) {
			// console.log(e);
			// console.log("ksksks");
			notifikasi('#alertNotif', e.message, !e.status);
			notifikasi('#alertNotifModalPortal', e.message, !e.status);
			
			datatable3s.ajax.reload();
			datatable.ajax.reload();
		}).fail(function (e) {
			// console.log('gagal');
			// console.log(e);
			var message = 'Terjadi Kesalahan. #JSMP01';
			notifikasi('#alertNotif', message, true);
			console.log("efe");

		});
		return false;
	});

		$('body').on('click', '.btnHapusproduk', function () {
		// console.log("sssssss");
		// return false
		var id_bundling_detail_produk = $(this).data('id_bundling_detail_produk');
		var id_bundling = $(this).data('id_bundling');
		var kode_tradein = $(this).data('kode_tradein');
		var model = $(this).data('model');
		var storage = $(this).data('storage');


		// console.log(kode_tradein,id_bundling,id_bundling_detail_produk);
		// return (false);
		var c = confirm('Apakah anda yakin akan menghapus Produk: "' + model + '/' + storage + '" ?');
		if (c == true) {
			$.ajax({
				url: bu + 'admin/hapusBundlingDetailProduk',
				dataType: 'json',
				method: 'POST',
				data: {
					id_bundling_detail_produk: id_bundling_detail_produk,
					kode_tradein: kode_tradein,

				}
			}).done(function (e) {
				console.log(e);
				notifikasi('#alertNotifModalPortal', e.message, !e.status);

				datatable3s.ajax.reload();
			}).fail(function (e) {
				console.log('gagal');
				console.log(e);
				var message = 'Terjadi Kesalahan. #JSMP02A';
				notifikasi('#alertNotifModalPortal', message, true);
			});
		}
		return false;
	});


	$('body').on('click', '.btnHapus', function () {
		var id_bundling = $(this).data('id_bundling');
		var judul = $(this).data('judul');
		var c = confirm('Apakah anda yakin akan menghapus bundling: "' + judul + '" ?');
		if (c == true) {
			$.ajax({
				url: bu + 'admin/hapusBundling',
				dataType: 'json',
				method: 'POST',
				data: {
					id_bundling: id_bundling
				}
			}).done(function (e) {
				console.log(e);
				notifikasi('#alertNotif', e.message, !e.status);
				datatable.ajax.reload();
			}).fail(function (e) {
				console.log('gagal');
				console.log(e);
				var message = 'Terjadi Kesalahan. #JSMP01';
				notifikasi('#alertNotif', message, true);
			});
		}
		return false;
	});

	$("#modalProduk").on("show", function () {
		$("body").addClass("modal-open");
	}).on("hidden", function () {
		$("body").removeClass("modal-open")
	});

	$("#form").submit(function (e) {
		// console.log('form submitted');
		// return false;

		$.ajax({
			url: url_form,
			method: 'post',
			dataType: 'json',
			data: new FormData(this),
			processData: false,
			contentType: false,
			cache: false,
			async: false,
		}).done(function (e) {
			// console.log(e);
			if (e.status) {
			console.log("ksksks");

				notifikasi('#alertNotif', e.message, false);
				$('#modalProduk').modal('hide');
				datatable.ajax.reload();
				resetForm();
			} else {
				// notifikasiModal('#modalProduk', '#alertNotifModal', e.message, true);
				notifikasiModal('#modalProduk', '#alertNotifModalPortal', e.message, true);
				$.each(e.errorInputs, function (key, val) {
					// console.log(val[0], val[1]);
					validasi(val[0], false, val[1]);
					$(val[0])
						.parent()
						.find('.input-group-text')
						.addClass('form-control is-invalid');
				});
			}
		}).fail(function (e) {
			console.log(e);
			notifikasi('#alertNotifModalPortal', 'Terjadi kesalahan!', true);
			notifikasi('#alertNotif', 'Terjadi kesalahan!', true);
		});
		return false;
	});

	function notifikasiModal(modal, sel, msg, err) {
		var alert_type = 'alert-success ';
		if (err) alert_type = 'alert-danger ';
		var html = '<div class="alert ' + alert_type + ' alert-dismissible show p-4">' + msg + '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
		$(sel).html(html);
		$(modal).animate({
			scrollTop: $(sel).offset().top - 75
		}, 500);
	}

	var id_foto_hapus = [];
	$('body').on('click', '.hapusFoto', function () {
		var id_foto = $(this).data('id_foto');
		$(this).parent().hide();
		id_foto_hapus.push(id_foto);
		$('#idFotoHapus').val(id_foto_hapus);
		maxFoto++;
		console.log(id_foto);
		console.log(id_foto_hapus);
	});

	$('#modalProduk').on('hidden.bs.modal', function () {
		id_foto_hapus = [];
		maxFoto = 5;
		resetForm();
	});

	function resetForm() {
		// console.log('reset');
		$('#alertNotifModal').html('');
		$('#form').trigger('reset');
		validasi('#idTipeProduk', true);
		validasi('#idSpek', true);
		validasi('#tipeBid', true);
		validasi('#grade', true);
		validasi('#judul', true);
		validasi('#deskripsi', true);
		validasi('#stok', true);
		validasi('#hargaAwal', true);
		validasi('#hargaPasaran', true);
		validasi('#kelipatanBid', true);
		validasi('#maksimumBid', true);
		validasi('#foto', true);

	}

	$('#btnDraft').on('click', function () {
		var _idTipeProduk = cekIdTipeProduk();
		var _judul = cekJudul();
		var _deskripsi = cekDeskripsi();
		var _hargaAwal = cekHargaAwal();
		var _kelipatanBid = cekKelipatanBid();
		var _maksimumBid = cekMaksimumBid();
		var _foto = cekFoto();
		// var _imei = cekImei();
		_draft = 1;
		if (
			_idTipeProduk &&
			_judul && _deskripsi &&
			_hargaAwal &&
			_kelipatanBid && _maksimumBid &&
			_foto && _draft
		) {
			$('#draft').val("0");
			$("#form").submit();
			console.log(_draft);
			// return(false);
			// console.log("draft");
		}
		return false;
	});

	$('#btnTambahProduk').on('click', function () {
		$('#modalApiLog').modal('show')
	});

	// $('#btnUbah').on('click', function () {
	// 	var _idTipeProduk = cekIdTipeProduk();

	// 	var _judul = cekJudul();
	// 	var _deskripsi = cekDeskripsi();
	// 	var _jumlahproduk = cekJumlah();
	// 	var _hargaAwal = cekHargaAwal();
	// 	var _kelipatanBid = cekKelipatanBid();
	// 	var _maksimumBid = cekMaksimumBid();
	// 	var _foto = cekFoto();
	// 	// _draft = 1;
	// 	if (
	// 		_idTipeProduk &&
	// 		_judul && _deskripsi &&
	// 		_hargaAwal &&
	// 		_kelipatanBid && _maksimumBid &&
	// 		_jumlahproduk && _foto && _draft
	// 	) {
	// 		$("#form").submit();
	// 		console.log(_foto);
	// 		// return;
	// 		// console.log("draft");
	// 	}
	// 	return false;
	// });
	$('#btnTampil').on('click', function () {
		var _idTipeProduk = cekIdTipeProduk();
		var _idSpek = cekIdSpek();
		var _tipeBid = cekTipeBid();
		var _grade = cekGrade();
		var _judul = cekJudul();
		var _deskripsi = cekDeskripsi();
		var _stok = cekStok();
		var _hargaAwal = cekHargaAwal();
		var _hargaPasaran = cekHargaPasaran();
		var _kelipatanBid = cekKelipatanBid();
		var _maksimumBid = cekMaksimumBid();
		var _foto = cekFoto();
		_draft = 1;
		if (
			_idTipeProduk && _idSpek &&
			_tipeBid && _grade &&
			_judul && _deskripsi &&
			_hargaAwal && _hargaPasaran &&
			_kelipatanBid && _maksimumBid &&
			_stok && _foto && _draft
		) {
			$('#draft').val("1");
			$("#form").submit();
			console.log("tampil");
			// return;
			// console.log("draft");
		}
		return false;
	});
	$('body').on('click', '.btnBidder', function () {



		
		$('#bidderlist').DataTable().destroy();


		
		// console.log($(this).attr('data-id_produk'));
		var id_bundling = $(this).attr('data-id_bundling');
		// $('#btnInvoice').attr('data-id_transaksi', id_transaksi);
		var datatable2 = $('#bidderlist').DataTable({
			'sDom': 'lrtip',
			'lengthMenu': [
				[5, 10, 25, 50, -1],
				[5, 10, 25, 50, 'All']
			],
			'pageLength': 5,
			"processing": true,
			"serverSide": true,
			"columnDefs": [{
					"targets": 0,
					"className": "dt-body-center dt-head-center",
					"orderable": false
				},
				{
					"targets": 1,
					"className": "dt-body-center dt-head-center"
				},
				{
					"targets": 2,
					"className": "dt-body-center dt-head-center",
					"orderable": false
				},
				{
					"targets": 3,
					"className": "dt-body-center dt-head-center"

				},
				{
					"targets": 4,
					"className": "dt-body-center dt-head-center"

				},
			],
			"order": [
				[4, "desc"]
			],
			'ajax': {
				url: bu + 'admin/getBidderBundling',
				type: 'POST',
				type: 'POST',
				"data": function (d) {
					d.id_bundling = id_bundling;
					return d;
				},
			},
		});
		// console.log(id_alamat != '0');
		// return (false);
		// if (id_alamat != '0') {
		// 	loadAlamat(id_user, id_alamat);
		// 	// $('#tabAlamat').remove();
		// 	console.log("tidak nol");

		// 	$('#tabAlamat').show();
		// 	$('#alamat-tab').show();

		// } else if (id_alamat == '0') {
		// 	// $('#tabAlamat').remove();				
		// 	console.log(" nol");
		// 	$('#tabAlamat').hide();
		// 	$('#alamat-tab').hide();
		// }

		// loadDetail(id_produk, id_tipe_produk);
		// loadTransaksi(kode_transaksi, id_transaksi);
		$('#modalDetail').modal('show');
	});
	
	var datatable3s = $('#DetailBundlingList').DataTable({
 

		'lengthMenu': [
			[10, 15, 25, 50, 100],
			[10, 15, 25, 50, 100]
		],
		'pageLength': 10,
		"processing": true,
		"serverSide": true,
		"columnDefs": [{
				"targets": 0,
				"className": "dt-body-center dt-head-center",
				"width": "20px",
				"orderable": false
			},
			{
				"targets": 1,
				"className": "dt-head-center"
			},
			{
				"targets": 2,
				"className": "dt-body-center dt-head-center"
			},
			{
				"targets": 3,
				"className": "dt-body-center dt-head-center"
			},
			{
				"targets": 4,
				"className": "dt-body-center dt-head-center"
			},
			{
				"targets": 5,
				"className": "dt-body-center dt-head-center"
			},
			{
				"targets": 6,
				"className": "dt-body-center dt-head-center"
			},
			{
				"targets": 7,
				"className": "dt-body-center dt-head-center"
			},
			{
				"targets": 8,
				"className": "dt-body-center dt-head-center"
			},
			{
				"targets": 9,
				"className": "dt-body-center dt-head-center",
				"orderable": false
			},
		],
		"order": [
			[2, "asc"]
		],
		'ajax': {
			url: bu + 'admin/getBundlingDetailProdukModal',
			type: 'POST',
			"data": function (d) {
				// d.id_bundling = 76;
				// d.status = $('#dt_filter_status').children('option:selected').val();
				// d.date = $('#datepicker').val();
				// d.selectDate = $('#selectDate option:selected').val();
				// d.id_user = $('#id_user').val();
				// d.status = $('#status').val();
				return d;
			},
		},
	});

});
