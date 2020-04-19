<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Daftar Wilayah
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?= site_url();?>"><i class="fa fa-dashboard"></i> home</a></li>
			<li>Wilayah</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
	<!-- SELECT2 EXAMPLE -->
	<div class="box box-default">
		<?php 
		$show = $result_edit['id'] == "" ? "Tambah" : "Edit"; ?>
		<div class="box-header with-border col-md-12">
			<h1><?=$show?> Data</h1>
			<form class="form-horizontal" id="frmwilayah" action="<?=site_url('admin/area_transmisis/proses'); ?>" method="post">
				<input type="hidden" name="wilayahid" value="<?=$result_edit['id']?>">
				<div class="box-body">
					<div class="form-group">
						<label for="golongan" class="col-sm-2 control-label">Nama Wilayah <font color="red">*</font></label>
						<div class="col-sm-6">
							<input type="text" class="form-control" name="nama" id="nama" value="<?=$result_edit['nama']?>" placeholder="Nama Wilayah" required>
						</div>
						<div class="col-sm-4">
					
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<button type="submit" class="btn btn-info pull-left"><?=$show?></button>
						</div>
					</div>
				</div>
			</form>
		</div>
		<!-- /.box-header -->
		<div class="box-body">
			<div class="row">
				<div class="col-md-12">
					<font class="info"><?=$this->session->flashdata('pesan');?></font>
					<table id="example1" class="table table-bordered table-striped">
						<thead>
						<tr>
							<th width="10%">No</th>
							<th width="65%">Nama Wilayah</th>
							<th width="25%">Actions</th>
						</tr>
						</thead>
						<tbody>
						<?php 
						if(count($result) > 0){
						foreach($result as $key => $val){ ?>
						<tr>
							<td><?= $key + 1; ?></td>
							<td><?= $val['nama'] ?></td>
							<td>
								<a href="<?= site_url('admin/area_transmisis/index/'.$val['id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Edit</a> 
								<a href="<?= site_url('admin/area_transmisis/remove/'.$val['id']); ?>" class="btn btn-danger btn-xs" onclick="return confirm('Mau Menghapus Data ini... ?')"><span class="fa fa-trash"></span> Delete</a>
							</td>
						</tr>
						<?php } }?>
						</tbody>
					</table>
				</div>
			</div>
			<!-- /.row -->
		</div>
		<!-- /.box-body -->
		<div class="box-footer">
			Informasi seluruh Daftar Wilayah.
		</div>
	</div>
	<!-- /.box -->
	</section>
</div>