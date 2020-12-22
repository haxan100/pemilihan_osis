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
						<li class="breadcrumb-item active">Setting</li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<!-- /.content-header -->
	<!-- Main content -->
	<section class="content">
		<br>
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
							<th>No</th>
							<th>Waktu Mulai</th>
							<th>Waktu Akhir</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
				</table>
			</div>
			<!-- /.card-body -->
		</div>
		<!-- Modal Add Category -->
		<div class="modal fade bs-example-modal-lg" id="modal-detail" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<form id="form">
					<div class="modal-content">

						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
							</button>
						</div>
						<div class="modal-body">
							<h4>Edit Waktu</h4>

							<div class="row">
								<div class="col-md-12 col-sm-12 ">
									<div class="x_panel">

										<div class="x_content">
											<br />
											<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
												<div class="row">

													<div class="col-6">
														<label for="birthdaytime">Mulai:</label>
														<input type="datetime-local" id="mulai" name="birthdaytime">
														<br>
														<label for="birthdaytime">Akhir:</label>
														<input type="datetime-local" id="akhir" name="birthdaytime">
													</div>
													<!-- <button class="btn btn-primary" type="button" id="edit">Simpan</button> -->
												</div>


											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							<button class="btn btn-primary" type="button" id="edit">Simpan</button>

							<button type="button" class="btn btn-success" id="tambah_act">Tambah</button>
						</div>
					</div>
				</form>

			</div>
		</div>
	</section>
	<!-- /.content -->
</div>
<!-- DataTables CSS -->


<script>
	$(document).ready(function() {

		var bu = '<?= base_url(); ?>';

		var url_form_tambah = bu + 'admin/tambah_siswa_proses';
		var url_form_ubah = bu + 'admin/ubah_siswa_proses';
		var datatable = $('#example1').DataTable({
			'lengthMenu': [
				[5, 10, 25, 50, -1],
				[5, 10, 25, 50, 'All']
			],
			'pageLength': 10,
			"processing": true,
			"language": {
				processing: '....loading<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>loading....<span class="sr-only">Loading...</span> '
			},
			"serverSide": true,
			"columnDefs": [{
					"targets": 0,
					"className": "dt-body-center dt-head-center",
					"width": "20px",
					"orderable": false
				},
				{
					"targets": 1,
					"className": "dt-head-center"
				},
				{
					"targets": 2,
					"className": "dt-body-center dt-head-center"
				},
			],
			"order": [
				[1, "desc"]
			],
			'ajax': {
				url: bu + 'Setting/getSetting',
				type: 'POST',
				"data": function(d) {
					return d;
				}
			},
		});

		function validasi(id, valid, message = '') {
			if (valid) {
				$(id)
					// .addClass('is-valid')
					.removeClass('is-invalid')
					.parent()
					.find('small')
					// .addClass('valid-feedback')
					.removeClass('invalid-feedback')
					.html(message);
			} else {
				$(id)
					// .removeClass('is-valid')
					.addClass('is-invalid')
					.parent()
					.find('small')
					// .removeClass('valid-feedback')
					.addClass('invalid-feedback')
					.html(message);
			}
		}

		function notifikasiModal(modal, sel, msg, err) {
			var alert_type = 'alert-success ';
			if (err) alert_type = 'alert-danger ';
			var html = '<div class="alert ' + alert_type + ' alert-dismissible show p-4">' + msg + '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
			$(sel).html(html);
			$(modal).animate({
				scrollTop: $(sel).offset().top - 75
			}, 500);
		}



		function notifikasi(sel, msg, err) {
			var alert_type = 'alert-success ';
			if (err) alert_type = 'alert-danger ';
			var html = '<div class="alert ' + alert_type + ' alert-dismissible show p-4">' + msg + '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
			$(sel).html(html);
			$('html, body').animate({
				// scrollTop: $(sel).offset().top - 75
			}, 500);
		}
		$('body').on('click', '.btnUbah', function() {
			url_form = url_form_ubah;
			// console.log(url_form);
			$('#tambah_act').hide();

			var no_telpon = $(this).data('no_telpon');
			var id_siswa = $(this).data('id_siswa');
			var nisn = $(this).data('nis');
			var nama = $(this).data('nama');
			var kelas = $(this).data('id_kelas');
			var jenkel = $(this).data('jenis_kelamin');
			var tempat_lahir = $(this).data('tempat_lahir');
			var tanggal_lahir = $(this).data('tgl_lahir');
			var alamat = $(this).data('alamat');
			var username = $(this).data('username');
			var password = $(this).data('password');
			// console.log(username)
			$('#modal-detail').modal('show');
			// var foto = $(this).data('foto');
			// console.log(kelas)

			$('#id_siswa').val(id_siswa);
			$('#nama').val(nama);
			$('#nama').val(nama);
			$('#alamat').val(alamat);
			$('#jk').val(jenkel);
			$('#tempat_lahir').val(tempat_lahir);
			$('#tanggal_lahir').val(tanggal_lahir);
			$('#username').val(username);
			$('#password').val(password);
			$('#noHP').val(no_telpon);
			$('#Edit').show();
			$("#kelas").val(parseInt(kelas));
			$("#nisn").val(parseInt(nisn));


		});
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

		$('#btnExport').on('click', function() {
			var url = bu + 'Export/master_list_siswa/?';
			window.location = url;
			return (false);

		});

	});
</script>
