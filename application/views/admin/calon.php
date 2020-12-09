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
		<a href="javascript:void(0)" data-toggle="modal" data-target="#modal-detail" class="btn m-t-18 btn-info waves-effect waves-light btnTambah">
			<i class="ti-plus"></i> Tambah Siswa Baru
		</a>
		<span class="col-lg-2 col-md-3 col-sm-6 col-xs-12 px-0 my-1">
			<a class="btn m-t-20 btn-info waves-effect waves-light" href="" id="btnExport"> <i class="fas fa-download"></i> EXPORT </a>
		</span>
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
							<th>Nama</th>
							<th>NIS</th>
							<th>Kelas</th>
							<th>Visi</th>
							<th>Misi</th>
							<th>Foto</th>
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
							<h4>Detail Calon</h4>

							<div class="row">
								<div class="col-md-12 col-sm-12 ">
									<div class="x_panel">
										<div class="x_content">
											<br />
											<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
												<div class="row">
													<input id="id_siswa" name="id_siswa" class="form-control " readonly type="hidden" class="form-control">

													<div class=" form-group col-md-6 col-sm-6 ">
														<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name"> NISN <span class="required">*</span>
														</label>
														<input id="nisn" name="nisn" class="form-control " placeholder="Isikan NISN" readonly type="number" class="form-control">
													</div>

													<div class="item form-group col-md-6 col-sm-6">
														<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name"> Nama <span class="required">*</span>
														</label>
														<div class="">
															<input id="nama" name="nama" class="form-control " placeholder="Isikan Nama" type="text" class="form-control">
														</div>
													</div>

												</div>
												<div class="row">
													<div class="item form-group col-md-12 col-sm-12 ">
														<label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Kelas <span class="required">*</span>
														</label>
														<div class="">
															<select class="form-control " name="kelas" id="kelas">
																<option value="default" desable>Pilih Kelas</option>
																<option value="10">X</option>
																<option value="11">XI</option>
																<option value="12">XII</option>
															</select>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="item form-group col-md-12 col-sm-12 ">
														<label class="col-form-label label-align" for="last-name">Visi<span class="required">*</span>
														</label>
														<div class="form-group">
															<textarea id="visi" class="form-control" name="visi" rows="3"></textarea>
														</div>

													</div>
												</div>
												<div class="row">
													<div class="item form-group col-md-12 col-sm-12 ">
														<label class="col-form-label label-align" for="last-name">Misi<span class="required">*</span>
														</label>
														<div class="form-group">
															<textarea id="misi" class="form-control" name="misi" rows="3"></textarea>
														</div>

													</div>
												</div>
												<div class="row">

													<div class="item form-group col-md-6 col-sm-6 ">
														<div class="form-group">
															<label for="foto_wrapper">Foto KTP</label>
															<div id="foto_wrapper" class="mb-2"></div>
															<div class="custom-file">
																<br>
																<input type="file" accept="image/x-png,image/gif,image/jpeg,image/jpg;" name="foto" id="foto" class="dropzone biz-dropzone">

																<br /><br />
																<span class="biz-text-10">
																	<ul id="listFoto"></ul>
																</span>
															</div>
															<small></small>
														</div>
													</div>
													<!-- <div class="item form-group col-md-6 col-sm-6 ">
														<label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Foto <span class="required">*</span>
															<input type="file" name="foto" id="foto">
														</label>
													</div> -->

												</div>
												<div class="ln_solid"></div>
												<div class="item form-group">
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							<button type="button" class="btn btn-primary" id="Edit">Save changes</button>

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

		var url_form_tambah = bu + 'Calon/tambah_calon_proses';
		var url_form_ubah = bu + 'Calon/ubah_siswa_proses';
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
				{
					"targets": 3,
					"className": "dt-body-center dt-head-center"
				},
				{
					"targets": 4,
					"className": "dt-body-center dt-head-center",
				},
			],
			"order": [
				[2, "desc"]
			],
			'ajax': {
				url: bu + 'Calon/getAllCalon',
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

		function cekNama() {
			var nama = $('#nama').val();
			console.log(nama);
			if (nama == '') {
				validasi('#nama', false, 'Silahkan Isi Nama');
				return false;
			} else {
				validasi('#nama', true);
				return true;
			}
		}

		function cekNIS() {
			var nis = $('#nis').val();
			console.log(nis);

			if (nis == '') {
				validasi('#nis', false, 'Silahkan Isi NIS');
				return false;
			} else {
				validasi('#nis', true);
				return true;
			}
		}

		function cekKelas() {
			var kelas = $('#kelas option:selected').val();
			console.log(kelas);

			if (kelas == '') {
				validasi('#kelas', false, 'Silahkan Isi kelas');
				return false;
			} else {
				validasi('#kelas', true);
				return true;
			}
		}

		function cekJenKel() {
			var jen_kel = $('#jen_kel option:selected').val();
			console.log(jen_kel);

			if (jen_kel == '') {
				validasi('#jen_kel', false, 'Silahkan Isi jen_kel');
				return false;
			} else {
				validasi('#jen_kel', true);
				return true;
			}
		}

		function cektanggal_lahir() {
			var tanggal_lahir = $('#tanggal_lahir').val();
			console.log(tanggal_lahir);

			if (tanggal_lahir == '') {
				validasi('#tanggal_lahir', false, 'Silahkan Isi tanggal_lahir');
				return false;
			} else {
				validasi('#tanggal_lahir', true);
				return true;
			}
		}

		function cekAlamat() {
			var alamat = $('#alamat').val();
			console.log(alamat);

			if (alamat == '') {
				validasi('#alamat', false, 'Silahkan Isi Alamat');
				return false;
			} else {
				validasi('#alamat', true);
				return true;
			}
		}
		$('#tambah_act').on('click', function() {

			var nisn = $('#nisn').val();
			var nama = $('#nama').val();
			var alamat = $('#alamat').val();
			var kelas = $('#kelas').val();
			var jenis_kelamin = $('#jk').val();
			var tanggal_lahir = $('#tanggal_lahir').val();
			var tempat_lahir = $('#tempat_lahir').val();
			var user_name = $('#username').val();
			var password = $('#password').val();

			if (
				nama && kelas
			) {
				$("#form").submit();

			}
			// return false;
		});
		$('#btnTambah').on('click', function() {
			var _cekNama = cekNama();
			var _cekNIS = cekNIS();
			var _cekKelas = cekKelas();
			var _cektanggal_lahir = cektanggal_lahir();
			var _JenKel = cekJenKel();
			var _Alamat = cekAlamat();
			if (
				_cekKelas && _cekNIS && _cekNama && _cektanggal_lahir && _Alamat && _JenKel
			) {
				return false;

				$("#form").submit();
			}
			$('#btnTambah').show();
			return false;

		});

		function notifikasi(sel, msg, err) {
			var alert_type = 'alert-success ';
			if (err) alert_type = 'alert-danger ';
			var html = '<div class="alert ' + alert_type + ' alert-dismissible show p-4">' + msg + '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
			$(sel).html(html);
			$('html, body').animate({
				// scrollTop: $(sel).offset().top - 75
			}, 500);
		}
		$('.btnTambah').on('click', function() {
			url_form = url_form_tambah;
			// url_form = url_form_tambah;
			// console.log(url_form);
			$('#Edit').hide();
			$("#nisn").removeAttr('readonly');
			$('.modalProdukTitleTambah').show();
			$('.modalProdukTitleUbah').hide();

			$('#btnTambah').show();
			$('#btnUbah').hide();
			$('#btnCopy').hide();
			$('#btnTampil').hide();
			$('.modalFotoUbah').hide();
			$('#listFoto').html('');
			$('#foto_wrappers').html('');
		});
		$("#form").submit(function(e) {
			console.log('form submitted');
			// return false;
			$.ajax({
				url: url_form,
				method: 'post',
				dataType: 'json',
				data: new FormData(this),
				processData: false,
				contentType: false,
				cache: false,
				async: false,
			}).done(function(e) {
				console.log(e);
				// return false
				if (e.status) {
					notifikasi('#alertNotif', e.message, false);
					$('#modal-detail').modal('hide');
					datatable.ajax.reload();
					Swal.fire(
						':)',
						e.message,
						'success'
					);
				} else {
					notifikasiModal('#modalProduk', '#alertNotifModal', e.message, true);
					Swal.fire({
						icon: 'error',
						title: 'Oops...',
						text: 'terjadi kesalahan!',

					})

				}
			}).fail(function(e) {
				// console.log(e);
				notifikasi('#alertNotif', 'Terjadi kesalahan!', true);
			});
			return false;
		});

		$('body').on('click', '.btnHapus', function() {
			var id_siswa = $(this).data('id_siswa');
			var nama = $(this).data('nama');
			Swal.fire({
				title: 'Apakah Anda Yakin ?',
				text: "Anda akan Menghapus Siswa: " + nama,
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Yes, delete it!'
			}).then((result) => {

				if (result.value) {
					$.ajax({
						url: bu + 'admin/hapusSiswa',
						dataType: 'json',
						method: 'POST',
						data: {
							id_siswa: id_siswa
						}
					}).done(function(e) {
						// console.log(e);
						Swal.fire(
							'Deleted!',
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
			})




		});
		$('body').on('click', '.btnUbah', function() {
			url_form = url_form_ubah;
			// console.log(url_form);
			$('#tambah_act').hide();

			var id_calon = $(this).data('id_calon');
			var nama = $(this).data('nama_calon');
			var kelas = $(this).data('kelas_calon');
			var visi = $(this).data('visi');
			var misi = $(this).data('misi');
			var nis = $(this).data('nis');
			$('#modal-detail').modal('show');
			$('#id_siswa').val(id_calon);
			$("#nisn").val(parseInt(nis));
			$('#visi').val(visi);
			$('#misi').val(misi);
			$('#nama').val(nama);
			$("#kelas").val(parseInt(kelas));
			$('#Edit').show();

		});

		$('#Edit').on('click', function() {
			var id_siswa = $('#id_siswa').val();
			var nis = $('#nis').val();
			var nama = $('#nama').val();
			var kelas = $('#kelas').val();
			var misi = $('#misi').val();
			var visi = $('#visi').val();
			if (
				nama && kelas && visi && misi
			) {
				$("#form").submit();
			}
		});

		$('#btnExport').on('click', function() {
			var url = bu + 'Export/master_list_siswa/?';
			window.location = url;
			return (false);

		});

	});
</script>
