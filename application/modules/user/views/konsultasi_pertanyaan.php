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
				<form action="<?=site_url('user/konsultasis/proses_pertanyaan'); ?>" method="post">
					<input type="hidden" name="uuid" value="<?= $uuid; ?>">
					<div class="box-body">
						<?php foreach ($indikator as $key => $val) { 
							$no = $key + 1; ?>
							<div class="form-group">
								<label for=""><?= $no.'. '.$val['pertanyaan_konten']; ?></label>
								<input type="hidden" name="indikatorid[]" value="<?= $val['indikatorid']; ?>">
								<?php foreach ($val['bobot'] as $keys => $vals) { ?>
									<div class="radio">
										<label>
											<input type="radio" name="jawaban_<?= $val['indikatorid'] ?>" id="jawaban_<?= $val['indikatorid'] ?>" value="<?= $vals['id'] ?>" required> <?= $vals['nama'] ?>
										</label>
									</div>
								<?php } ?>
							</div>
						<?php } ?>
					</div>
					<!-- /.box-body -->
					<div class="box-footer">
						<button type="submit" class="btn btn-info pull"> Proses </button>
					</div>
					<!-- /.box-footer -->
				</form>
			</div>
		</div>
				<!-- /.box -->
	</section>
	<!-- /.content -->
</div>