$(document).ready(function () {




	var maxFoto = 5;

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
			// url: "http://localhost/biz/portalweb/v1/ajax/api-bidding-load-jual-all.php",
			// url: "https://dev.tradeinplus.id/portalweb/v1/ajax/api-bidding-load-jual-all.php",
			url: "https://portalweb.tradeinplus.id/v1/ajax/api-bidding-load-jual-all.php",
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
			// url: "http://localhost/biz/portalweb/v1/ajax/api-bidding-load-jual-all.php",
			// url: "https://dev.tradeinplus.id/portalweb/v1/ajax/api-bidding-load-jual-all-smartwatch.php",
			url: "https://portalweb.tradeinplus.id/v1/ajax/api-bidding-load-jual-all-smartwatch.php",
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
		var fullset = $(this).data('fullset');
		// console.log(fullset)

		$('#kode_tradein').val(kode_tradein);
		$('#imei2').val(imei2);
		$('#harga_jual').val(harga_jual);
		$('#grade_jual').val(grade_jual);
		$('#merk').val(merk);
		$('#storage').val(storage);
		$('#model').val(model);
		$('#tipe').val(tipe);
		$('#fullset').val(fullset);
		var judulny = merk + " " +model+" ("+storage+")";
		// console.log(merk,"-",model,"-",tipe);

		
		if (tipebid == "1") {
			getGrade();
			getSpekFromPortal();
			// getFotoFromMasterFoto();
			getHargaDariPortal(grade_jual,merk,model,tipe,storage);

			$('#modalApiLog').hide();
			$('#modalApiLogSmartwatch').hide();
			$('#flag').val("1");
			// $('#judul').val($('#merk').val() + " " + $('#model').val());
			// $('#hargaAwal').val($('#harga_jual').val());
			$('#imei').val($('#imei2').val());
			$('#stok').val("1");
			$('#judul').val(judulny);

			$('#grade_jual').val(grade_jual);


			
			// console.log($('#grade_jual').val());
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

		function getHargaDariPortal(grade_jual, merk, model, tipe, storage) {
			
			$.ajax({
				url: bu + 'admin/getHargaDariPortal',
				method: 'post',
				dataType: 'json',
				data: {

					bulan: $('#bulan').val(),
					grade: grade_jual,
					merk: merk,
					model: model,
					tipe: tipe,
					storage: storage,
				},
			}).done(function (e) {
				// alert("kkakak");
				console.log(e);
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



	function getSpekFromPortal(id = '') {
		var merk = $('#merk').val();
		var model = $('#model').val();
		var storage = $('#storage').val();
		var idtipeproduk = $('#idTipeProduk option:selected').val()
		// console.log(merk,model,idtipeproduk);
		
		// return false;
		$.ajax({
			url: bu + 'admin/getSpekDariPortal',
			method: 'post',
			dataType: 'json',
			data: {
				merk:merk,
				model:model,
				storage:storage,
			},
		}).done(function (e) {
			// console.log(e.data);
			// return(false);


			$('#idSpek').val(e.data.value);
			$('#idSpekFromPortal').val(e.data.value);
			// $('#grade').val(e.data.value);
			getFotoFromMasterFoto(e.data.value);

		}).fail(function (e) {
			// console.log(e);
			// notifikasi('#alertNotif', 'Terjadi kesalahan!', true);
			// validasi('#idSpek', false, 'Grade tidak terdapat pada bidding');
			// $('#hargaAwal');

			$('#idSpek').val('idtipeproduk');
			// $('#grade').val('');
						// validasi('#idSpek', false, 'Grade tidak terdapat pada bidding');
		});
	}

	
	function getGrade(id = '') {
		var grade = $('#grade_jual').val() ;
		$.ajax({
			url: bu + 'admin/getGradeDariPortal',
			method: 'post',
			dataType: 'json',
			data: {
				grade
			},
		}).done(function (e) {
			// console.log(e.data.html);console.log(e.data.html);
			// return(false);

			
				// $('#deskripsi').html(e.data.html);
				
				$("#deskripsi").summernote("code",e.data.html)
				$('#grade').val(e.data.value);

		}).fail(function (e) {
			// console.log(e);
			// notifikasi('#alertNotif', 'Terjadi kesalahan!', true);
			// validasi('#grade', false, 'Grade tidak terdapat pada bidding');
			// $('#hargaAwal');
			
			$('#deskripsi').html('');
			$('#grade').val('');
		});
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
		var imei = $('#imei2').val();
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
			notifikasi2('#alertNotifModalPortal', e.message, !e.status);
			
			// datatable.ajax.reload();
			$('#modalram').hide();
			$('#modalApiLogSmartwatch').hide();
			datatables.ajax.reload();
			datatablesw.ajax.reload();
		}).fail(function (e) {
			// console.log('gagal');
			// console.log(e);
			$('#modalram').hide();
			var message = 'Terjadi Kesalahan. #JSMP01';
			notifikasi2('#alertNotifModalPortal', message, true);
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

		function getFotoFromMasterFoto(id = '') {
			// var id = $('#idSpek').val();
			// $('#idSpek').val(e.data.value);
			// console.log(id);
			// return false;
			$.ajax({
				url: bu + 'admin/getFotoFromMasterFoto',
				method: 'post',
				dataType: 'json',
				data: {
					idSpekNo: id,
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

});
