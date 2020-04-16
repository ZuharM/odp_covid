<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Konsultasi
			<small>Halaman Lihat Konsultasi User</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?= base_url('admin'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
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
						<h3 class="box-title"> HASIL Konsultasi Atas Nama: <b><?= $result['nama_user']; ?></b></h3>
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
							$tampilkan = ' Anda telah terpapar covid-19 segera Kerumah sakit! ';
						} elseif ($result['persentase'] >= 90) {
							$tampilkan = ' Anda kemungkinan terpapar covid-19 ';
						} elseif ($result['persentase'] >= 50) {
							$tampilkan = ' Tingkatkan imunitas anda ';
						} else {
							$tampilkan = ' Anda tidak terpapar Covid-19 ';
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
				<!-- /.box -->
	</section>
	<!-- /.content -->
</div>