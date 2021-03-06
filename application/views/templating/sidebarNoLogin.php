<!-- Main Sidebar Container -->

<script src="<?= base_url(); ?>aseets/adminlte/dist/js/sweetalert.js"></script>

<aside class="main-sidebar sidebar-dark-primary elevation-4">
	<!-- Brand Logo -->
	<a href="<?= base_url() ?>User/" class="brand-link">
		<img src="<?= base_url(); ?>/aseets/adminlte/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
		<span class="brand-text font-weight-light">Pemilihan</span>
	</a>

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
							<a href="<?= base_url() ?>User/Profile" class="nav-link ">
								<i class="far fa-circle nav-icon"></i>
								<p>Profile</p>
							</a>
						</li>
					</ul>

					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="<?= base_url() ?>admin/siswa" class="nav-link ">
								<i class="far fa-circle nav-icon"></i>
								<p>Master Siswa</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?= base_url() ?>User/cart" class="nav-link">
								<i class="far fa-circle nav-icon"></i>
								<p>Quick Count</p>
							</a>
						</li>
					</ul>
				</li>

			</ul>
		</nav>
		<!-- /.sidebar-menu -->
	</div>
	<!-- /.sidebar -->
</aside>
