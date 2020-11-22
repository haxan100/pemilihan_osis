$(document).ready(function() {
    var url_form_tambah = bu + 'admin/tambah_spek_hp_proses';
    var url_form_ubah = bu + 'admin/ubah_spek_hp_proses';
    var url_form = bu + 'admin/tambah_spek_hp_proses';    
	var url_form_copy = bu + 'admin/copy_tambah_spek_hp_proses';

    var datatable = $('#tableSpekHp').DataTable({
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
        "columnDefs": [
            { "targets": 0, "className": "dt-body-center dt-head-center", "width": "20px", "orderable": false },
            { "targets": 1, "className": "dt-head-center" },
            { "targets": 2, "className": "dt-body-center dt-head-center" },
            { "targets": 3, "className": "dt-body-center dt-head-center" },
            { "targets": 4, "className": "dt-body-center dt-head-center" },
			{ "targets": 5, "className": "dt-body-center dt-head-center" },
			// { "targets": 6, "className": "dt-body-center dt-head-center" },
        ],
        "order": [
            [1, "asc"]
        ],
        'ajax': {
            url: bu + 'admin/getAllSpekHp',
            type: 'POST',
        },
    });

    $('.btnTambah').on('click', function() {
        url_form = url_form_tambah;
        $('.modalProdukTitleTambah').show();
        $('.modalProdukTitleUbah').hide();
        $('#btnTambah').show();
        $('#btnUbah').hide();
        $('#fotoTambah').show();
        $('#fotoUbah').hide();
        
		$('.modalProdukTitleCopy').hide();
		$('#btnCopy').hide();

		$('.fotoKTP').hide();
		// $('#fotoUbah').hide();
		$('#listFoto').html('');
		$('#foto_wrapper').html('');
    });

    
	$('body').on('click', '.btnCopy', function () {

        // console.log("hahaha"); return(false);
		var id_spek = $(this).data('id_spek');
		var merk = $(this).data('merk');
		var model = $(this).data('model');
		var screen_size = $(this).data('screen_size');
		var screen_resolution = $(this).data('screen_resolution');
		var back_camera = $(this).data('back_camera');
		var front_camera = $(this).data('front_camera');
		var battery_capacity = $(this).data('battery_capacity');
		var sim = $(this).data('sim');
		var sim_type = $(this).data('sim_type');
		var type = $(this).data('type');
		var micro_sd = $(this).data('micro_sd');
		var os = $(this).data('os');
		var color = $(this).data('color');
		var network = $(this).data('network');
        var wifi = $(this).data('wifi');       
		var ram = $(this).data('ram');
		var storage = $(this).data('storage');
		var processor_speed = $(this).data('processor_speed');
		var gps = $(this).data('gps');
		var has_2g = $(this).data('has_2g');
		var has_3g = $(this).data('has_3g');
		var has_4g = $(this).data('has_4g');
        // var _idTipeProduk = cekFoto();
        
        // console.log(id_spek,merk,model,screen_resolution,screen_size,back_camera,front_camera,battery_capacity,
        //             sim, sim_type,micro_sd,os,color,network,wifi,ram,storage,processor_speed,gps,has_2g,has_3g,has_4g

            
        //     );return(false);

		$('#idProduk').val(id_spek);
		// $('#foto').val(_idTipeProduk);
		$('#merk').val(merk);
		$('#model').val(model);
		$('#screen_size').val(screen_size);
		$('#screen_resolution').val(screen_resolution);
		$('#back_camera').val(back_camera);
        $('#front_camera').val(front_camera);
        
		$('#battery_capacity').val(battery_capacity);
		$('#sim').val(sim);
		$('#sim_type').val(sim_type);
		$('#type').val(type);
		$('#micro_sd').val(micro_sd);
		$('#os').val(os);        
		$('#color').val(color);
		$('#network').val(network);
		$('#wifi').val(wifi);
		$('#ram').val(ram);
		$('#storage').val(storage);
		$('#processor_speed').val(processor_speed);
		$('#gps').val(gps);
		$('#has_2g').val(has_2g);
		$('#has_3g').val(has_3g);
		$('#has_4g').val(has_4g);

		// getSpek(id_spek);
		// getGrade(id_grade);
		// getFoto(id_produk);
		// console.log(id_produk, judul, harga_awal, stok);
		
        // url_form = url_form_copy;
        
        url_form = url_form_copy;
		// url_form=url_form_tambah;
        // $('.modalProdukTitleTambah').show();

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

    $('#btnTambah').on('click', function() {
		// console.log("jjjj");
		// return false;
        var _merk = merk();
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
        if (
            _merk
        ) {
            $("#form").submit();
        }
        // return false;		
			$('#modalProduk').modal('show');
			datatable.ajax.reload();
    });


    function merk() {
    var merk = $('#merk ').val();
    if (merk == '') {
        validasi('#merk', false, 'Silahkan isi merk');
        return false;
    } else {
        validasi('#merk', true);
        return true;
        var merk = $('#merk').val();
        if (merk == '') {
            validasi('#merk', false, 'Silahkan isi merk');
            return false;
        } else {
            validasi('#merk', true);
            return true;
        }
    }
}

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
    $('body').on('click', '.btnUbah', function() {
        // var id_produk = $(this).data('id_produk');
        var id_spek = $(this).data('id_spek');
        var merk = $(this).data('merk');
        var model = $(this).data('model');
        var screen_size = $(this).data('screen_size');
        var screen_resolution = $(this).data('screen_resolution');
        var back_camera = $(this).data('back_camera');
        var front_camera = $(this).data('front_camera');
        var battery_capacity = $(this).data('battery_capacity');
        var sim = $(this).data('sim');
        var sim_type = $(this).data('sim_type');
        var sim_type = $(this).data('sim_type');
        var type = $(this).data('type');
        var micro_sd = $(this).data('micro_sd');
        var os = $(this).data('os');
        var processor_speed = $(this).data('processor_speed');
        var network = $(this).data('network');
        var bluebooth = $(this).data('bluebooth');
        var gps = $(this).data('gps');
        var color = $(this).data('color');
        var ram = $(this).data('ram');
        var wifi = $(this).data('wifi');
        var has_2g = $(this).data('has_2g');
        var has_3g = $(this).data('has_3g');
        var has_4g = $(this).data('has_4g');
        var external_storage = $(this).data('external_storage');
        var storage = $(this).data('storage');
		// console.log(type)

        $('#id_spek').val(id_spek);
        $('#merk').val(merk);
        $('#model').val(model);
        $('#screen_size').val(screen_size);
        $('#screen_resolution').val(screen_resolution);
        $('#back_camera').val(back_camera);
        $('#front_camera').val(front_camera);
        $('#battery_capacity').val(battery_capacity);
        $('#sim').val(sim);
        $('#sim_type').val(sim_type);
        $('#type').val(type);
        $('#micro_sd').val(micro_sd);
        $('#os').val(os);
        $('#processor_speed').val(processor_speed);
        $('#network').val(network);
        $('#bluebooth').val(bluebooth);
        $('#gps').val(gps);
        $('#color').val(color);
        $('#wifi').val(wifi);
        $('#ram').val(ram);
        $('#has_2g').val(has_2g);
        $('#has_3g').val(has_3g);
        $('#has_4g').val(has_4g);
        $('#external_storage').val(external_storage);
        $('#storage').val(storage);
        console.log(model, merk, os);
		getFoto(id_spek);

        url_form = url_form_ubah;
        $('.modalProdukTitleTambah').hide();
        $('.modalProdukTitleUbah').show();
        $('#btnTambah').hide();
        $('#btnUbah').show();
        $('#fotoTambah').hide();
        $('#fotoUbah').show();
        $('#modalProduk').modal('show');        
		$('#btnCopy').hide();        
		$('.modalProdukTitleCopy').hide();

		
			
        // return false;
    });


    // Button Edit User (Simpan)

    // Button Hapus
    $('body').on('click', '.btnHapus', function() {
        var id_spek = $(this).data('id_spek');
        var model = $(this).data('model');
        var c = confirm('Apakah anda yakin akan menghapus Spek: "' + model + '" ?');
        if (c == true) {
            $.ajax({
                url: bu + 'admin/hapusSpekHp',
                dataType: 'json',
                method: 'POST',
                data: {
                    id_spek: id_spek
                }
            }).done(function(e) {
                console.log(e);
                notifikasi('#alertNotif', e.message, !e.status);
                datatable.ajax.reload();
            }).fail(function(e) {
                console.log('gagal');
                console.log(e);
                var message = 'Terjadi Kesalahan. #JSMP02A';
                notifikasi('#alertNotif', message, true);
            });
        }
        return false;
    });

    $("#form").submit(function(e) {
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
        }).done(function(e) {
            // console.log(e);
            if (e.status) {
                notifikasi('#alertNotif', e.message, false);
                $('#modalProduk').modal('hide');
                datatable.ajax.reload();
                $('input').val("");
                // resetForm();
            } else {
                notifikasi('#alertNotifModal', e.message, true);
                $.each(e.errorInputs, function(key, val) {
                    console.log(val[0], val[1]);
                    validasi(val[0], false, val[1]);
                    $(val[0])
                        .parent()
                        .find('.input-group-text')
                        .addClass('form-control is-invalid');
                });
            }
        }).fail(function(e) {
            console.log(e);
            notifikasi('#alertNotif', 'Terjdadi kesalahan!', true);			
			$('#modalProduk').modal('hide');
			datatable.ajax.reload();
			resetForm();
        });
        return false;
	});
	
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

		function getFoto(id_spek = '') {
			var maxFoto = 5;
			$.ajax({
				url: bu + 'admin/getFotoFromSpekHP',
				method: 'post',
				dataType: 'json',
				data: {
					id_spek: id_spek,
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

							'    <img class="img-fluid" src="' + bu + 'assets/uploads/foto_spek_hp/' + val.foto + '" />' +
							'</div>';
					});
					$('#foto_wrapper').html(html);
				} else {
					alert('Grade untuk ' + $('#idTipeProduk option:selected').html() + ' belum tersedia!');
				}
			}).fail(function (e) {
				console.log(e);
				notifikasi('#alertNotif', 'Terjadi kesalahan!', true);
			});
		}



		function resetForm() {
			// console.log('reset');
			$('#alertNotifModal').html('');
			$('#form').trigger('reset');
			// validasi('#idTipeProduk', true);

		}

});
