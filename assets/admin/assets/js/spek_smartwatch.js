$(document).ready(function () {
	var url_form_tambah = bu + 'admin/tambah_spek_smartwatch_proses';
	var url_form_ubah = bu + 'admin/ubah_spek_smartwatch_proses';
	var url_form = bu + 'admin/tambah_spek_smartwatch_proses';
	var url_form_copy = bu + 'admin/copy_tambah_spek_smartwatch_proses';
	var datatable = $('#tableSpekSmartwatch').DataTable({
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
			url: bu + 'admin/getAllSpeksmartwacth',
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
	$('body').on('click', '.btnCopy', function () {

		var id_spek = $(this).data('id_spek');
		var merk = $(this).data('merk');
		var model = $(this).data('model');
		var screen_size = $(this).data('screen_size');
		var screen_resolution = $(this).data('screen_resolution');
		var network = $(this).data('network');
		var launch = $(this).data('launch');
		var body = $(this).data('body');
		var protection = $(this).data('protection');
		var chipset = $(this).data('chipset');
		var cpu = $(this).data('cpu');
		var memory = $(this).data('memory');
		var ram = $(this).data('ram');
		var has_wifi = $(this).data('has_wifi');
		var has_bluebooth = $(this).data('has_bluebooth');
		var has_gps = $(this).data('has_gps');
		var battery = $(this).data('battery');


		$('#id_spek').val(id_spek);
		$('#merk').val(merk);
		$('#model').val(model);
		$('#screen_size').val(screen_size);
		$('#screen_resolution').val(screen_resolution);
		$('#network').val(network);
		$('#launch').val(launch);
		$('#body').val(body);
		$('#protection').val(protection);
		$('#chipset').val(chipset);
		$('#cpu').val(cpu);
		$('#memory').val(memory);
		$('#ram').val(ram);
		$('#has_wifi').val(has_wifi);
		$('#has_bluebooth').val(has_bluebooth);
		$('#has_gps').val(has_gps);;
		$('#battery').val(battery);

		url_form = url_form_copy;
		$('.modalProdukTitleTambah').hide();
		$('.modalProdukTitleUbah').hide();
		$('.modalProdukTitleCopy').show();
		$('#btnTambah').hide();
		$('#btnUbah').hide();
		$('#btnCopy').show();
		$('#fotoTambah').hide();
		$('#fotoUbah').show();
		$('#modalProduk').modal('show');
		// return false;
	});
	// $('.inputHarga').on('keyup', function() {
	//     // format number
	//     $(this).val(function(index, value) {
	//         return formatHarga(value);
	//     });
	// });
	// $('#stok').on('keyup', function() {
	//     // format number
	//     $(this).val(function(index, value) {
	//         return value
	//             .replace(/\D/g, "");
	//     });
	//     cekStok();
	// });
	// $('#hargaAwal').on('keyup', function() {
	//     cekHargaAwal()
	// });
	// $('#hargaPasaran').on('keyup', function() {
	//     cekHargaPasaran()
	// });
	// $('#kelipatanBid').on('keyup', function() {
	//     cekKelipatanBid()
	// });
	// $('#maksimumBid').on('keyup', function() {
	//     cekMaksimumBid()
	// });
	// // $('.inputJam').timepicker(
	// //     { 'timeFormat': 'H:i:s' }
	// // );
	// $('#tipeBid').on('change', function() {
	//     cekTipeBid()
	// });

	// function getSpek(id = '') {
	//     $.ajax({
	//         url: bu + 'admin/getSpek',
	//         method: 'post',
	//         dataType: 'json',
	//         data: {
	//             idTipeProduk: $('#idTipeProduk option:selected').val(),
	//         },
	//     }).done(function(e) {
	//         console.log(e);
	//         if (e.status) {
	//             var html = '<option value="" selected disabled>Pilih Spesifikasi</option>';
	//             $.each(e.data, function(key, val) {
	//                 html += '<option value="' + val.value + '">' + val.html + '</option>';
	//             });
	//             $('#idSpek').html(html);
	//             setTimeout(() => {
	//                 if (id != '') {
	//                     $('#idSpek').val(id)
	//                 }
	//             }, 100);
	//         } else {
	//             alert('Spek untuk ' + $('#idTipeProduk option:selected').html() + ' belum tersedia!');
	//         }
	//     }).fail(function(e) {
	//         console.log(e);
	//         notifikasi('#alertNotif', 'Terjadi kesalahan!', true);
	//     });
	// }

	// function getGrade(id = '') {
	//     $.ajax({
	//         url: bu + 'admin/getGrade',
	//         method: 'post',
	//         dataType: 'json',
	//         data: {
	//             idTipeProduk: $('#idTipeProduk option:selected').val(),
	//         },
	//     }).done(function(e) {
	//         console.log(e);
	//         if (e.status) {
	//             var html = '<option value="" selected disabled>Pilih Grade</option>';
	//             $.each(e.data, function(key, val) {
	//                 html += '<option value="' + val.value + '">' + val.html + '</option>';
	//             });
	//             $('#grade').html(html);
	//             setTimeout(() => {
	//                 if (id != '') {
	//                     $('#grade').val(id)
	//                 }
	//             }, 100);
	//         } else {
	//             alert('Grade untuk ' + $('#idTipeProduk option:selected').html() + ' belum tersedia!');
	//         }
	//     }).fail(function(e) {
	//         console.log(e);
	//         notifikasi('#alertNotif', 'Terjadi kesalahan!', true);
	//     });
	// }
	// $('#idTipeProduk').on('change', function() {
	//     cekIdTipeProduk();
	//     getSpek();
	//     getGrade();
	// });

	// $('#idSpek').on('change', function() {
	//     cekIdSpek()
	// });

	// $('#grade').on('change', function() {
	//     cekGrade()
	// });

	// $('#judul').on('keyup', function() {
	//     cekJudul()
	// });

	// $('#deskripsi').on('keyup', function() {
	//     cekDeskripsi()
	// });

	// $('#foto').on('change', function() {
	//     cekFoto()
	// });

	$('#btnTambah').on('click', function () {
		// var merk = merk();
		// var _idSpek = cekIdSpek();
		// var _tipeBid = cekTipeBid();
		// var _grade = cekGrade();
		// var _judul = cekJudul();
		// var _deskripsi = cekDeskripsi();
		// var _stok = cekStok();
		// var _hargaAwal = cekHargaAwal();
		// var _hargaPasaran = cekHargaPasaran();
		// var _kelipatanBid = cekKelipatanBid();
		// var _maksimumBid = cekMaksimumBid();
		// var _foto = cekFoto();
		// if (
		//     merk
		// ) {
		//     $("#form").submit();
		// }
		// return false;
	});

	// function merk() {
	// var merk = $('#merk option:selected').val();
	// if (merk == '') {
	//     validasi('#merk', false, 'Silahkan pilih Tipe Produk');
	//     return false;
	// } else {
	//     validasi('#merk', true);
	//     return true;
	//     var merk = $('#merk').val();
	//     if (merk == '') {
	//         validasi('#merk', false, 'Silahkan isi merk');
	//         return false;
	//     } else {
	//         validasi('#merk', true);
	//         return true;
	//     }
	// }

	// function cekIdSpek() {
	//     var idSpek = $('#idSpek option:selected').val();
	//     if (idSpek == '') {
	//         validasi('#idSpek', false, 'Silahkan pilih Spesifikasi Produk');
	//         return false;
	//     } else {
	//         validasi('#idSpek', true);
	//         return true;
	//     }
	// }

	// function cekTipeBid() {
	//     var tipeBid = $('#tipeBid option:selected').val();
	//     if (tipeBid == '') {
	//         validasi('#tipeBid', false, 'Silahkan pilih Tipe Bid');
	//         return false;
	//     } else {
	//         validasi('#tipeBid', true);
	//         return true;
	//     }
	// }

	// function cekGrade() {
	//     var tipeBid = $('#grade option:selected').val();
	//     if (tipeBid == '') {
	//         validasi('#grade', false, 'Silahkan pilih Grade');
	//         return false;
	//     } else {
	//         validasi('#grade', true);
	//         return true;
	//     }
	// }

	// function cekJudul() {
	//     var judul = $('#judul').val();
	//     if (judul == '') {
	//         validasi('#judul', false, 'Silahkan isi Judul');
	//         return false;
	//     } else {
	//         validasi('#judul', true);
	//         return true;
	//     }
	// }

	// function cekDeskripsi() {
	//     var deskripsi = $('#deskripsi').val();
	//     if (deskripsi == '') {
	//         validasi('#deskripsi', false, 'Silahkan isi Deskripsi');
	//         return false;
	//     } else {
	//         validasi('#deskripsi', true);
	//         return true;
	//     }
	// }

	// function cekStok() {
	//     var stok = $('#stok').val();
	//     if (stok == '') {
	//         validasi('#stok', false, 'Silahkan isi stok produk');
	//         return false;
	//     } else {
	//         validasi('#stok', true);
	//         return true;
	//     }
	// }

	// function cekHargaAwal() {
	//     var hargaAwal = $('#hargaAwal').val();
	//     if (hargaAwal == '') {
	//         validasi('#hargaAwal', false, 'Silahkan isi Harga Awal');
	//         $('#hargaAwal')
	//             .parent()
	//             .find('.input-group-text')
	//             .addClass('form-control is-invalid');
	//         return false;
	//     } else {
	//         validasi('#hargaAwal', true);
	//         $('#hargaAwal')
	//             .parent()
	//             .find('.input-group-text')
	//             .removeClass('form-control is-invalid');
	//         return true;
	//     }
	// }

	// function cekHargaPasaran() {
	//     var hargaPasaran = $('#hargaPasaran').val();
	//     if (hargaPasaran == '') {
	//         validasi('#hargaPasaran', false, 'Silahkan isi Harga Pasaran');
	//         $('#hargaPasaran')
	//             .parent()
	//             .find('.input-group-text')
	//             .addClass('form-control is-invalid');
	//         return false;
	//     } else {
	//         validasi('#hargaPasaran', true);
	//         $('#hargaPasaran')
	//             .parent()
	//             .find('.input-group-text')
	//             .removeClass('form-control is-invalid');
	//         return true;
	//     }
	// }

	// function cekKelipatanBid() {
	//     var kelipatanBid = $('#kelipatanBid').val();
	//     if (kelipatanBid == '') {
	//         validasi('#kelipatanBid', false, 'Silahkan isi Harga Pasaran');
	//         $('#kelipatanBid')
	//             .parent()
	//             .find('.input-group-text')
	//             .addClass('form-control is-invalid');
	//         return false;
	//     } else {
	//         validasi('#kelipatanBid', true);
	//         $('#kelipatanBid')
	//             .parent()
	//             .find('.input-group-text')
	//             .removeClass('form-control is-invalid');
	//         return true;
	//     }
	// }

	// function cekMaksimumBid() {
	//     var maksimumBid = $('#maksimumBid').val();
	//     if (maksimumBid == '') {
	//         validasi('#maksimumBid', false, 'Silahkan isi Harga Pasaran');
	//         $('#maksimumBid')
	//             .parent()
	//             .find('.input-group-text')
	//             .addClass('form-control is-invalid');
	//         return false;
	//     } else {
	//         validasi('#maksimumBid', true);
	//         $('#maksimumBid')
	//             .parent()
	//             .find('.input-group-text')
	//             .removeClass('form-control is-invalid');
	//         return true;
	//     }
	// }

	// function cekFoto() {
	//     //get the input and UL list
	//     var input = document.getElementById('foto');
	//     var list = $('#listFoto');

	//     $(list).html('');
	//     //for every file...
	//     var html = '';
	//     for (var x = 0; x < input.files.length; x++) {
	//         html += '<li>#' + (x + 1) + ':  ' + input.files[x].name + '</li>';
	//     }
	//     $(list).append(html);
	//     console.log(input.files.length > 0);
	//     if (input.files.length > 0) {
	//         validasi('#foto', true);
	//         return true;
	//     } else {
	//         validasi('#foto', false, 'Silahkan pilih minimal 1 Foto');
	//         return false;
	//     }
	// }

	// function validasi(id, valid, message = '') {
	//     if (valid) {
	//         $(id)
	//             // .addClass('is-valid')
	//             .removeClass('is-invalid')
	//             .parent()
	//             .find('small')
	//             // .addClass('valid-feedback')
	//             .removeClass('invalid-feedback')
	//             .html(message);
	//     } else {
	//         $(id)
	//             // .removeClass('is-valid')
	//             .addClass('is-invalid')
	//             .parent()
	//             .find('small')
	//             // .removeClass('valid-feedback')
	//             .addClass('invalid-feedback')
	//             .html(message);
	//     }
	// }

	// Button Ubah
	$('body').on('click', '.btnUbah', function () {
		// var id_produk = $(this).data('id_produk');
		var id_spek = $(this).data('id_spek');
		var merk = $(this).data('merk');
		var model = $(this).data('model');
		var screen_size = $(this).data('screen_size');
		var screen_resolution = $(this).data('screen_resolution');
		var network = $(this).data('network');
		var launch = $(this).data('launch');
		var body = $(this).data('body');
		var protection = $(this).data('protection');
		var chipset = $(this).data('chipset');
		var cpu = $(this).data('cpu');
		var memory = $(this).data('memory');
		var memory = $(this).data('memory');
		var ram = $(this).data('ram');
		var has_wifi = $(this).data('has_wifi');
		var has_bluebooth = $(this).data('has_bluebooth');
		var has_gps = $(this).data('has_gps');
		var battery = $(this).data('battery');


		$('#id_spek').val(id_spek);
		$('#merk').val(merk);
		$('#model').val(model);
		$('#screen_size').val(screen_size);
		$('#screen_resolution').val(screen_resolution);
		$('#network').val(network);
		$('#launch').val(launch);
		$('#body').val(body);
		$('#protection').val(protection);
		$('#chipset').val(chipset);
		$('#cpu').val(cpu);
		$('#memory').val(memory);
		$('#ram').val(ram);
		$('#has_wifi').val(has_wifi);
		$('#has_bluebooth').val(has_bluebooth);
		$('#has_gps').val(has_gps);;
		$('#battery').val(battery);

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
				url: bu + 'admin/hapusSpekSmartwatch',
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
