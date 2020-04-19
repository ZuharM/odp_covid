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
		<?php if(count($konsultasi) > 0){ ?>
			<div class="row">
				<?php foreach ($konsultasi as $keyt => $valt) { ?>
					<div class="col-lg-3 col-xs-6">
						<!-- small box -->
						<div class="small-box bg-aqua">
							<div class="inner">
								<p>Konsultasi</p>
								<h3>Ke - <?= $valt['konsultasi']; ?></h3>

							</div>
							<div class="icon">
								<i class="fa fa-heartbeat"></i>
							</div>
							<a href="<?= base_url('user/konsultasis/uuid/'.$valt['uuid']) ?>" class="small-box-footer">
								Lanjutkan Konsultasi <i class="fa fa-arrow-circle-right"></i>
							</a>
						</div>
					</div>
				<?php } ?>
			</div>
		<?php } ?>

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

						<div class="form-group">
							<label for=""><?= $pertanyaan[0]['pertanyaan_konten']; ?></label>
							<input type="hidden" name="pertanyaan" value="<?= $pertanyaan[0]['indikatorid']; ?>">
							<?php foreach ($pertanyaan[0]['bobot'] as $keys => $vals) { ?>
								<div class="radio">
									<label>
										<input type="radio" name="jawaban" class="jawaban" id="jawaban" value="<?= $vals['id'] ?>" required> <?= $vals['nama'] ?>
									</label>
								</div>
							<?php } ?>
						</div>

						<div class="form-group area" hidden="hidden">
							<input type="hidden" name="choose" id="choose" value="0">
							<label for=""> Pilih Wilayah Area Transmisi </label>
							<div class="clearfix"></div>
							<div class="col-sm-6">
								<?= form_dropdown('wilayahid', $wilayah, '', 'class="form-control wilayahid" id="wilayahid" onChange="tampilDetail()" required'); ?>
							</div>
							<div class="col-sm-6">
								<?= form_dropdown('wilayahdetailid', $wilayahdetail, '', 'class="form-control" id="wilayahdetailid" required'); ?>
							</div>
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

<script type="text/javascript">
	$(function () {
		$(".jawaban").click(function(){
			var key = $(this).val();
			if(key != 1){
				$('.area').show();
				$('#choose').val(1);
			} else {
				$('.area').hide();
				$('#choose').val(0);
			}
		});
	});

	function tampilDetail(){
		wilayahid = $(".wilayahid").val();
		$.ajax({
			url: base_url + "ajax_function/get_detail",
			type: "POST",
			data: { wilayahid : wilayahid },
			dataType: "html",
			cache: false,
			success: function(response){
				$("#wilayahdetailid").html(response);
			}

		});
	}
</script>