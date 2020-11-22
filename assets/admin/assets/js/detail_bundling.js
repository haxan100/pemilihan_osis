$(document).ready(function () {
	cekIdTipeProduk();
	var url_form_tambah_produk = bu + 'admin/tambah_bundling_produk_proses';
	var maxFoto = 5;
	var _draft = 1; //jika 1 maka tampil atau jika 0 maka masuk draft

	$('#text-warning').show();
	var datatable = $('#DetailBundlingList').DataTable({

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
			url: bu + 'admin/getBundlingDetailProduk',
			type: 'POST',
			"data": function (d) {
				d.status = $('#dt_filter_status').children('option:selected').val();
				d.date = $('#datepicker').val();
				d.selectDate = $('#selectDate option:selected').val();
				d.id_user = $('#id_user').val();
				d.status = $('#status').val();
				return d;
			},
		},
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
					id_bundling: id_bundling,

				}
			}).done(function (e) {
				console.log(e);
				notifikasi('#alertNotif', e.message, !e.status);
				datatable.ajax.reload();
			}).fail(function (e) {
				console.log('gagal');
				console.log(e);
				var message = 'Terjadi Kesalahan. #JSMP02A';
				notifikasi('#alertNotif', message, true);
			});
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

	function cekIdTipeProduk() {
		// console.log(idTipeProduk);return(false);
		var tipe_produk = $('#tipeproduk').val();
		var status = $('#status').val();
		if (status == '2') {
			$('#addsmartphone').hide();
			$('#addsmartwatch').hide();
		} else {
			if (tipe_produk == '1') {
				$('#addsmartphone').show();
				$('#addsmartwatch').hide();
			} else {
				$('#addsmartphone').hide();
				$('#addsmartwatch').show();
			}
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


	$('body').on('click', '#cancel', function () {
		$('#modalram').hide();
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
		var alert_type = 'alert-warning';
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


});
