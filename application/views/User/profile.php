<!-- Content Wrapper. Contains page content -->
<?php
$bu = base_url();
?>
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
				<h3 class="profile-username text-center"> <?= $data->nama ?> </h3>

				<p class="text-muted text-center"> <?= $data->NIS ?></p>

				<ul class="list-group list-group-unbordered mb-3">
					<li class="list-group-item">
						<b>Kelas</b> <a class="float-right"> <?= $data->id_kelas ?></a>
					</li>
					<li class="list-group-item">
						<b>Nomor Telpon</b> <a class="float-right"> <?= $data->no_telpon ?></a>
					</li>
					<li class="list-group-item">
						<b>Alamat</b> <a class="float-right"> <?= $data->alamat ?></a>
					</li>
				</ul>

				<a href="#" class="btn btn-primary btn-block"><b>Edit</b></a>
			</div>
			<!-- /.card-body -->
		</div>
		<!-- /.card -->

		<!-- About Me Box -->

		<!-- /.card -->
</div>

</section>
<!-- /.content -->
</div>
<!-- DataTables CSS -->
