<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Laporan
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?= site_url('user');?>"><i class="fa fa-dashboard"></i> home</a></li>
			<li>Laporan</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
	<!-- SELECT2 EXAMPLE -->
	<div class="box box-default">
		<!-- /.box-header -->
		<div class="box-body">
			<div class="row">
				<div class="col-md-12">
					<table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th width="5%">No</th>
								<th width="35%">Nama</th>
								<th width="25%">Riwayat Penyakit</th>
								<th width="20%">Tanggal Konsultasi</th>
								<th width="15%">Actions</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							if(count($result) > 0){
								foreach($result as $key => $val){ ?>
									<tr>
										<td><?= $key + 1; ?></td>
										<td><?= $val['nama_user']; ?></td>
										<td>
											<?= $val['penyakit']; ?>
										</td>
										<td>
											<?= $val['created']; ?>
										</td>
										<td>
											<a href="<?= site_url('admin/view/'.$val['uuid']); ?>" class="btn btn-info btn-xs"><span class="fa fa-bars"></span> Detail</a>
										</td>
									</tr>
								<?php } 
							} ?>
						</tbody>
					</table>
				</div>
			</div>
			<!-- /.row -->
		</div>
		<!-- /.box-body -->
		<div class="box-footer">
			Informasi seluruh Daftar Balita Anda.
		</div>
	</div>
	<!-- /.box -->
	</section>
</div>