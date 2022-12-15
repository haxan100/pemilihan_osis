<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Pemilihan Osis</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Font Awesome -->
	<link rel="stylesheet" href="<?= base_url(); ?>/aseets/adminlte/plugins/fontawesome-free/css/all.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	<!-- icheck bootstrap -->
	<link rel="stylesheet" href="<?= base_url(); ?>/aseets/adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?= base_url(); ?>/aseets/adminlte/dist/css/adminlte.min.css">
	<!-- Google Font: Source Sans Pro -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition login-page">
	<div class="container">
		<div class="login-logo">
			<a href=""><b>Register Pemilihan Calon</b></a>
		</div>
		<div id="alertNotif" class="p-2">
			<?php
			if ($ci->session->flashdata('notifikasi')) {
				$e = $ci->session->flashdata('notifikasi');
				echo '
								<div class="alert ' . $e['alert'] . ' alert-dismissible show" role="alert">
										<span>' . $e['message'] . '</span>
										<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								</div>
						';
			}
			?>
		</div>
		<!-- /.login-logo -->
		<div class="card">
			<div class="card-body login-card-body">
				<p class="login-box-msg">User Siswa</p>

				<form id="form">
					<span class="label">Nim</span>					
					<div class="input-group mb-3">
						<input type="text" id="nim" name="nim" class="form-control" value="12345" placeholder="Nim">
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-envelope"></span>
							</div>
						</div>
					</div>

					<span class="label">Nama</span>
					<div class="input-group mb-3">
						<input type="text" id="nama" name="nama"class="form-control" value="terisi" placeholder="Nama">
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-envelope"></span>
							</div>
						</div>
					</div>

					<span class="label">Angkatan</span>
					<div class="input-group mb-3">		
						<input type="text"name="angkatan" id="angkatan" class="form-control" value="terisi" placeholder="angkatan">
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-envelope"></span>
							</div>
						</div>
					</div>
					<span class="label">Prodi</span>					
					<div class="input-group mb-3">
						<input type="text" name="prodi" id="prodi" class="form-control" value="" placeholder="prodi">
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-envelope"></span>
							</div>
						</div>
					</div>

					<span class="label">Foto KTM</span>
					<div class="input-group mb-3">
						<input type="file" id="foto_ktm" name="foto_ktm" class="form-control" placeholder="Foto KTM">
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-envelope"></span>
							</div>
						</div>
					</div>
					<div class="input-group mb-3">
						<input type="file" id="foto_diri" name="foto_diri" class="form-control" placeholder="foto_diri">
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-envelope"></span>
							</div>
						</div>
					</div>
					
					<div class="row">
						<!-- /.col -->
						<div class="col-12">
							<button class="btn btn-success btn-block" type="submit" id="loginBtn">Register</button>
						</div>
						<!-- /.col -->
						<!-- /.col -->
					</div>
					<hr>
					<label for="Cart">Untuk Melihat Hasil Quick Count Sementara, Cek <a href="<?= base_url() ?>Cart">Disini</a></label>

					<label for="Cart">Untuk Login Silahkan Klik Disini <a href="<?= base_url() ?>Cart">						
					<button class="btn btn-success btn-block" type="submit" id="loginBtn">Login</button>
					</a></label>
					<hr>
				</form>

			</div>
			<!-- /.login-card-body -->
		</div>
	</div>
	<!-- /.login-box -->

	<!-- jQuery -->
	<script src="<?= base_url(); ?>/aseets/adminlte/plugins/jquery/jquery.min.js"></script>
	<!-- Bootstrap 4 -->
	<script src="<?= base_url(); ?>/aseets/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
	<!-- AdminLTE App -->
	<script src="../../dist/js/adminlte.min.js"></script>
		<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>



	<script>
		$(document).ready(function() {
			var bu = '<?= base_url(); ?>';
			var captcha;

			$(".preloader").fadeOut();

			$('#loginBtn').click(function (e) { 
				e.preventDefault();
				$("#form").submit();

				
			});
			$("#form").submit(function (e) {

				$.ajax({
					url: bu+"/Register/process",
					method: "post",
					dataType: "json",
					data: new FormData(this),
					processData: false,
					contentType: false,
					cache: false,
					async: false,
				})
					.done(function (e) {
						if (e.status) {
							
							Swal.fire(
								'Berhasil',
								e.message,
								'success'
							)
							setTimeout(() => {
								window.location.href = '<?= base_url() ?>User/';
							}, 2500);
							
						} else {
							Swal.fire(
								'Maaf',
								e.message,
								'error'
							)
							
						}
					})
					.fail(function (e) {
						// console.log(e);
						notifikasi("#alertNotif", "Terjadi kesalahan!", true);
					});
				return false;
			});

			function resetButton() {
				$('#loginBtn').html('Login');
				$('#loginBtn').prop('disabled', false);
			}

			function toAlert() {
				$('html, body').animate({
					scrollTop: $('#alertNotif').offset().top - 75
				}, 500);
			}

		});
	</script>
</body>

</html>
