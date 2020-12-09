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

		<!-- =========================================================== -->

		<div class="row">
			<?php
			foreach ($data as $key) {
				// echo $key->nama_calon;
			?>
				<div class="col-md-3 col-sm-6 col-12">
					<div class="info-box bg-info">
						<span class="info-box-icon"> <img class="img-fluid" id="foto_wrapper" data-target="#modalBaru" data-toggle="modal" src="<?= base_url(); ?>/upload/images/Calon/<?= $key->foto ?>"> </span>

						<div class="info-box-content">
							<span class="info-box-text">Nama : <?= $key->nama_calon ?></span>
							<div class="progress">
								<div class="progress-bar" style="width: 100%"></div>
							</div>
							<span class="progress-description">
								<?= $key->moto ?>
							</span>
							<hr>
							<span class="progress-description">
								<?= $key->visi ?>
							</span>
							<input class="cekbox" type="checkbox" name="pilihan" id="<?= $key->id_calon ?>">
						</div>
						<!-- /.info-box-content -->
					</div>
					<!-- /.info-box -->
				</div>

			<?php
				# code...
			}
			?>
		</div>
		<!-- /.row -->

	</section>
	<!-- /.content -->
</div>
<!-- DataTables CSS -->


<script>

</script>
