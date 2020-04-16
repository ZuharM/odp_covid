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
			<?php echo $this->session->flashdata("pesan"); ?>
			<?php 
			if(isset($data_imun)){ 
				foreach($data_imun as $value_imun); ?>
				<div class='alert alert-info' role='alert'>Persentase :  <b><?php echo $value_imun->cf_combine*100; ?> %</b></div> <?php
			} ?>
				<form role="form" action="<?=site_url('user/konsultasis/save_jawaban'); ?>" method="post">
					<div class="box-body">
						<input type="hidden" name="user_id" value="<?php echo $this->session->userdata('userid'); ?>"><?php 
						if(isset($jawab_soal)){ ?>
							<input type="hidden" name="update" value="1"><?php 
							//print_r($jawab_soal);
						}
						$no=1;
						foreach ($soal as $key => $val) { ?>
							<div class="form-group">
								<label for="" class="col-sm-12 control-label"><?= $no.'. '.$val['pertanyaan_konten']; ?> </label>
								<div class="col-sm-3">
									<input type="hidden" class="form-control" value="<?= $val['pertanyaan_id']; ?>"><?php 
									$pil_jawaban = json_decode($val['pil_jawaban'], true); ?> <?php
									foreach($bobot as $key1 => $val1) { 
										if (in_array($val1['id'], $pil_jawaban)){
											if(isset($jawab_soal[$val['pertanyaan_id']]) && $jawab_soal[$val['pertanyaan_id']] == $val1['id']){?>
												<div class="radio">
													<label>
													<input type="radio" name="jwb_pertanyaan[<?= $val['pertanyaan_id']; ?>]" id="optionsRadios1" value="<?php echo $val1['id']; ?>" checked required><?php echo $val1['nama']; ?> 
													</label>
												</div> <?php
											}else{?>
												<div class="radio">
													<label>
													<input type="radio" name="jwb_pertanyaan[<?= $val['pertanyaan_id']; ?>]" id="optionsRadios1" value="<?php echo $val1['id']; ?>" required><?php echo $val1['nama']; ?> 
													</label>
												</div><?php
											}
										}
										} ?>
								</div>
							</div><?php
							$no++;
					 	} ?>
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