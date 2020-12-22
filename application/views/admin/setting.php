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
	<section class="content">

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
							<div class="row">
								<div class="col-6">
									Waktu Mulai : <?= $waktu->mulai ?> WIB<br>
									Waktu Akhir : <?= $waktu->akhir ?> WIB
								</div>
								<button class="btn btn-primary" type="button">Edit</button>
								<hr>
								<hr>
								<div class="col-6">
									<label for="birthdaytime">Mulai:</label>
									<input type="datetime-local" id="mulai" name="birthdaytime">
									<br>
									<label for="birthdaytime">Akhir:</label>
									<input type="datetime-local" id="akhir" name="birthdaytime">
								</div>
								<button class="btn btn-primary" type="button" id="edit">Simpan</button>
							</div>
						</tr>
					</thead>
					<tbody>
				</table>
			</div>
			<!-- /.card-body -->
		</div>
	</section>
	<!-- /.content -->
</div>
<!-- DataTables CSS -->


<script>
	$(document).ready(function() {

		var bu = '<?= base_url(); ?>';
		$('#edit').on('click', function() {
			var m = $('#mulai').val()
			var a = $('#akhir').val()
			console.log(a == '')
			if (a == '') {
				Swal.fire(
					'gagal!',
					'mohon di isi data yang benar',
					'error'
				)
			}
			if (m == '') {
				Swal.fire(
					'gagal!',
					'mohon di isi data yang benar',
					'error'
				)
			} else {
				// alert(m, a)
				$.ajax({
					url: bu + 'Setting/Setting',
					dataType: 'json',
					method: 'POST',
					data: {
						mulai: m,
						akhir: a,
					}
				}).done(function(e) {
					// console.log(e);
					Swal.fire(
						'Sukses!',
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

		});


	})
</script>
