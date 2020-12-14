<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>AdminLTE 3 | Log in</title>
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
	<div class="login-box">
		<div class="login-logo">
			<a href="../../index2.html"><b>Login Pemilihan Calon</b></a>
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

				<form>
					<div class="input-group mb-3">
						<input type="text" id="username" class="form-control" placeholder="Email / NIS">
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-envelope"></span>
							</div>
						</div>
					</div>
					<div class="input-group mb-3">
						<input type="password" id="password" class="form-control" placeholder="Password / No Telpon ">
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-lock"></span>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-8">
							<div class="icheck-primary">
								<input type="checkbox" id="remember">
								<label for="remember">
									Remember Me
								</label>
							</div>
						</div>
						<!-- /.col -->
						<div class="col-4">
							<button class="btn btn-success btn-block" type="submit" id="loginBtn">Login</button>
						</div>
						<!-- /.col -->
					</div>
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



	<script>
		$(document).ready(function() {
			var bu = '<?= base_url(); ?>';
			var captcha;

			$(".preloader").fadeOut();

			$('#loginBtn').on('click', function() {

				var username = $('#username').val();
				var password = $('#password').val();

				console.log(username, password);
				// return false;

				if (username.length < 1 || password.length < 1) {
					var message = 'Silahkan ketikkan username dan password Anda.';
					$('#alertNotif').html('<div class="alert alert-danger alert-dismissible show" role="alert"><span>' + message + '</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');

				} else {
					$('#loginBtn').html('<i class="fas fa-spinner fa-spin"></i> Tunggu..');
					$('#loginBtn').prop('disabled', true);
					// alert("gagal-")
					$.ajax({
						type: "POST",
						dataType: 'json',
						url: bu + "Login/login_proses",
						data: {
							username: username,
							password: password,
						},
					}).done(function(e) {
						console.log(e);
						if (e.status) {
							$('#username').val('');
							$('#password').val('');
							$('#captcha').val('');
							$('#alertNotif').html('<div class="alert alert-success alert-dismissible show" role="alert"><span>' + e.message + '</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
							setTimeout(() => {
								window.location = bu + 'User';
							}, 1000);
						} else {
							$('#alertNotif').html('<div class="alert alert-danger alert-dismissible show" role="alert"><span>' + e.message + '</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
						}
					}).fail(function(e) {
						var message = 'Terjadi Kesalahan.';
						$('#alertNotif').html('<div class="alert alert-danger alert-dismissible show" role="alert"><span>' + message + '</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
					}).always(function() {
						toAlert();
						resetButton()
					});
				}
				// return false;;
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
