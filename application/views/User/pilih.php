<!-- Content Wrapper. Contains page content -->
<?php
$bu = base_url();
?>
<style>
	input[type=checkbox] {
		position: relative;
		cursor: pointer;
	}

	input[type=checkbox]:before {
		content: "";
		display: block;
		position: absolute;
		width: 16px;
		height: 16px;
		top: 0;
		left: 0;
		border: 2px solid #555555;
		border-radius: 3px;
		background-color: white;
	}

	input[type=checkbox]:checked:after {
		content: "";
		display: block;
		width: 5px;
		height: 10px;
		border: solid black;
		border-width: 0 2px 2px 0;
		-webkit-transform: rotate(45deg);
		-ms-transform: rotate(45deg);
		transform: rotate(45deg);
		position: absolute;
		top: 2px;
		left: 6px;
	}
</style>
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

		<div class="modal fade" id="modalDetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Calon Detail</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<!-- About Me Box -->
						<div class="card card-primary">
							<div class="card-header">
								<h3 class="card-title">About Me</h3>
							</div>
							<!-- /.card-header -->
							<div class="card-body">
								<strong><i class="fas fa-book mr-1"></i> Nama</strong>

								<p class="text-muted" id="nama">

								</p>
								<hr>
								<strong><i class="fas fa-map-marker-alt mr-1"></i> VISI</strong>
								<p class="text-muted" id="visi"></p>
								<hr>
								<strong><i class="fas fa-pencil-alt mr-1"></i> MISI</strong>

								<p class="text-muted" id="misi">
									<span class="tag tag-danger"></span>
								</p>
								<hr>
							</div>
							<!-- /.card-body -->
						</div>
						<!-- /.card -->
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>



		<div id="alertNotif" class="p-2">
			<?php
			if ($this->session->flashdata('notifikasi')) {
				// $oke = 1;
				$e = $this->session->flashdata('notifikasi');
				$pesan = $e['message'];
				$bu = base_url();
				echo "
				<input name='oke' id='oke' class='btn btn-primary' type='hidden' value='1'>
								<div class='alert alert-danger alert-dismissible show' role='alert'> <span> $pesan </span>
										<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
								</div>

								<script>
								setTimeout(function() {
								window.location.href = '$bu/User/Cart_bem';
							}, 2000);
								</script>

				
						";
			}
			?>
		</div>

		<!-- =========================================================== -->

		<div class="row">
			<?php
			foreach ($data as $key) {
				// echo $key->nama_calon;
			?>
				<div class="col-md-3 col-sm-6 col-12">
					<div class="info-box bg-primary" style="max-width: 95%;max-height: 100%;">
						<span class="info-box-icon"> <img class="img-fluid" id="foto_wrapper" data-target="#modalBaru" data-toggle="modal" src="<?= base_url(); ?>/upload/images/Calon_bem/<?= $key->foto ?>"> </span>

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
							<div class="row">
								<div class="col-6">
									<input class="cekbox" type="checkbox" value="<?= $key->id_calon ?>" name="pilihan" id="<?= $key->id_calon ?>">
								</div>
								<div class="col-6">
									<button class="btn btn-info detailCalon" data-id="<?= $key->id_calon ?>" type="button">Detail</button>
								</div>

							</div>


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

			<button class="btn btn-lg btn-primary" id="pilih" type="button">Pilih</button>
		</center>
		<!-- /.row -->

	</section>
	<!-- /.content -->
</div>
<!-- DataTables CSS -->
<!--  -->

<script>
	$(document).ready(function() {

		var d = $('#oke').val();
		if (d == 1) {
			$('#pilih').hide(); // untuk menyembunyikan  tombol
		}

		$('input.cekbox').on('change', function() {
			$('input.cekbox').not(this).prop('checked', false);
		});
		$('.detailCalon').on('click', function() {
			$('#modalDetail').modal('show');
			var data = $(this).data("id")
			$.ajax({
				type: "POST",
				dataType: 'json',
				url: "<?= $bu; ?>Admin/getCalonByID",
				data: {
					data: data,
					type: 'bem',
				},
			}).done(function(e) {
				var data = e.data
				console.log(data)
				$('#visi').html(data.visi)
				$('#misi').html(data.moto)
				$('#nama').html(data.nama_calon)


			}).fail(function(e) {

			});

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
				// alert("Mohon Pilih Setidaknya 1 Calon");
				Swal.fire({
					icon: 'error',
					title: 'Oops...',
					text: 'Mohon Pilih Setidaknya 1 Calon',
				})
				return false
			}

			Swal.fire({
				title: 'Apakah Anda Yakin Untuk Memilih Calon ?',
				text: "Anda Tidak Dapat Membatalkan Atau Mengedit Pillihan Anda!",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Ya, Pilih'
			}).then((result) => {
				if (result.isConfirmed) {

					$.ajax({
						type: "POST",
						dataType: 'json',
						url: "<?= $bu; ?>User/pilih",
						data: {
							pilih: pilihan,
							type: 'bem',
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
							
						} else {
							// alert(e.message);
							Swal.fire({
								icon: 'error',
								title: 'Oops...',
								text: e.message,

							})

						}
					}).fail(function(e) {

					});

				}
			})

		});




	});
</script>
