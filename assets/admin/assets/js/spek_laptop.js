$(document).ready(function () {
	var url_form_tambah = bu + 'admin/tambah_spek_laptop_proses';
	var url_form_ubah = bu + 'admin/ubah_spek_laptop_proses';
	var url_form = bu + 'admin/tambah_spek_laptop_proses';
	var url_form_copy = bu + 'admin/copy_tambah_spek_laptop_proses';

	var datatable = $('#tableSpekLaptop').DataTable({
		'lengthMenu': [
			[5, 10, 25, 50, -1],
			[5, 10, 25, 50, 'All']
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
		],
		"order": [
			[1, "asc"]
		],
		'ajax': {
			url: bu + 'admin/getAllSpekLaptop',
			type: 'POST',
		},
	});

	$('.btnTambah').on('click', function () {
		url_form = url_form_tambah;
		$('.modalProdukTitleTambah').show();
		$('.modalProdukTitleUbah').hide();
		$('#btnTambah').show();
		$('#btnUbah').hide();
		$('#fotoTambah').show();
		$('#fotoUbah').hide();
		$('#btnCopy').hide();
	});

	$('#btnTambah').on('click', function () {

	});



	// Button Ubah
	$('body').on('click', '.btnUbah', function () {
		// var id_produk = $(this).data('id_produk');
		var id_spek = $(this).data('id_spek');
		var merk = $(this).data('merk');
		var model = $(this).data('model');
		var tipe_laptop = $(this).data('tipe_laptop');
		var cpu = $(this).data('cpu');
		var processor = $(this).data('processor');
		var gpu = $(this).data('gpu');
		var display = $(this).data('display');
		var ram = $(this).data('ram');
		var storage = $(this).data('storage');
		var network = $(this).data('network');
		var connectivity = $(this).data('connectivity');
		var software = $(this).data('software');
		var size = $(this).data('size');
		var ram = $(this).data('ram');
		var color = $(this).data('color');


		$('#id_spek').val(id_spek);
		$('#merk').val(merk);
		$('#model').val(model);
		$('#tipe_laptop').val(tipe_laptop);
		$('#cpu').val(cpu);
		$('#processor').val(processor);
		$('#gpu').val(gpu);
		$('#display').val(display);
		$('#ram').val(ram);
		$('#storage').val(storage);
		$('#network').val(network);
		$('#connectivity').val(connectivity);
		$('#software').val(software);
		$('#size').val(size);
		$('#ram').val(ram);
		$('#color').val(color);

		url_form = url_form_ubah;
		$('.modalProdukTitleTambah').hide();
		$('.modalProdukTitleUbah').show();
		$('#btnTambah').hide();
		$('#btnUbah').show();
		$('#fotoTambah').hide();
		$('#fotoUbah').show();
		$('#modalProduk').modal('show');
		$('#btnCopy').hide();
		// return false;
	});


	// Button Edit User (Simpan)

	// Button Hapus
	$('body').on('click', '.btnHapus', function () {
		var id_spek = $(this).data('id_spek');
		var model = $(this).data('model');
		var c = confirm('Apakah anda yakin akan menghapus Spek: "' + model + '" ?');
		if (c == true) {
			$.ajax({
				url: bu + 'admin/hapusSpekLaptop',
				dataType: 'json',
				method: 'POST',
				data: {
					id_spek: id_spek
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
	$('body').on('click', '.btnCopy', function () {

		// console.log("hahaha"); return(false);
		var merk = $(this).data('merk');
		var model = $(this).data('model');
		var tipe_laptop = $(this).data('tipe_laptop');
		var cpu = $(this).data('cpu');
		var processor = $(this).data('processor');
		var gpu = $(this).data('gpu');
		var display = $(this).data('display');
		var ram = $(this).data('ram');
		var storage = $(this).data('storage');
		var network = $(this).data('network');
		var connectivity = $(this).data('connectivity');
		var software = $(this).data('software');
		var size = $(this).data('size');
		var ram = $(this).data('ram');
		var color = $(this).data('color');


		$('#merk').val(merk);
		$('#model').val(model);
		$('#tipe_laptop').val(tipe_laptop);
		$('#cpu').val(cpu);
		$('#processor').val(processor);
		$('#gpu').val(gpu);
		$('#display').val(display);
		$('#ram').val(ram);
		$('#storage').val(storage);
		$('#network').val(network);
		$('#connectivity').val(connectivity);
		$('#software').val(software);
		$('#size').val(size);
		$('#ram').val(ram);
		$('#color').val(color);

		url_form = url_form_copy;
		$('.modalProdukTitleTambah').hide();
		$('.modalProdukTitleUbah').hide();
		$('.modalProdukTitleCopy').show();
		$('.modalFotoUbah').show();
		$('#btnTambah').hide();
		$('#btnCopy').show();
		$('#btnUbah').hide();
		$('#btnTampil').hide();
		// $('#fotoTambah').hide();
		// $('#fotoUbah').show();
		$('#modalProduk').modal('show');
		$('#listFoto').html('');
		// return false;
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
				// resetForm();
				$('input').val("");
			} else {
				notifikasi('#alertNotifModal', e.message, true);
				$.each(e.errorInputs, function (key, val) {
					console.log(val[0], val[1]);
					validasi(val[0], false, val[1]);
					$(val[0])
						.parent()
						.find('.input-group-text')
						.addClass('form-control is-invalid');
				});
			}
		}).fail(function (e) {
			console.log(e);
			notifikasi('#alertNotif', 'Terjdadi kesalahan!', true);
		});
		return false;
	});

});
