<!-- Content Wrapper. Contains page content -->
<?php
$bu = base_url();
?>
<script src="<?= base_url(); ?>aseets/adminlte/dist/js/sweetalert.js"></script>
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark"><?= $judul ?></h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">Dashboard v1</li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<!-- /.content-header -->
	<!-- Main content -->
	<section class="content">
		<a href="javascript:void(0)" data-toggle="modal" data-target="#modal-detail" class="btn m-t-18 btn-info waves-effect waves-light btnTambah">
			<i class="ti-plus"></i> Tambah Admin Baru
		</a>
		<span class="col-lg-2 col-md-3 col-sm-6 col-xs-12 px-0 my-1">
			<a class="btn m-t-20 btn-info waves-effect waves-light" href="" id="btnExport"> <i class="fas fa-download"></i> EXPORT </a>
		</span>
		<br>
		<?php if ($this->session->flashdata()) : ?>
			<div class="container-fluid">
				<div class="alert alert-success alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<?= $this->session->flashdata('flash_data') ?>
				</div>
			</div>
		<?php endif ?>


		<div class="card">
			<div class="card-header">
			</div>
			<!-- /.card-header -->
			<div class="card-body">
				<table id="example1" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>No</th>
							<th>Nama</th>
							<th>Username</th>
							<th>No Telpon</th>
							<th>Role</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
				</table>
			</div>
			<!-- /.card-body -->
		</div>
		<!-- Modal Add Category -->
		<div class="modal fade bs-example-modal-lg" id="modal-detail" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<form id="form">
					<div class="modal-content">

						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
							</button>
						</div>
						<div class="modal-body">
							<h4>Detail User</h4>

							<div class="row">
								<div class="col-md-12 col-sm-12 ">
									<div class="x_panel">

										<div class="x_content">
											<br />
											<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
												<div class="row">
													<input id="id" name="id" class="form-control " readonly type="hidden" readonly class="form-control">


												</div>
												<div class="row">

													<div class="item form-group col-md-6 col-sm-6">
														<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name"> Nama <span class="required">*</span>
														</label>
														<div class="">
															<input id="nama" name="nama" class="form-control " placeholder="Isikan Nama" type="text" class="form-control">
														</div>
													</div>

													<div class="item form-group col-md-6 col-sm-6 ">
														<label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Admin <span class="required">*</span>
														</label>
														<div class="">
															<select class="form-control " name="role" id="role">
																<option value="default" desable>Pilih Role</option>
																<option value="0">Admin</option>
																<option value="1">Master Admin</option>
															</select>
														</div>
													</div>
												</div>

												<div class="row">
													<div class="item form-group col-md-6 col-sm-6 ">
														<label class="col-form-label label-align" for="last-name">Username <span class="required">*</span>
														</label>
														<div class="">
															<input id="username" name="username" class="form-control " placeholder="Isikan Username" type="text" class="form-control">
														</div>
													</div>
													<div class="item form-group col-md-6 col-sm-6 ">
														<label class="col-form-label label-align" for="last-name">Password <span class="required">*</span>
														</label>
														<div class="">
															<input id="password" name="password" class="form-control " placeholder="Isikan Password" type="text" class="form-control">

														</div>
													</div>
												</div>

												<div class="row">


													<div class="item form-group col-md-12 col-sm-12 ">
														<label class="col-form-label label-align" for="last-name">No Hp <span class="required">*</span>
														</label>
														<div class="">
															<input id="noHP" name="noHP" class="form-control " placeholder="Isikan No HP" type="text" class="form-control">

														</div>
													</div>

												</div>
												<div class="ln_solid"></div>
												<div class="item form-group">
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							<button type="button" class="btn btn-primary" id="Edit">Save changes</button>

							<button type="button" class="btn btn-success" id="tambah_act">Tambah</button>
						</div>
					</div>
				</form>

			</div>
		</div>
	</section>
	<!-- /.content -->
</div>
<!-- DataTables CSS -->


<script>
	$(document).ready(function() {

		var bu = '<?= base_url(); ?>';

		var url_form_tambah = bu + 'admin/tambah_admin_proses';
		var url_form_ubah = bu + 'admin/ubah_admin_proses';
		var datatable = $('#example1').DataTable({
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
			],
			"order": [
				[2, "desc"]
			],
			'ajax': {
				url: bu + 'admin/getAllAdmin',
				type: 'POST',
				"data": function(d) {
					return d;
				}
			},
		});

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

		function notifikasiModal(modal, sel, msg, err) {
			var alert_type = 'alert-success ';
			if (err) alert_type = 'alert-danger ';
			var html = '<div class="alert ' + alert_type + ' alert-dismissible show p-4">' + msg + '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
			$(sel).html(html);
			$(modal).animate({
				scrollTop: $(sel).offset().top - 75
			}, 500);
		}

		function cekNama() {
			var nama = $('#nama').val();
			console.log(nama);
			if (nama == '') {
				validasi('#nama', false, 'Silahkan Isi Nama');
				return false;
			} else {
				validasi('#nama', true);
				return true;
			}
		}

		function cekNIS() {
			var nis = $('#nis').val();
			console.log(nis);

			if (nis == '') {
				validasi('#nis', false, 'Silahkan Isi NIS');
				return false;
			} else {
				validasi('#nis', true);
				return true;
			}
		}

		function cekKelas() {
			var kelas = $('#kelas option:selected').val();
			console.log(kelas);

			if (kelas == '') {
				validasi('#kelas', false, 'Silahkan Isi kelas');
				return false;
			} else {
				validasi('#kelas', true);
				return true;
			}
		}

		function cekJenKel() {
			var jen_kel = $('#jen_kel option:selected').val();
			console.log(jen_kel);

			if (jen_kel == '') {
				validasi('#jen_kel', false, 'Silahkan Isi jen_kel');
				return false;
			} else {
				validasi('#jen_kel', true);
				return true;
			}
		}

		function cektanggal_lahir() {
			var tanggal_lahir = $('#tanggal_lahir').val();
			console.log(tanggal_lahir);

			if (tanggal_lahir == '') {
				validasi('#tanggal_lahir', false, 'Silahkan Isi tanggal_lahir');
				return false;
			} else {
				validasi('#tanggal_lahir', true);
				return true;
			}
		}

		function cekAlamat() {
			var alamat = $('#alamat').val();
			console.log(alamat);

			if (alamat == '') {
				validasi('#alamat', false, 'Silahkan Isi Alamat');
				return false;
			} else {
				validasi('#alamat', true);
				return true;
			}
		}
		$('#tambah_act').on('click', function() {

			var nama = $('#nama').val();
			var role = $('#role').val();
			var noHP = $('#noHP').val();
			var user_name = $('#username').val();
			var password = $('#password').val();
			if (nama == '') {
				Swal.fire({
					icon: 'error',
					title: 'Oops...',
					text: 'masukan Nama!',
				})
				return false;
			}
			if (noHP == '') {
				Swal.fire({
					icon: 'error',
					title: 'Oops...',
					text: 'masukan No HP!',
				});
				return false;
			}
			if (user_name == '') {
				Swal.fire({
					icon: 'error',
					title: 'Oops...',
					text: 'masukan Username',
				});
				return false;
			}
			if (password == '') {
				Swal.fire({
					icon: 'error',
					title: 'Oops...',
					text: ' Masukan password!',
				});
				return false;
			} else {
				$("#form").submit();
			}
			// return false;
		});
		$('#btnTambah').on('click', function() {


			var _cekNama = cekNama();
			var _cekNIS = cekNIS();
			var _cekKelas = cekKelas();
			var _cektanggal_lahir = cektanggal_lahir();
			var _JenKel = cekJenKel();
			var _Alamat = cekAlamat();
			// console.log(_cekKelas , _cekNama, _cekNIS,_cektanggal_lahir,_JenKel,_Alamat);return false;

			if (
				_cekKelas && _cekNIS && _cekNama && _cektanggal_lahir && _Alamat && _JenKel
			) {
				return false;

				$("#form").submit();
			}
			$('#btnTambah').show();
			return false;

		});

		function notifikasi(sel, msg, err) {
			var alert_type = 'alert-success ';
			if (err) alert_type = 'alert-danger ';
			var html = '<div class="alert ' + alert_type + ' alert-dismissible show p-4">' + msg + '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
			$(sel).html(html);
			$('html, body').animate({
				// scrollTop: $(sel).offset().top - 75
			}, 500);
		}

		$('.btnTambah').on('click', function() {
			url_form = url_form_tambah;
			// url_form = url_form_tambah;
			// console.log(url_form);
			console.log("s")
			$("#tambah_act").show();

			$('#Edit').hide();
			$('.modalProdukTitleTambah').show();
			$('.modalProdukTitleUbah').hide();

			$('#btnTambah').show();
			$('#btnUbah').hide();
			$('#btnCopy').hide();
			$('#btnTampil').hide();
			$('.modalFotoUbah').hide();
			$('#listFoto').html('');
			$('#foto_wrappers').html('');
		});

		$("#form").submit(function(e) {
			console.log('form submitted');
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
				console.log(e);
				// return false
				if (e.status) {
					notifikasi('#alertNotif', e.message, false);
					$('#modal-detail').modal('hide');
					datatable.ajax.reload();
					Swal.fire(
						':)',
						e.message,
						'success'
					);
				} else {
					notifikasiModal('#modalProduk', '#alertNotifModal', e.message, true);
					Swal.fire({
						icon: 'error',
						title: 'Oops...',
						text: 'terjadi kesalahan!',

					})

				}
			}).fail(function(e) {
				// console.log(e);
				notifikasi('#alertNotif', 'Terjadi kesalahan!', true);
			});
			return false;
		});

		$('body').on('click', '.btnHapus', function() {
			var id = $(this).data('id');
			var nama = $(this).data('nama');
			Swal.fire({
				title: 'Apakah Anda Yakin ?',
				text: "Anda akan Menghapus Admin: " + nama,
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Yes, delete it!'
			}).then((result) => {

				if (result.value) {
					$.ajax({
						url: bu + 'admin/hapusAdmin',
						dataType: 'json',
						method: 'POST',
						data: {
							id: id
						}
					}).done(function(e) {
						Swal.fire(
							'Deleted!',
							e.message,
							'success'
						)
						$('#modal-detail').modal('hide');
						datatable.ajax.reload();
					}).fail(function(e) {
						console.log('gagal');
						console.log(e);
						var message = 'Terjadi Kesalahan. #JSMP01';
						// notifikasi('#alertNotif', message, true);
					});
				}
			})




		});
		$('body').on('click', '.btnUbah', function() {
			url_form = url_form_ubah;
			// console.log(url_form);
			$('#tambah_act').hide();

			var no_telpon = $(this).data('no_telpon');
			var id = $(this).data('id');
			var nama = $(this).data('nama');
			var id_role = $(this).data('id_role');
			var username = $(this).data('username');
			var password = $(this).data('password');
			$('#modal-detail').modal('show');

			$('#id').val(id);
			$('#nama').val(nama);

			$('#username').val(username);
			$('#password').val(password);
			$('#noHP').val(no_telpon);
			$('#Edit').show();
			$("#role").val(parseInt(id_role));
		});

		$('#Edit').on('click', function() {
			var id = $('#id').val();
			var nama = $('#nama').val();
			var role = $('#role').val();
			var username = $('#username').val();
			var password = $('#password').val();
			var noHP = $('#noHP').val();

			if (
				nama && role && noHP && username && password
			) {
				$("#form").submit();
			}


		});

		$('#btnExport').on('click', function() {
			var url = bu + 'Export/master_list_siswa/?';
			window.location = url;
			return (false);

		});

	});
</script>
