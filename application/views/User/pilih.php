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
					<div class="info-box bg-info" style="max-width: 95%;max-height: 100%;">
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
							<input class="cekbox" type="checkbox" value="<?= $key->id_calon ?>" name="pilihan" id="<?= $key->id_calon ?>">
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
		<center>

			<button class="btn btn-primary" id="pilih" type="button">Pilih</button>
		</center>
		<!-- /.row -->

	</section>
	<!-- /.content -->
</div>
<!-- DataTables CSS -->


<script>
	$(document).ready(function() {

		$('input.cekbox').on('change', function() {
			$('input.cekbox').not(this).prop('checked', false);
		});
		// klass cekbox
		$('#pilih').on('click', function() {
			var bu = '<?= base_url(); ?>';

			var checkbox = document.getElementsByName("pilihan");
			var pilihan = $('.cekbox:checked').val();
			// var pilihan = [];
			// console.log(checkedValue);
			// return false
			$checked = 0;
			for (var i = 0; i < checkbox.length; i++) {
				if (checkbox[i].checked)
					$checked = 1;
			}
			if ($checked == 0) {
				alert("Mohon Pilih Setidaknya 1 Calon");
				return false
			}

			var r = confirm("Apakah Anda Yakin Untuk Memilih Calon ?");
			if (r == true) {

				$.ajax({
					type: "POST",
					dataType: 'json',
					url: "<?= $bu; ?>User/pilih",
					data: {
						pilih: pilihan,
					},
				}).done(function(e) {
					// console.log(e);
					if (e.status) {
						// alert(e.message);
						Swal.fire(
							':)',
							e.message,
							'success'
						);
						setTimeout(function() {
							window.location.href = "User/Cart";
						}, 2000);

						// notifikasi('#alertNotif', e.message, false);
						// $('#modalMetodSekaligus').modal('hide');
						// datatable.ajax.reload();
						// resetForm();

					} else {
						// alert(e.message);
						Swal.fire({
							icon: 'error',
							title: 'Oops...',
							text: e.message,

						})

						// $('#modalMetodSekaligus').modal('hide');
						// var alert = 'biz-alert-success';
						// $('#alertNotifFloat').html('<div class="alert ' + alert + ' alert alert-primary" role="alert"><span>' + e.message + '</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
					}
				}).fail(function(e) {
					// $('.modalMetodSekaligus').modal('hide');
					// datatable.ajax.reload();
					// resetForm();
				});
			}

		});




	});
</script>
