<!-- Content Wrapper. Contains page content -->
<?php
$bu = base_url();

?>
<style>
	.card-header {
		background-color: #ffc107;
	}
</style>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
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

		<!-- Profile Image -->
		<div class="card card-primary card-outline">
			<div class="card-body box-profile">

				<ul class="list-group list-group-unbordered mb-3">
					<li class="list-group-item">
						<b>Nama</b> <a class="float-right"> <?= $data->nama ?></a>
					</li>
					<li class="list-group-item">
						<b>Nomor Telpon</b> <a class="float-right"> <?= $data->no_telpon ?></a>
					</li>
				</ul>

				<a href="#" class="btn btn-primary btn-block" data-toggle="modal" data-target="#modal-detail"><b>Edit</b></a>
			</div>
			<!-- /.card-body -->
		</div>
		<!-- /.card -->

		<!-- About Me Box -->



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
													<input id="id_siswa" name="id_siswa" class="form-control " readonly type="hidden" class="form-control" value="<?= $data->id ?>">
													<div class="item form-group col-md-6 col-sm-6">
														<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name"> Nama <span class="required">*</span>
														</label>
														<div class="">
															<input id="nama" name="nama" class="form-control " placeholder="Isikan Nama" type="text" class="form-control" value="<?= $data->nama ?>">
														</div>
													</div>

													<div class="item form-group col-md-6 col-sm-6 ">
														<label class="col-form-label label-align" for="last-name">Username <span class="required">*</span>
														</label>
														<div class="">
															<input id="username" name="username" class="form-control " placeholder="Isikan Username" type="text" class="form-control" value="<?= $data->username ?>">

														</div>
													</div>

												</div>
												<div class="row">
													<div class="item form-group col-md-6 col-sm-6 ">
														<label class="col-form-label label-align" for="last-name">Password <span class="required">*</span>
														</label>
														<div class="">
															<input id="password" name="password" class="form-control " placeholder="Isikan Password" type="text" class="form-control" value="<?= $data->password ?>">

														</div>
													</div>

													<div class="item form-group col-md-6 col-sm-6 ">
														<label class="col-form-label label-align" for="last-name">No Hp <span class="required">*</span>
														</label>
														<div class="">
															<input id="noHP" name="noHP" class="form-control " placeholder="Isikan No HP" type="text" class="form-control" value="<?= $data->no_telpon ?>">

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
						</div>
					</div>
				</form>

			</div>
		</div>
</div>

<!-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> -->
<!-- /.modal -->



</section>
<!-- /.content -->
</div>
<!-- DataTables CSS -->
<script>
	$(function() {
		$(document).ready(function() {

			var bu = '<?= base_url(); ?>';
			var url_form_ubah = bu + 'admin/ubah_siswa_proses';

			$('#KelasAlert').hide()
			$('#NISAlert').hide()

			$("#kelas").hover(function() {
				// alert("dddd")
				$('#KelasAlert').show('slow')
			}, function() {
				$('#KelasAlert').hide('slow')
			});
			$("#nisn").hover(function() {
				// alert("dddd")
				$('#NISAlert').show('slow')
			}, function() {
				$('#NISAlert').hide('slow')
			});
		});
		$('#Edit').on('click', function() {

			var bu = '<?= base_url(); ?>';
			var url_form_ubah = bu + 'admin/ubah_siswa_proses';
			url_form = url_form_ubah;
			var id_siswa = $('#id_siswa').val();
			var nama = $('#nama').val();
			var username = $('#username').val();
			var password = $('#password').val();
			var noHP = $('#noHP').val();
			if (nama == '') {
				salah('nama');
				return false
			}
			if (username == '') {
				salah('username');
				return false
			}
			if (noHP == '') {
				salah('noHP');
				return false
			}

			if (
				id_siswa
			)
				$.ajax({
					url: bu + 'admin/ubah_profile_admin',
					dataType: 'json',
					method: 'POST',
					data: {
						id: id_siswa,
						nama: nama,
						username: username,
						password: password,
						noHP: noHP,
					}
				}).done(function(e) {
					// return false
					if (e.status) {
						$('#modal-detail').modal('hide');
						Swal.fire(
							':)',
							e.message,
							'success'
						);

						window.setTimeout(function() {
							window.location.reload();
						}, 2000);
					} else {
						$('#modal-detail').modal('hide');

						// notifikasiModal('#modalProduk', '#alertNotifModal', e.message, true);
						Swal.fire({
							icon: 'error',
							title: 'Oops...',
							text: 'terjadi kesalahan!',

						})

					}
				}).fail(function(e) {
					Swal.fire({
						icon: 'error',
						title: 'Oops...',
						text: 'terjadi kesalahan!',

					})
					// console.log(e);
					// notifikasi('#alertNotif', 'Terjadi kesalahan!', true);
				});
			return false;
		});

		function salah(data) {
			Swal.fire({
				icon: 'error',
				title: 'Oops...',
				text: 'Mohon di lengkapi ' + data,
			})
			return false
		}




	});
</script>
