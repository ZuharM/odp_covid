<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Konsultasi
			<small>Halaman Konsultasi User</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?= base_url('user'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
			<li class="active">Konsultasi</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<!-- Default box -->
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title"> Daftar Pertanyaan </h3>
				<div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i>
					</button>
					<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i>
					</button>
				</div>
			</div>
			<div class="box-body">
				<form role="form" action="<?=site_url('user/konsultasis/proses'); ?>" method="post">
					<div class="box-body">
						<div class="form-group">
							<label for="">Riwayat penyakit yang anda alami selama ini ?</label>
							<?php foreach ($result as $key => $val) { ?>
								<div class="checkbox">
									<label>
										<input type="checkbox" name="penyakit[]" value="<?= $val['nama']; ?>"> <?= $val['nama']; ?>
									</label>
								</div>
							<?php } ?>
							<input type="text" class="form-control" name="penyakit[]" placeholder="Masukan Nama Penyakit Lainnya, jika lebih dari 1 penyakit pisahkan dengan koma(,)">
						</div>
					</div>
					<!-- /.box-body -->

					<div class="box-footer">
						<button type="submit" class="btn btn-primary">Simpan</button>
					</div>
				</form>
			</div>
		</div>
				<!-- /.box -->
	</section>
	<!-- /.content -->
</div>