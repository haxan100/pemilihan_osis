$(document).ready(function () {

	$('.idSpek').selectpicker();
	$('#addsmartphone').hide();
	$('#addsmartwatch').hide();
	


	$('#btnExport').on('click', function () {

		var tipe_produk = $('#dt_filter_produk option:selected').val();
		var tipe_bid = 1;
		var status = $('#dt_filter_status option:selected').val();
		// console.log(tipe_produk);return(false);dt_filter_status
		var url = bu + 'Export/master_list_produk_export/?tipe_produk=' + tipe_produk;
		url += '&tipe_bid=' + tipe_bid;
		url += '&status=' + status;

		window.location = url;

		console.log(url);
		return (false);

	});


	$('#idSpek').on('change', function () {
		var id_spek = $('#idSpek option:selected').html();
		var id_spekno = $('#idSpek option:selected').val();
		var id_tipe_produk = $('#idTipeProduk option:selected').val();
		var from = $('#flag').val();
		// console.log(from);

		if (from != 1) {
			// getHarga();

		}
		getFotoFromMasterFoto();
		// console.log(id_spekno);
		$('#judul').val(id_spek);
		return (false);


		// return false;

	});
	// $(".idSpek").select2();
	$('#grade').on('change', function () {
			getHarga();
			cekGrade();
			var id_tipe_produk = $('#idTipeProduk option:selected').val();
			var id_grade = $('#grade option:selected').html();
			var idSpek =  $('#idSpek option:selected').val();

			// console.log(idSp);return(false);

			$.ajax({
				url: bu + 'admin/getDeskFromGrade',
				dataType: 'json',
				method: 'post',
				data: {
					id_tipe_produk: id_tipe_produk,
					id_grade: id_grade,
					idSpek: idSpek,
				},
			}).done(function (e) {
				// var e = e.data;
				// console.log(e);
				var alert = '';
				// $('#inputIDMarket').val('e');
				// $('#inputIDMarket').val(e);
				// $('#deskripsi').froalaEditor('html.set', e.desk);
				// $('#hargaAwal').val(e.harga);
				// $('#deskripsi').val(e.desk);
				$("#deskripsi").summernote("code", e.desk)
				
				// $('#deskripsi').summernote('pasteHTML', "deskripsi");
				// $('#deskripsi').summernote('val', e.desk);
			}).fail(function (e) {
				// console.log(e);
				// return(false);
				// console.log('gagal');
				// $('#judul').val(e.output.message);
				// console.log(e);
				var message = 'Terjadi Kesalahan. #JSMUT02';
			}).always(function () {
				// console.log('selesai');
			});
			return false;


});



	var url_form_tambah = bu + 'admin/tambah_produk_proses';
	var url_form_ubah = bu + 'admin/ubah_produk_proses';
	var url_form = bu + 'admin/tambah_produk_proses';
	var url_form_copy = bu + 'admin/copy_tambah_produk_proses';
	var maxFoto = 5;
	var _draft = 1; //jika 1 maka tampil atau jika 0 maka masuk draft

	var datatable = $('#tableProduk').DataTable({
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
				"className": "dt-body-center dt-head-center",

			},

			{
				"targets": 5,
				"className": "dt-body-center dt-head-center",
			},
			{
				"targets": 6,
				"className": "dt-body-center dt-head-center",
				"orderable": false
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
			url: bu + 'admin/getAllProduk',
			type: 'POST',
			"data": function (d) {
				d.id_tipe_produk = $('#dt_filter_produk').children('option:selected').val();
				d.id_tipe_bid = $('#dt_filter_tipe_bid').children('option:selected').val();
				d.dt_filter_kelengkapan = $('#dt_filter_kelengkapan').children('option:selected').val();
				d.status = $('#dt_filter_status').children('option:selected').val();
				return d;
			}
		},
	});
	$('#dt_filter_kelengkapan').on('change', function () {
		datatable.ajax.reload();
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
		$('#btnDraft')[0].innerHTML = '<i class="fa fa-bookmark"></i> Draft';
		// $('.btnTambah').show();

		$('#btnTambah').show();
		$('#btnUbah').hide();
		$('#btnCopy').hide();
		$('#btnTampil').hide();
		$('.modalFotoUbah').hide();
		// $('#fotoTambah').show();
		// $('#fotoUbah').hide();
		$('#listFoto').html('');
		$('#foto_wrappers').html('');
		// $('input').val('');
	});

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

	$('#idSpek').select2({
		width: '100%',
		        initSelection: function(element, callback) {
			callback($('#idSpek').val());
			console.log("hghgh")
        }
	});
	// $('#pil_kec').select2({
	// // placeholder: 'please select'
	// });
	// $('#pil_kels').select2({
	// // placeholder: 'please select'
	// });


	function getSpek(id = '') {
		$.ajax({
			url: bu + 'admin/getSpek',
			method: 'post',
			dataType: 'json',
			data: {
				idTipeProduk: $('#idTipeProduk option:selected').val(),
			},
		}).done(function (e) {
			// console.log(e);
			if (e.status) {
				// var html = '<input type="text" placeholder="Search.." id="myInput" onkeyup="filterFunction()"></input>';
				html = '<option value="" selected disabled>Silahkan Pilih Spesifikasi</option>';
				$.each(e.data, function (key, val) {
					html += '<option value="' + val.value + '">' + val.html + '</option>';
				});
				$('#idSpek').html(html);
				setTimeout(() => {
					if (id != '') {
						$('#idSpek').val(id)
					}
				}, 100);
			} else {
				alert('Spek untuk ' + $('#idTipeProduk option:selected').html() + ' belum tersedia!');
			}
		}).fail(function (e) {
			// console.log(e);
			notifikasi('#alertNotif', 'Terjadi kesalahan!', true);
		});
	}

	function getGrade(id = '') {
		var grade = $('#grade_jual').val() ;
		$.ajax({
			url: bu + 'admin/getGrade',
			method: 'post',
			dataType: 'json',
			data: {
				idTipeProduk: $('#idTipeProduk option:selected').val(),
			},
		}).done(function (e) {
			// console.log(e);
			if (e.status) {
				var html = '<option value="" selected disabled>Pilih Grade</option>';
				$.each(e.data, function (key, val) {
					html += '<option value="' + val.value + '">' + val.html + '</option>';
				});
				$('#grade').html(html);
				setTimeout(() => {
					if (id != '') {
						$('#grade').val(id)
					}
				}, 100);
			} else {
				alert('Grade untuk ' + $('#idTipeProduk option:selected').html() + ' belum tersedia!');
			}
		}).fail(function (e) {
			// console.log(e);
			notifikasi('#alertNotif', 'Terjadi kesalahan!', true);
		});
	}

	function getHarga(id = '') {
		var id_grade = $('#grade option:selected').html();
		var id_grades = $('#grade option:selected').val();
		// console.log(id_grade)
		$.ajax({
			url: bu + 'admin/getHarga',
			method: 'post',
			dataType: 'json',
			data: {
				idSpekNo: $('#idSpek option:selected').val(),
				bulan: $('#bulan').val(),
					grade: id_grade,
					id_grade: id_grades,
			},
		}).done(function (e) {
			// alert("kkakak");
			// console.log(e);
			if(e.error){
				
				validasi('#hargaAwal', false, e.msg);
				// notifikasi('#alertNotif', 'Terjadi kesalahan!', true);
				// alert(e.msg);
			}else{

				$('#hargaAwal').val(e.msg);
			}

			// console.log(e);
			// return(false);
			var alert = '';
		}).fail(function (e) {
			// console.log(e);
			// return(false);
			// console.log('gagal');
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
			// console.log(e);

					maxFoto--;
					html += '' +
						'<div>' +
						'    <span class="fas fa-times hapusFoto" data-id_foto="' + val.id_foto + '"></span>' +
						'    <img class="img-fluid" src="' + bu + 'assets/uploads/produk/' + val.foto + '" />' +
						'</div>';
				});
				$('#foto_wrappers').html(html);
			} else {
				alert('Foto untuk ' + $('#idTipeProduk option:selected').html() + ' ini belum tersedia!');
			}
		}).fail(function (e) {
			// console.log(e);
			notifikasi('#alertNotif', 'Terjadi kesalahan!', true);
		});
	}
	$('#idTipeProduk').on('change', function () {


		var idTipeProduk = $('#idTipeProduk option:selected').val();
		var from = $('#from').val();
		// console.log(from);
		if (from == "0") {

			if (idTipeProduk == '1') {
				$('#addsmartphone').show();
				$('#addsmartwatch').hide();
			} else if (idTipeProduk == '2') {
				{
					$('#addsmartphone').hide();
					$('#addsmartwatch').show();
				}
			} else {
				$('#addsmartphone').hide();
				$('#addsmartwatch').hide();
			}
		} else {
			$('#addsmartphone').hide();
			$('#addsmartwatch').hide();
		}
		// ===
		// ===
		// =

		// >>>
		// >>>
		// >
		// 3 c6b00eab1388dbfddcfc5fd738f1aa4129aaefc
		cekIdTipeProduk();
		getSpek();
		getGrade();
	});



	$('#idSpek').on('change', function () {
		
		cekIdSpek()
	});

	$('#imei').on('change', function () {
		cekImei()
	});


	// $('#grade').on('change', function () {
	// 	cekGrade()
	// 	console.log($('#grade_jual').val());
	// });

	$('#judul').on('keyup', function () {
		cekJudul()
	});

	$('#deskripsi').on('keyup', function () {
		cekDeskripsi()
	});

	// $('#foto').on('change', function () {
	// 	cekFoto()
	// });

	$('#btnTambah').on('click', function () {
		var _flag = $('#flag').val();
		var _idSpek = cekIdSpek();
		var _imei = cekImei();
		var _idTipeProduk = cekIdTipeProduk();
		var _id_tipe_bid = $('#id_tipe_bid').val();
		var _grade = cekGrade();
		var _judul = cekJudul();
		var _deskripsi = cekDeskripsi();
		var _stok = cekStok();
		var _hargaAwal = cekHargaAwal();
		var _hargaPasaran = cekHargaPasaran();
		var _kelipatanBid = cekKelipatanBid();
		var _maksimumBid = cekMaksimumBid();
		// var _foto = cekFoto();
		var _kode_tradein = $('#kode_tradein').val();
		var _harga_jual = $('#harga_jual').val();
		var _grade_jual = $('#grade_jual').val();
		var _merk = $('#merk').val();
		var _storage = $('#storage').val();
		var _model = $('#model').val();
		var idFotoSpek = $('#idFotoSpek').val();
		// console.log(_idSpek,_flag,idSpek,_imei,_idTipeProduk,_id_tipe_bid,_grade,_judul,_deskripsi
		// 	,_stok,_hargaAwal,_hargaPasaran,_kelipatanBid,_maksimumBid,_foto,_kode_tradein,_harga_jual
		// 	,_grade_jual,_merk,_model

		// 	);
		// return(false);
		if (
			_idTipeProduk && _idSpek &&
			_id_tipe_bid && _grade &&
			_judul && _deskripsi &&
			_hargaAwal && _hargaPasaran &&
			_kelipatanBid && _maksimumBid &&
			_stok && _imei && _kode_tradein && _harga_jual &&
			_grade_jual && _merk && _model && _storage && _flag

		) {
			// console.log("disini");
			$('#draft').val("1");
			$("#form").submit();
			// $("#form").reset();

		}
		$('#btnTambah').show();
		return false;

	});


	function cekIdTipeProduk() {
		var idTipeProduk = $('#idTipeProduk option:selected').val();
		// console.log(idTipeProduk);

		if (idTipeProduk == '') {
			validasi('#idTipeProduk', false, 'Silahkan pilih Tipe Produk');
			return false;
		} else {
			validasi('#idTipeProduk', true);
			return true;
		}
	}

	function cekIdSpek() {
		var idSpek = $('#idSpek option:selected').val();
		// console.log(idSpek)
		if (idSpek == '') {
			validasi('#idSpek', false, 'Silahkan pilih Spesifikasi Produk');
			return false;
		} else {
			validasi('#idSpek', true);
			return true;
		}
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
		var tipeBid = '1';
		if (tipeBid == '') {
			validasi('#tipeBid', false, 'Silahkan pilih Tipe Bid');
			return false;
		} else {
			validasi('#tipeBid', true);
			return true;
		}
	}

	function cekGrade() {
		var grade = $('#grade').val();

		// console.log(grade);

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
		// 	console.log(judul);
		// console.log(e);
		// return false;
		if (judul == '') {
			validasi('#judul', false, 'Silahkan isi Judul');
			return false;
		} else {
			validasi('#judul', true);
			return true;
		}
	}
	// 	 $('#deskripsi').froalaEditor({
	// 	 toolbarButtons: ['fontFamily', '|', 'fontSize', '|', 'paragraphFormat', '|', 'bold', 'italic', 'underline', 'undo', 'redo', 'codeView'],

	//  });

	function cekDeskripsi() {
	var deskripsi = $('#deskripsi').val();
		// var cek = $('#deskripsi').froalaEditor('html.set', 'deskripsi');

		
		// console.log(cek);
		// console.log(e);
		// return false;

		if (deskripsi == '') {
			// validasi('#deskripsi', false, 'Silahkan isi Deskripsi');
			// return false;
			return true;
		} else {
			validasi('#deskripsi', true);
			return true;
		}
	}

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
			// disini cek fleg itu idFotoSpek
			console.log($('#idFotoSpek').val(''));
			// return (false);

			validasi('#foto', false, 'Silahkan pilih minimals 1 Foto');
			$('#foto').val('');
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
		var id_produk = $(this).data('id_produk');
		var id_tipe_produk = $(this).data('id_tipe_produk');
		var id_spek = $(this).data('id_spek');
		var status = $(this).data('status');
		var id_grade = $(this).data('id_grade');
		var judul = $(this).data('judul');
		var deskripsi = $(this).data('deskripsi');
		var imei = $(this).data('imei');
		var stok = $(this).data('stok');
		var harga_awal = formatHarga($(this).data('harga_awal'));
		var harga_pasaran = formatHarga($(this).data('harga_pasaran'));
		var kelipatan_bid = formatHarga($(this).data('kelipatan_bid'));
		var maksimum_bid = formatHarga($(this).data('maksimum_bid'));
		var flag = $(this).data('flag');
		var from = $(this).data('from');
		var fullset = $(this).data('fullset');
		$('#idSpek').val(id_spek);
		$('#idProduk').val(id_produk);
		$('#judul').val(judul);
		$('#status').val(status);
		// $('#deskripsi').val(deskripsi);
		
		$('#deskripsi').summernote('pasteHTML', deskripsi);
		$('#imei').val(imei);
		$('#flag').val(flag);
		$('#fullset').val(fullset);
		$('#stok').val(stok);
		$('#hargaAwal').val(harga_awal);
		$('#hargaPasaran').val(harga_pasaran);
		$('#kelipatanBid').val(kelipatan_bid);
		$('#maksimumBid').val(maksimum_bid);
		$('#from').val(from);
		// $('#deskripsi').froalaEditor('html.set', deskripsi);	


		$('#btnDraft')[0].innerHTML = '<i class="fa fa-bookmark"></i> Draft';

		$('#idTipeProduk').val(id_tipe_produk);
		if (from == "1") {
			$('#addsmartphone').hide();
			$('#addsmartwatch').hide();
		}

		getSpek(id_spek);

		getGrade(id_grade);
		getFoto(id_produk);

		// console.log(status);

		url_form = url_form_ubah;
		console.log(url_form);
		// url_form = url_form_ubah;
		$('.modalProdukTitleUbah').show();
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
			$('#btnDraft').hide();
			$('#btnTampil').show();

		}
		$('#btnUbah').show();


		// $('#btnUbah').show();
		// $('#btnTampil').show();
		// $('#btnDraft').show();
		// $('#fotoTambah').hide();
		// $('#fotoUbah').show();
		$('#modalProduk').modal('show');
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
		var status = $(this).data('status');
		var id_grade = $(this).data('id_grade');
		var judul = $(this).data('judul');
		var deskripsi = $(this).data('deskripsi');
		var imei = $(this).data('imei');
		var stok = $(this).data('stok');
		var harga_awal = formatHarga($(this).data('harga_awal'));
		var harga_pasaran = formatHarga($(this).data('harga_pasaran'));
		var kelipatan_bid = formatHarga($(this).data('kelipatan_bid'));
		var maksimum_bid = formatHarga($(this).data('maksimum_bid'));
		var flag = $(this).data('flag');
		var fullset = $(this).data('fullset');

		$('#idSpek').val(id_spek);

		$('#idProduk').val(id_produk);
		$('#judul').val(judul);
		$('#status').val(status);
		// $('#deskripsi').val(deskripsi);
		
		$('#deskripsi').summernote('pasteHTML', deskripsi);
		$('#imei').val(imei);
		$('#flag').val(flag);
		$('#fullset').val(fullset);
		$('#stok').val(stok);
		$('#hargaAwal').val(harga_awal);
		$('#hargaPasaran').val(harga_pasaran);
		$('#kelipatanBid').val(kelipatan_bid);
		$('#maksimumBid').val(maksimum_bid);

		$('#btnDraft')[0].innerHTML = '<i class="fa fa-bookmark"></i> Draft';

		$('#idTipeProduk').val(id_tipe_produk);
		
		$('#deskripsi').froalaEditor('html.set', deskripsi);

		getSpek(id_spek);
		getGrade(id_grade);
		getFoto(id_produk);
		// getFoto(id_produk);
		// console.log(id_produk, judul, harga_awal, stok);
		// console.log("lagi disini");

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
		$('body').on('click', '.btnInfo', function () {
		var idProduk = $(this).data('id_produk');
		var harga_awal = $(this).data('harga_awal');
		var judul = $(this).data('judul');
		
			$.ajax({
				url: bu + 'admin/getHargaJualProduk',
				dataType: 'json',
				method: 'POST',
				data: {
					idProduk: idProduk
				}
			}).done(function (e) {
				console.log(e);
				$('#modalDetailTerjual').modal('show');
				$('#namaProd').html(judul)
				$('#HargaAwal').html("Rp." + formatHarga(harga_awal))
				$('#HargaTerjual').html("Rp." + formatHarga(e.data))
			}).fail(function (e) {
				// console.log('gagal');
				console.log(e);
				var message = 'Terjadi Kesalahan. #JSMP01';
				notifikasi('#alertNotif', message, true);
			});
		
		return false;
	});

	// Button Hapus
	$('body').on('click', '.btnHapus', function () {
		var idProduk = $(this).data('id_produk');
		var judul = $(this).data('judul');
		var c = confirm('Apakah anda yakin akan menghapus Produk: "' + judul + '" ?');
		if (c == true) {
			$.ajax({
				url: bu + 'admin/hapusProduk',
				dataType: 'json',
				method: 'POST',
				data: {
					idProduk: idProduk
				}
			}).done(function (e) {
				// console.log(e);
				notifikasi('#alertNotif', e.message, !e.status);
				datatable.ajax.reload();
			}).fail(function (e) {
				// console.log('gagal');
				// console.log(e);
				var message = 'Terjadi Kesalahan. #JSMP01';
				notifikasi('#alertNotif', message, true);
			});
		}
		return false;
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
				notifikasi('#alertNotif', e.message, false);
				$('#modalProduk').modal('hide');
				$('#modalApiLog').modal('hide');
				$('#modalApiLogSmartwatch').modal('hide');
				datatable.ajax.reload();
				resetForm();
			} else {
				notifikasiModal('#modalProduk', '#alertNotifModal', e.message, true);
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
			// console.log(e);
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
		// validasi('#deskripsi', true);
		
		$("#deskripsi").summernote("reset");
		validasi('#stok', true);
		validasi('#hargaAwal', true);
		validasi('#hargaPasaran', true);
		validasi('#kelipatanBid', true);
		validasi('#maksimumBid', true);
		validasi('#foto', true);

	}

	$('#btnDraft').on('click', function () {

		var _flag = $('#flag').val();
		var _idTipeProduk = cekIdTipeProduk();
		var _idSpek = cekIdSpek();
		var _imei = cekImei();
		var _id_tipe_bid = $('#id_tipe_bid').val();
		var _grade = cekGrade();
		var _judul = cekJudul();
		var _deskripsi = cekDeskripsi();
		var _stok = cekStok();
		var _hargaAwal = cekHargaAwal();
		var _hargaPasaran = cekHargaPasaran();
		var _kelipatanBid = cekKelipatanBid();
		var _maksimumBid = cekMaksimumBid();
		var _foto = cekFoto();
		var _kode_tradein = $('#kode_tradein').val();
		var _harga_jual = $('#harga_jual').val();
		var _grade_jual = $('#grade_jual').val();
		var _merk = $('#merk').val();
		var _storage = $('#storage').val();
		var _model = $('#model').val();
		// var _ram = $('#ram').val();
		var _from = $('#from').val();
		var _draft = 1;


		if (
			_idTipeProduk && _idSpek &&
			_id_tipe_bid && _grade &&
			_judul && _deskripsi &&
			_hargaAwal && _hargaPasaran &&
			_kelipatanBid && _maksimumBid &&
			_stok &&
			//  _foto && 
			 _imei && _draft && _from

		) {
			console.log("draft");
			$('#draft').val("0");
			$("#form").submit();
			// console.log("disini");
			// return;
			// console.log("draft");
		}
		return false;
	});

	$('#btnUbah').on('click', function () {


		var _idTipeProduk = cekIdTipeProduk();
		var _idSpek = cekIdSpek();
		var _imei = cekImei();
		var _grade = cekGrade();
		var _judul = cekJudul();
		var _deskripsi = cekDeskripsi();
		var _stok = cekStok();
		var _hargaAwal = cekHargaAwal();
		var _hargaPasaran = cekHargaPasaran();
		var _kelipatanBid = cekKelipatanBid();
		var _maksimumBid = cekMaksimumBid();
		var _foto = cekFoto();
		// 			console.log(_foto);
		// return(false);
		// _draft = 1;
		if (
			_idTipeProduk && _idSpek &&
			_grade && _imei &&
			_judul && _deskripsi &&
			_hargaAwal && _hargaPasaran &&
			_kelipatanBid && _maksimumBid &&
			_stok && _foto && _draft
		) {
			$("#form").submit();
			// console.log(_foto);
			// return;
			// console.log("draft");
		}
		return false;
	});
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
	$('#btnTambahProduk').on('click', function () {
		$('#modalApiLog').modal('show')
	});
	$('#tutup_hp').on('click', function () {
		$('#modalApiLog').modal('hide');
		datatable.ajax.reload();
	});
	$('#tutup_sw').on('click', function () {
		$('#modalApiLogSmartwatch').modal('hide');
		datatable.ajax.reload();
	});
	// $('#btnTambahProduk').on('click', function () {
	// 	$('#modalApiLog').modal('show')
	// });
	// $('#tutup_hp').on('click', function () {
	// 	$('#modalApiLog').modal('hide');
	// 	datatable.ajax.reload();
	// });
	// $('#tutup_sw').on('click', function () {
	// 	$('#modalApiLogSmartwatch').modal('hide');
	// 	datatable.ajax.reload();
	// });
	function getFotoFromMasterFoto(id = '') {
		$.ajax({
			url: bu + 'admin/getFotoFromMasterFoto',
			method: 'post',
			dataType: 'json',
			data: {
				idSpekNo: $('#idSpek option:selected').val(),
			},
		}).done(function (e) {
			// console.log(e);
			// return false;
			var html = '';
			maxFoto--;
			html += '' +
				'<div>' +
				'    <img class="img-fluid" src="' + bu + 'assets/uploads/foto_spek_hp/' + e.data + '" />' +
				'</div>';
			$('#foto_wrappers').html(html);
			$('#foto').html(e.data);
			$('#idFotoSpek').val(1);


		}).fail(function (e) {
			$('#idFotoSpek').val(0);

			// console.log(e);
			maxFoto--;
			html += '' +
				'<div>' +
				'    <img class="img-fluid" src="' + bu + 'assets/uploads/foto_spek_hp/default.jpg" />' +
				'</div>';
			$('#foto_wrappers').html(html);
			$('#foto').html(e.data);
			// notifikasi('#alertNotif', 'Terjadi kesalahan!', true);
		});

	}



	// $("#idSpek").select2();
	$('body').on('click', '.btnBidder', function () {

		$('#bidderlist').DataTable().destroy();

		// console.log($(this).attr('data-id_produk'));
		var id_produk = $(this).attr('data-id_produk');
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
					"orderable": true
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
				url: bu + 'admin/getBidder',
				type: 'POST',
				type: 'POST',
				"data": function (d) {
					d.id_produk = id_produk;
					return d;
				},
			},
		});
		$('#modalDetail').modal('show');
	});




});
