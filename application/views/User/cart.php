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

		<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
		<html xmlns="http://www.w3.org/1999/xhtml">

		<head>
			<meta http-equiv="content-type" content="text/html; charset=utf-8" />
			<title>Data Penduduk Indonesia - Jaranguda.com</title>
			<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
			<script src="http://code.highcharts.com/highcharts.js"></script>
			<script type="text/javascript">
				$(function() {
					$('#container').highcharts({
						chart: {
							plotBackgroundColor: null,
							plotBorderWidth: null,
							plotShadow: false
						},
						title: {
							text: 'Data Calon Osis'
						},
						tooltip: {
							pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
						},
						plotOptions: {
							pie: {
								allowPointSelect: true,
								cursor: 'pointer',
								dataLabels: {
									enabled: true,
									format: '<b>{point.name}</b>: {point.percentage:.1f} %',
									style: {
										color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
									}
								}
							}
						},
						series: [{
							type: 'pie',
							name: 'Persentase Calon',
							data: [
								<?php
								// data yang diambil dari database
								if (count($graph) > 0) {
									foreach ($graph as $data) {
										echo "['" . $data->nama_calon . "'," . $data->total . "],\n";
									}
								}
								?>
							]
						}]
					});
				});
			</script>
		</head>

		<body>

			<div id="container"></div>

		</body>

		</html>


	</section>
	<!-- /.content -->
</div>
<!-- DataTables CSS -->
