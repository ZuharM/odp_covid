<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Konsultasi
			<small>Halaman Lihat Konsultasi User</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?= base_url('user'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
			<li class="active">Hasil Konsultasi</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<!-- Default box -->
		<div class="row">
			<div class="col-md-8">
				<div class="box box-primary">
					<div class="box-header with-border">
						<font class="info"><?=$this->session->flashdata('pesan');?></font>
						<h3 class="box-title"> HASIL </h3>
						<div class="box-tools pull-right">
							<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i>
							</button>
							<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i>
							</button>
						</div>
					</div>
					<div class="box-body"> 
						<?php
						if($result['penyakit'] == ""){
							echo 'Anda tidak memiliki riwayat penyakit ';
						} else {
							echo 'Anda memiliki riwayat penyakit '.$result['penyakit'];
						}
						?>
						<br>
						Untuk mendiagnosis Penyakit Corona (Covid 19) dengan tingkat persentase kepercayaan terhadap diagnosis sebesar <b><?= $result['persentase'].'%'; ?>
						<br>
						<?php
						$tampilkan = "";
						if($result['persentase'] >= 98){
							$tampilkan = ' Gelaja Klinis Covid19 saat ini Sedang ';
						} elseif ($result['persentase'] >= 90) {
							$tampilkan = ' Gejala Klinis Covid19 saat ini Rendah ';
						} elseif ($result['persentase'] >= 50) {
							$tampilkan = ' Gejala Klinis Covid19 saat ini tidak ada ';
						} else {
							$tampilkan = ' Gejala Klinis Covid19 saat ini tidak ada ';
						}
						echo $tampilkan;
						?>
						</b>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<!-- small box -->
				<div class="small-box bg-green">
					<div class="inner">
						<h3><?=$result['persentase'];?><sup style="font-size: 20px">%</sup></h3>

						<p><?=$tampilkan;?></p>
					</div>
					<a href="#" class="small-box-footer"> <i class="fa fa-calendar-plus-o"></i> <?= $result['created']; ?></a>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-5">
				<div class="box box-success">
					<div class="box-header with-border">
						<h3 class="box-title"> REKAPITULASI HASIL KONSULTASI </h3>
						<div class="box-tools pull-right">
							<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i>
							</button>
							<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i>
							</button>
						</div>
					</div>
					<div class="box-body"> 
						<table id="example1" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th width="5%">No</th>
									<th>Konsultasi Ke</th>
									<th>Persentase</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								if(count($rekapitulasi) > 0){
									foreach($rekapitulasi as $key => $val){ 
										$hasil = $val['cf_combine'] * 100;
										?>
										<tr>
											<td><?= $key; ?></td>
											<td><?= 'Konsultasi Ke - '.$val['konsultasi_ke']; ?></td>
											<td><?= $hasil.'%'; ?></td>
										</tr>
									<?php } 
								} ?>
							</tbody>
						</table>

					</div>
				</div>
			</div>

			<div class="col-md-7">
				<div class="box box-info">
					<div class="box-header with-border">
						<h3 class="box-title">Grafik Perkembangan Berdasarkan Persen (%)</h3>

						<div class="box-tools pull-right">
							<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
							</button>
							<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
						</div>
					</div>
					<div class="box-body">
						<?php if(count($rekapitulasi) > 1){ ?>
							<div class="chart">
								<canvas id="areaChart" style="height:250px"></canvas>
							</div>
						<?php } else {
							echo '<h3>Grafik akan keluar jika hasil konsultasi lebih dari 1</h3>';
						} ?>
					</div>
					<!-- /.box-body -->
				</div>
			</div>
		</div>
				<!-- /.box -->
	</section>
	<!-- /.content -->
</div>

<script>
  $(function () {
    /* ChartJS
     * -------
     * Here we will create a few charts using ChartJS
     */

    //--------------
    //- AREA CHART -
    //--------------

    // Get context with jQuery - using jQuery's .get() method.
    var areaChartCanvas = $('#areaChart').get(0).getContext('2d')
    // This will get the first returned node in the jQuery collection.
    var areaChart       = new Chart(areaChartCanvas)

    var areaChartData = {
      labels  : [<?= $g_label; ?>],
      datasets: [
        /*{
          label               : 'Electronics',
          fillColor           : 'rgba(210, 214, 222, 1)',
          strokeColor         : 'rgba(210, 214, 222, 1)',
          pointColor          : 'rgba(210, 214, 222, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : [65, 59, 80, 81, 56, 55, 40]
        },*/
        {
          label               : 'Digital Goods',
          fillColor           : 'rgba(60,141,188,0.9)',
          strokeColor         : 'rgba(60,141,188,0.8)',
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [<?= $g_data; ?>]
        }
      ]
    }

    var areaChartOptions = {
      //Boolean - If we should show the scale at all
      showScale               : true,
      //Boolean - Whether grid lines are shown across the chart
      scaleShowGridLines      : false,
      //String - Colour of the grid lines
      scaleGridLineColor      : 'rgba(0,0,0,.05)',
      //Number - Width of the grid lines
      scaleGridLineWidth      : 1,
      //Boolean - Whether to show horizontal lines (except X axis)
      scaleShowHorizontalLines: true,
      //Boolean - Whether to show vertical lines (except Y axis)
      scaleShowVerticalLines  : true,
      //Boolean - Whether the line is curved between points
      bezierCurve             : true,
      //Number - Tension of the bezier curve between points
      bezierCurveTension      : 0.3,
      //Boolean - Whether to show a dot for each point
      pointDot                : false,
      //Number - Radius of each point dot in pixels
      pointDotRadius          : 4,
      //Number - Pixel width of point dot stroke
      pointDotStrokeWidth     : 1,
      //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
      pointHitDetectionRadius : 20,
      //Boolean - Whether to show a stroke for datasets
      datasetStroke           : true,
      //Number - Pixel width of dataset stroke
      datasetStrokeWidth      : 2,
      //Boolean - Whether to fill the dataset with a color
      datasetFill             : true,
      //String - A legend template
      legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].lineColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
      //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
      maintainAspectRatio     : true,
      //Boolean - whether to make the chart responsive to window resizing
      responsive              : true
    }

    //Create the line chart
    areaChart.Line(areaChartData, areaChartOptions)

    //-------------
    //- LINE CHART -
    //--------------
    var lineChartCanvas          = $('#lineChart').get(0).getContext('2d')
    var lineChart                = new Chart(lineChartCanvas)
    var lineChartOptions         = areaChartOptions
    lineChartOptions.datasetFill = false
    lineChart.Line(areaChartData, lineChartOptions)
  })
</script>