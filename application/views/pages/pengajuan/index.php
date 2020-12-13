<section class="content-header">
	<h1><?= $title; ?></h1>
	<ol class="breadcrumb">
		<li><a href="<?= site_url('dashboard'); ?>"><i class="fa fa-home"></i> Home</a></li>
		<li class="active"><i class="fa fa-table"></i> <?= $title; ?></a></li>
	</ol>
</section>

<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-info">
				<div class="box-header">
					<h3 class="box-title">List Pengajuan</h3>
					<div class="box-tools">
						<button type="button" id="refresh_table" class="btn btn-info btn-sm" onclick="refreshTable();" title="Refresh Data">
							<i class="fa fa-refresh"></i>
						</button>
						<a href="<?= site_url(); ?>pengajuan/create" class="btn btn-success btn-sm" title="Tambah Data">
							<i class="fa fa-plus"></i>
						</a>
					</div>
				</div>
				<div class="box-body">
					<div class="table-responsive no-padding">
						<table id="datatables" class="table table-bordered table-hover small" style="width: 100%;">
							<thead>
								<tr>
									<th style="width: 20px;">No Kredit</th>
									<th style="width: 100px;">Marketing</th>
									<th style="width: 100px;">Customer</th>
									<th style="width: 100px;">Alamat</th>
									<th>No Telp</th>
									<th style="width: 100px;">Pekerjaan</th>
									<th style="width: 100px;">Hubungan</th>
									<th style="width: 100px;">Penjamin</th>
									<th style="width: 100px;">Telp Penjamin</th>
									<th style="width: 100px;">Total Angsuran</th>
									<th style="width: 100px;">Tanggal Pengajuan</th>
									<th class="text-center" style="width: 120px;"><i class="fa fa-cogs"></i></th>
								</tr>
							</thead>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>


<div class="modal fade" id="modal_barang">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span></button>
				<h4 class="modal-title">Pengajuan - <span id="no_kredit"></span></h4>
			</div>
			<div class="modal-body">
				<table class="table table-bordered">
					<tbody id="vbarang">
					</tbody>
				</table>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>