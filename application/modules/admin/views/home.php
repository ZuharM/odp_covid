<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Beranda
			<small>detail</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?= base_url('admin') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
			<li class="active">Beranda</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">

		<?php /* ?>
		<div class="row">
			<div class="col-lg-3 col-xs-6">
				<!-- small box -->
				<div class="small-box bg-aqua">
					<div class="inner">
						<h3><?= $total_posyandu; ?></h3>

						<p>Posyandu</p>
					</div>
					<div class="icon">
						<i class="fa fa-ambulance"></i>
					</div>
					<a href="<?= base_url('admin/posyandus'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>
			<!-- ./col -->
			<div class="col-lg-3 col-xs-6">
				<!-- small box -->
				<div class="small-box bg-green">
					<div class="inner">
						<h3><?= $total_balita; ?></h3>

						<p>Registrasi Balita</p>
					</div>
					<div class="icon">
						<i class="fa fa-child"></i>
					</div>
					<a href="<?= base_url('admin/balitas'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>
			<!-- ./col -->
			<div class="col-lg-3 col-xs-6">
				<!-- small box -->
				<div class="small-box bg-yellow">
					<div class="inner">
						<h3><?= $total_bumil; ?></h3>

						<p>Registrasi Ibu Hamil</p>
					</div>
					<div class="icon">
						<i class="fa fa-wheelchair"></i>
					</div>
					<a href="<?= base_url('admin/bumils'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>
			<!-- ./col -->
			<div class="col-lg-3 col-xs-6">
				<!-- small box -->
				<div class="small-box bg-red">
					<div class="inner">
						<h3><?= $total_kader; ?></h3>

						<p>Total Kader</p>
					</div>
					<div class="icon">
						<i class="fa fa-user"></i>
					</div>
					<a href="<?= base_url('admin/kaders'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>
			<!-- ./col -->
		</div>
		<?php */ ?>

		<!-- Default box -->
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title">Halaman Admin</h3>

				<div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
					title="Collapse">
					<i class="fa fa-minus"></i></button>
					<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i>
					</button>
				</div>
			</div>
			<div class="box-body">
				Selamat Datang
			</div>
			<!-- /.box-body -->
			<div class="box-footer">
				Aplikasi PCOVID19 memberikan informasi dan resume data klinis pasien. Update data area transmisi secara berkala.
			</div>
			<!-- /.box-footer-->
		</div>
		<!-- /.box -->

	</section>
	<!-- /.content -->
</div>