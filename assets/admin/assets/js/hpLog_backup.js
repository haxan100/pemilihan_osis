$(document).ready(function () {




	var datatables = $('#tableLogistik').DataTable({
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
			{
				"targets": 5,
				"className": "dt-body-center dt-head-center",
				"orderable": false
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
			{
				"targets": 8,
				"className": "dt-body-center dt-head-center",
				"orderable": false
			}, {
				"targets": 9,
				"className": "dt-body-center dt-head-center",
				"orderable": false
			},
		],
		"order": [
			[1, "asc"]
		],
		'ajax': {
			url: "http://localhost/biz/portalweb/v1/ajax/api-bidding-load-jual-all.php",
			// url: "https://dev.tradeinplus.id/portalweb/v1/ajax/api-bidding-load-jual-all.php",
			// url: "https://portalweb.tradeinplus.id/v1/ajax/api-bidding-load-jual-all.php",
			type: 'POST',
			"data": function (d) {
				d.hash = _hash;
				d.status = $('#selectFilter').children('option:selected').val();
				d.pameran = $('#filterPameran').children('option:selected').val();
				d.market = $('#filterMarket').children('option:selected').val();
				d.date = $('#datepicker').val();
				d.selectDate = $('#selectDate option:selected').val();
				return d;
			}
		},
	});

	var datatablesw = $('#tableLogistikSmartwatch').DataTable({
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
			{
				"targets": 5,
				"className": "dt-body-center dt-head-center",
				"orderable": false
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
			{
				"targets": 8,
				"className": "dt-body-center dt-head-center",
				"orderable": false
			}, {
				"targets": 9,
				"className": "dt-body-center dt-head-center",
				"orderable": false
			},
		],
		"order": [
			[1, "asc"]
		],
		'ajax': {
			url: "http://localhost/biz/portalweb/v1/ajax/api-bidding-load-jual-all.php",
			// url: "https://dev.tradeinplus.id/portalweb/v1/ajax/api-bidding-load-jual-all-smartwatch.php",
			// url: "https://portalweb.tradeinplus.id/v1/ajax/api-bidding-load-jual-all-smartwatch.php",
			type: 'POST',
			"data": function (d) {
				d.hash = _hash;
				d.status = $('#selectFilter').children('option:selected').val();
				d.pameran = $('#filterPameran').children('option:selected').val();
				d.market = $('#filterMarket').children('option:selected').val();
				d.date = $('#datepicker').val();
				d.selectDate = $('#selectDate option:selected').val();
				return d;
			}
		},
	});
	$('body').on('click', '.tombolSell', function () {
		var tipebid = $('#tipebid').val();
		if (tipebid == "1") {

			$('#modalram').hide();
		} else {
			$('#modalram').show();
		}
		var kode_tradein = $(this).data('kode_tradein');
		var imei2 = $(this).data('imei');
		var harga_jual = formatHarga($(this).data('harga_jual'));
		var grade_jual = $(this).data('grade_jual');
		var merk = $(this).data('merk');
		var storage = $(this).data('storage');
		var model = $(this).data('model');
		var tipe = $(this).data('tipe');

		$('#kode_tradein').val(kode_tradein);
		$('#imei2').val(imei2);
		$('#harga_jual').val(harga_jual);
		$('#grade_jual').val(grade_jual);
		$('#merk').val(merk);
		$('#storage').val(storage);
		$('#model').val(model);
		$('#tipe').val(tipe);
		if (tipebid == "1") {

			$('#modalApiLog').hide();
			$('#modalApiLogSmartwatch').hide();
			$('#flag').val("1");
			// $('#judul').val($('#merk').val() + " " + $('#model').val());
			$('#hargaAwal').val($('#harga_jual').val());
			$('#imei').val($('#imei2').val());
			$('#stok').val("1");
		} else {
			$('#modalApiLog').show();
			$('#modalApiLogSmartwatch').show();
		}
		// $('#modalram').hide();

		// $.ajax({
		// 	url: bu + 'admin/tambah_bundling_produk_proses',
		// 	dataType: 'json',
		// 	method: 'POST',
		// 	data: {
		// 		id_bundling: id_bundling,
		// 		kode_tradein: kode_tradein,
		// 		imei: imei,
		// 		harga_jual: harga_jual,
		// 		grade_jual: grade_jual,
		// 		merk: merk,
		// 		storage: storage,
		// 		model: model,
		// 		tipe: tipe,
		// 	}
		// }).done(function (e) {
		// 	// console.log(e);
		// 	notifikasi2('#alertNotifModal', e.message, !e.status);
		// 	datatable.ajax.reload();
		// }).fail(function (e) {
		// 	// console.log('gagal');
		// 	console.log(e);
		// 	var message = 'Terjadi Kesalahan. #JSMP01';
		// 	notifikasi2('#alertNotifModal', message, true);
		// });
		// return false;
	});

	function cekRam() {
		var cekRam = $('#ram').val();
		if (cekRam == '') {
			validasi('#ram', false, 'Silahkan isi Ram');
			return false;
		} else {
			validasi('#ram', true);
			return true;
		}
	}

	$('#tambah').on('click', function () {
		var kode_tradein = $('#kode_tradein').val();
		var imei = $('#imei').val();
		var harga_jual = $('#harga_jual').val();
		var grade_jual = $('#grade_jual').val();
		var merk = $('#merk').val();
		var storage = $('#storage').val();
		var model = $('#model').val();
		var tipe = $('#tipe').val();
		var id_bundling = $('#id_user').val();
		var ram = $('#ram').val() + "GB";

		$.ajax({
			url: bu + 'admin/tambah_bundling_produk_proses',
			dataType: 'json',
			method: 'POST',
			data: {
				id_bundling: id_bundling,
				kode_tradein: kode_tradein,
				imei: imei,
				harga_jual: harga_jual,
				grade_jual: grade_jual,
				merk: merk,
				storage: storage,
				model: model,
				tipe: tipe,
				ram: ram,
			}
		}).done(function (e) {
			// console.log(e);
			notifikasi2('#alertNotifModal', e.message, !e.status);
			// datatable.ajax.reload();
			$('#modalram').hide();
			$('#modalApiLogSmartwatch').hide();
			datatables.ajax.reload();
			datatablesw.ajax.reload();
		}).fail(function (e) {
			// console.log('gagal');
			console.log(e);
			$('#modalram').hide();
			var message = 'Terjadi Kesalahan. #JSMP01';
			notifikasi2('#alertNotifModal', message, true);
		});
		return false;
	});
	// $('#tambah2').on('click', function () {
	// 	// var kode_tradein = $('#kode_tradein').val();
	// 	// var imei = $('#imei').val();
	// 	// var harga_jual = $('#harga_jual').val();
	// 	// var grade_jual = $('#grade_jual').val();
	// 	// var merk = $('#merk').val();
	// 	// var storage = $('#storage').val();
	// 	// var model = $('#model').val();
	// 	// var tipe = $('#tipe').val();
	// 	// var flag = 1;
	// 	$('#flag').val("1");
	// 	$('#judul').val($('#merk').val() + " " + $('#model').val());
	// 	$('#hargaAwal').val($('#harga_jual').val());
	// 	$('#imei').val($('#imei2').val());
	// 	$('#stok').val("1");


	// 	// var flag = $('#flag').val();
	// 	// var ram = $('#flag').val();
	// 	// console.log(ram)

	// 	// $.ajax({
	// 	// 	url: bu + 'admin/tambah_bundling_produk_proses',
	// 	// 	dataType: 'json',
	// 	// 	method: 'POST',
	// 	// 	data: {
	// 	// 		kode_tradein: kode_tradein,
	// 	// 		imei: imei,
	// 	// 		harga_jual: harga_jual,
	// 	// 		grade_jual: grade_jual,
	// 	// 		merk: merk,
	// 	// 		storage: storage,
	// 	// 		model: model,
	// 	// 		tipe: tipe,
	// 	// 		ram: ram,
	// 	// 	}
	// 	// }).done(function (e) {
	// 	// 	// console.log(e);
	// 	// 	notifikasi2('#alertNotifModal', e.message, !e.status);
	// 	// 	// datatable.ajax.reload();
	// 	// 	datatables.ajax.reload();
	// 	// 	datatablesw.ajax.reload();
	// 	// 	$('#modalram').hide();
	// 	// }).fail(function (e) {
	// 	// 	// console.log('gagal');
	// 	// 	console.log(e);
	// 	// 	var message = 'Terjadi Kesalahan. #JSMP01';
	// 	// 	notifikasi2('#alertNotifModal', message, true);

	// 	// });
	// 	// return false;
	// });
});
