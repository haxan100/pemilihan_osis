$(document).ready(function () {
	var url_form_tambah = bu + 'admin/tambah_grade_proses';
	var url_form_ubah = bu + 'admin/ubah_grade_proses';
	var url_form = bu + 'admin/tambah_grade_proses';
	// var url_form_copy = bu + 'admin/copy_tambah_produk_proses';
	var maxFoto = 5;
	var _draft = 1; //jika 1 maka tampil atau jika 0 maka masuk draft

	var datatable = $('#tableProduk').DataTable({
		'lengthMenu': [
			[10, 20, 25, 50, -1],
			[10, 20, 25, 50, 'All']
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
				"orderable": false
			},
		],
		"order": [
			[1, "asc"]
		],
		'ajax': {
			url: bu + 'admin/getAllGrade',
			type: 'POST',
			"data": function (d) {
				d.id_tipe_produk = $('#dt_filter_produk').children('option:selected').val();
				d.id_tipe_bid = $('#dt_filter_tipe_bid').children('option:selected').val();
				d.status = $('#dt_filter_status').children('option:selected').val();
				return d;
			}
		},
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
		$('#btnTambah').show();
		$('#btnUbah').hide();

	});
	// console.log("wdwd")
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


	$('#btnExport').on('click', function() {
		
		var id_tipe_produk = $('#dt_filter_produk option:selected').val();
		var url = bu +'Export/master_list_grade_export/?id_grade='+id_tipe_produk;

		window.location= url;
		// console.log(url);return(false);

		// console.log("d");
		 return(false);
		
	});


	// $('#maksimumBid').on('keyup', function() {
	//     cekMaksimumBid()
	// });
	// $('.inputJam').timepicker(
	//     { 'timeFormat': 'H:i:s' }
	// );
	$('#tipeBid').on('change', function () {
		cekTipeBid()
	});

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
				var html = '<option value="" selected disabled>Pilih Spesifikasi</option>';
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
			console.log(e);
			notifikasi('#alertNotif', 'Terjadi kesalahan!', true);
		});
	}

	function getGrade() {
		$.ajax({
			url: bu + 'admin/getGradeG',
			method: 'post',
			dataType: 'json',
			data: {
				id_grade: $('#id_grade option:selected').val(),
			},
		}).done(function (e) {
			// console.log(e);
			if (e.status) {
				var html = '<option value="" selected disabled>Pilih Grade</option>';
				$.each(e.data, function (key, val) {
					html += '<option value="' + val.value + '">' + val.html + '</option>';
				});
				$('#id_grade').html(html);
				setTimeout(() => {
					if (id != '') {
						$('#id_grade').val(id)
					}
				}, 100);
			} else {
				// alert('Grade untuk ' + $('#idTipeProduk option:selected').html() + ' belum tersedia!');
			}
		}).fail(function (e) {
			console.log(e);
			notifikasi('#alertNotif', 'Terjadi kesalahan!', true);
		});
	}


	$('#idTipeProduk').on('change', function () {
		getSpek();
		getGrade();
	});

	$('#idSpek').on('change', function () {
		cekIdSpek()
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

	$('#btnTambah').on('click', function () {
		url_form = url_form_tambah;
		var _id_grade = cekIdGrade();
		var _grade = cekGrade();
		var _deskripsi = cekDeskripsi();
		var _id_produk = cekidproduk();
		if (
			_id_grade && _id_produk &&
			_grade && _deskripsi
		) {

			$("#form").trigger('submit');
			console.log('btnTambah')

		} else {
			console.log("tes")
		}
		return false;
	});


	function cekidproduk() {
		var id_tipe_produk = $('#id_tipe_produk option:selected').val();
		if (id_tipe_produk == '') {
			validasi('#id_tipe_produk', false, 'Silahkan pilih Spesifikasi Produk');
			return false;
		} else {
			validasi('#id_tipe_produk', true);
			return true;
		}
	}

	function cekIdGrade() {
		var id_grade = $('#id_grade option:selected').val();
		if (id_grade == '') {
			validasi('#id_grade', false, 'Silahkan pilih Spesifikasi Produk');
			return false;
		} else {
			validasi('#id_grade', true);
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
		var tipeBid = $('#grade').val();
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
	// $('#deskripsi').froalaEditor({
	// 	 toolbarButtons: ['fontFamily', '|', 'fontSize', '|', 'paragraphFormat', '|', 'bold', 'italic', 'underline', 'undo', 'redo', 'codeView'],

	//  });
	function cekDeskripsi() {
	var deskripsi = $('#deskripsi').val();
		// var cek = $('#deskripsi').froalaEditor('html.set', 'deskripsi');

		if (deskripsi == '') {
			// validasi('#deskripsi', false, 'Silahkan isi Deskripsi');
			// return false;
			return true;
		} else {
			validasi('#deskripsi', true);
			return true;
		}
	}
	// function cekDeskripsi() {
	// 	var deskripsi = $('#deskripsi').val();
	// 	if (deskripsi == '') {
	// 		validasi('#deskripsi', false, 'Silahkan isi Deskripsi');
	// 		return false;
	// 	} else {
	// 		validasi('#deskripsi', true);
	// 		return true;
	// 	}
	// }


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
		var id_grade = $(this).data('id_grade');
		var grade = $(this).data('grade');
		var id_tipe_produk = $(this).data('id_tipe_produk');
		var deskripsi = $(this).data('deskripsi');
		// console.log('btnUbah');

		$('#id_tipe_produk').val(id_tipe_produk);
		$('#id_grade').val(id_grade);
		$('#grade').val(grade);
		// $('#id_tipe_produk').val(id_tipe_produk);
		// $('#id_nama').val(nama);
		// $('#status').val(status);
		// $('#deskripsi').val(deskripsi);
		
		$("#deskripsi").summernote("code", skripsi)

		url_form = url_form_ubah;
		
		$('.modalProdukTitleTambah').hide();
		$('.modalProdukTitleUbah').show();
		$('#btnTambah').hide();
		$('#btnUbah').show();
		$('#btnCopy').hide();
		$('#btnTampil').hide();
		$('#btnDraft').hide();
		$('#modalProduk').modal('show');
		// return false;
	});

	// Button Hapus
	$('body').on('click', '.btnHapus', function () {
		var id_grade = $(this).data('id_grade');
		var nama = $(this).data('id_nama');
		var grade = $(this).data('grade');
		var c = confirm('Apakah anda yakin akan menghapus Produk: "' + nama + ' ber Grade : ' + grade + '" ?');
		if (c == true) {
			$.ajax({
				url: bu + 'admin/hapusGrade',
				dataType: 'json',
				method: 'POST',
				data: {
					id_grade: id_grade
				}
			}).done(function (e) {
				// console.log(e);
				notifikasi('#alertNotif', e.message, !e.status);
				datatable.ajax.reload();
			}).fail(function (e) {
				// console.log('gagal');
				console.log(e);
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
			console.log(e);
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
		if (
			_idTipeProduk && _idSpek &&
			_tipeBid && _grade &&
			_judul && _deskripsi &&
			_hargaAwal && _hargaPasaran &&
			_kelipatanBid && _maksimumBid &&
			_stok
		) {
			$('#draft').val("1");
			$("#form").submit();
			// console.log(draft);
			// return;
			// console.log("draft");
		}
		return false;
	});
	$('#btnUbah').on('click', function () {
		var _id_grade = cekIdGrade();
		var _grade = cekGrade();
		var _deskripsi = cekDeskripsi();
		var _id_produk = cekidproduk();
		if (
			_id_grade && _id_produk &&
			_grade && _deskripsi
		) {

			$("#form").submit();

		}
		return false;
	});


});
