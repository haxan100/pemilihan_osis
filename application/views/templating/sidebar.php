<!-- Main Sidebar Container -->

<script src="<?= base_url(); ?>aseets/adminlte/dist/js/sweetalert.js"></script>


<aside class="main-sidebar sidebar-dark-primary elevation-4">
	<!-- Brand Logo -->
	<a href="<?= base_url() ?>User/" class="brand-link">
		<img src="<?= base_url(); ?>/aseets/adminlte/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
		<span class="brand-text font-weight-light">Pemilihan</span>
	</a>
	<?php


	$uri = $this->uri->segment(2);

	$prodi = $sql = "SELECT * FROM prodi ";
	$query = $this->db->query($sql)->result();

	if ($login) {
		if ($admin) {
			$role = $data->id_role;
	?>
			<!-- Sidebar -->
			<div class="sidebar">
				<!-- Sidebar user panel (optional) -->
				<div class="user-panel mt-3 pb-3 mb-3 d-flex">
					<div class="image">
						<img src="<?= base_url(); ?>/aseets/adminlte/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
					</div>
					<div class="info">
						<a href="<?= base_url() ?>User/Profile" class="d-block"><?= $data->nama ?> </a>
					</div>
				</div>

				<!-- Sidebar Menu -->
				<nav class="mt-2">
					<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
						<!-- Add icons to the links using the .nav-icon class
				with font-awesome or any other icon font library -->
						<li class="nav-item has-treeview menu-open">
							<a href="#" class="nav-link active">
								<i class="nav-icon fas fa-tachometer-alt"></i>
								<p>
									Menu
									<i class="right fas fa-angle-left"></i>
								</p>
							</a>
							<ul class="nav nav-treeview">
								<li class="nav-item">
									<a href="<?= base_url() ?>Admin/Profile" class="nav-link  <?php if ($uri == 'profile') echo 'active' ?>">
										<i class="far fa-circle nav-icon"></i>
										<p>Profile</p>
									</a>
								</li>
							</ul>

							<ul class="nav nav-treeview">
								<?php
								if ($role == 1) {

								?>
									<li class="nav-item">
										<a href="<?= base_url() ?>admin/admin" class="nav-link  <?php if ($uri == 'admin') echo 'active' ?>">
											<i class="far fa-circle nav-icon"></i>
											<p>Master Admin</p>
										</a>
									</li>
								<?php
								}
								?>
								<li class="nav-item">
									<a href="<?= base_url() ?>admin/siswa" class="nav-link  <?php if ($uri == 'siswa') echo 'active' ?>">
										<i class="far fa-circle nav-icon"></i>
										<p>Master Siswa</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="<?= base_url() ?>admin/calon_dpm" class="nav-link  <?php if ($uri == 'calon_dpm') echo 'active' ?>">
										<i class="far fa-circle nav-icon"></i>
										<p>Master Calon DPM</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="<?= base_url() ?>admin/calon_bem" class="nav-link <?php if ($uri == 'calon_bem') echo 'active' ?> ">
										<i class="far fa-circle nav-icon"></i>
										<p>Master Calon BEM</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="<?= base_url() ?>Admin/cart" class="nav-link  <?php if ($uri == 'cart') echo 'active' ?>">
										<i class="far fa-circle nav-icon"></i>
										<p>Quick Count BEM</p>
									</a>
								</li>


								<li class="nav-item">
									<a class="nav-link dropdown-toggle nav-link  <?php if ($uri == 'cart_dpm') echo 'active' ?>" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										Quick Count DPM
									</a>
									<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
										<?php
										foreach ($query as $key => $v) {

										?>
											<a class="dropdown-item" href="<?= base_url() ?>Admin/cart_dpm/<?= $v->id_prodi ?>"><?= $v->nama_prodi ?></a>
										<?php
										}

										?>
									</div>
								</li>


								<!-- <li class="nav-item">
										<a href="<?= base_url() ?>Admin/cart_dpm" class="nav-link  <?php if ($uri == 'cart_dpm') echo 'active' ?>">
											<i class="far fa-circle nav-icon"></i>
											<p>Quick Count DPM</p>
									</a>
								</li> -->




								<li class="nav-item">
									<a href="<?= base_url() ?>Setting" class="nav-link">
										<i class="far fa-circle nav-icon"></i>
										<p>Setting</p>
									</a>
								</li>
							</ul>
						</li>
						<li class="nav-item">
							<a href="#" id="logout" class="nav-link">
								<i class="far fa-circle nav-icon"></i>
								<p>Logout</p>
							</a>
						</li>

					</ul>
				</nav>
				<!-- /.sidebar-menu -->
			</div>
		<?php
		} else {
		?>
			<div class="sidebar">
				<!-- Sidebar user panel (optional) -->
				<div class="user-panel mt-3 pb-3 mb-3 d-flex">
					<div class="image">
						<img src="<?= base_url(); ?>/aseets/adminlte/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
					</div>
					<div class="info">
						<a href="<?= base_url() ?>User/Profile" class="d-block"><?= $data->nama ?> </a>
					</div>
				</div>

				<!-- Sidebar Menu -->
				<nav class="mt-2">
					<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
						<!-- Add icons to the links using the .nav-icon class
				with font-awesome or any other icon font library -->
						<li class="nav-item has-treeview menu-open">
							<a href="#" class="nav-link active">
								<i class="nav-icon fas fa-tachometer-alt"></i>
								<p>
									Menu
									<i class="right fas fa-angle-left"></i>
								</p>
							</a>
							<ul class="nav nav-treeview">
								<li class="nav-item">
									<a href="<?= base_url() ?>User/Profile" class="nav-link <?php if ($uri == 'Profile') echo 'active' ?>">
										<i class="far fa-circle nav-icon"></i>
										<p>Profile</p>
									</a>
								</li>
							</ul>

							<ul class="nav nav-treeview">
								<li class="nav-item">
									<a href="<?= base_url() ?>User/pilih_bem" class="nav-link <?php if ($uri == 'pilih_bem') echo 'active' ?>">
										<i class="far fa-circle nav-icon"></i>
										<p>Pilih BEM</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="<?= base_url() ?>User/pilih_dpm" class="nav-link <?php if ($uri == 'pilih_dpm') echo 'active' ?>">
										<i class="far fa-circle nav-icon"></i>
										<p>Pilih DPM</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="<?= base_url() ?>User/cart_bem" class="nav-link <?php if ($uri == 'cart_bem') echo 'active' ?>">
										<i class="far fa-circle nav-icon"></i>
										<p>Quick Count BEM</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="<?= base_url() ?>User/cart_dpm" class="nav-link <?php if ($uri == 'Cart_dpm' || $uri == 'cart_dpm') echo 'active' ?>">
										<i class="far fa-circle nav-icon"></i>
										<p>Quick Count DPM</p>
									</a>
								</li>
							</ul>
						</li>
						<li class="nav-item">
							<a href="#" id="logout" class="nav-link">
								<i class="far fa-circle nav-icon"></i>
								<p>Logout</p>
							</a>
						</li>

					</ul>
				</nav>
				<!-- /.sidebar-menu -->
			</div>

		<?php
		}
		?>

	<?php
	} else { //  ini untuk yang nga login 
	?>
		<div class="sidebar">
			<!-- Sidebar user panel (optional) -->

			<!-- Sidebar Menu -->
			<nav class="mt-2">
				<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
					<!-- Add icons to the links using the .nav-icon class
				with font-awesome or any other icon font library -->
					<li class="nav-item has-treeview menu-open">
						<a href="#" class="nav-link active">
							<i class="nav-icon fas fa-tachometer-alt"></i>
							<p>
								Menu
								<i class="right fas fa-angle-left"></i>
							</p>
						</a>

						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="<?= base_url() ?>User/cart" class="nav-link">
									<i class="far fa-circle nav-icon"></i>
									<p>Quick Count BEM</p>
								</a>
							</li>
						</ul>

					</li>


					<li class="nav-item">
						<a class="nav-link dropdown-toggle nav-link  <?php if ($uri == 'cart_dpm') echo 'active' ?>" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							Quick Count DPM
						</a>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
							<?php
							foreach ($query as $key => $v) {

							?>
								<a class="dropdown-item" href="<?= base_url() ?>cart/cart_dpm/<?= $v->id_prodi ?>"><?= $v->nama_prodi ?></a>
							<?php
							}

							?>
						</div>
					</li>

					<li class="nav-item">
						<a href="<?= base_url() ?>Login" class="nav-link">
							<i class="far fa-circle nav-icon"></i>
							<p>Login</p>
						</a>
					</li>

				</ul>
			</nav>
			<!-- /.sidebar-menu -->
		</div>

	<?php

	}
	?>
	<!-- /.sidebar -->
</aside>

<script>
	var bu = '<?= base_url(); ?>';
	$('#logout').on('click', function() {

		Swal.fire({
			title: 'Apakah Anda Yakin ?',
			text: "Anda akan Keluar: ",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes,'
		}).then((result) => {

			if (result.value) {
				$.ajax({
					url: bu + 'Admin/Logout',
					dataType: 'json',
					method: 'POST',
				}).done(function(e) {
					console.log(e);
					Swal.fire(
						'Logout!',
						e.message,
						'success'
					)
					setTimeout(() => {
						window.location.href = "<?php echo site_url('Login'); ?>";

					}, 2000);

					// $('#modal-detail').modal('hide');
					// datatable.ajax.reload();
				}).fail(function(e) {
					console.log('gagal');
					console.log(e);
					var message = 'Terjadi Kesalahan. #JSMP01';
					// notifikasi('#alertNotif', message, true);
				});
			}
		})

	});
</script>