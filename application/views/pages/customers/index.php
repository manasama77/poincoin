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
					<h3 class="box-title">List User</h3>
					<div class="box-tools">
						<button type="button" id="refresh_table" class="btn btn-info btn-sm" onclick="refreshTable();" title="Refresh Data">
							<i class="fa fa-refresh"></i>
						</button>
						<a href="<?= site_url(); ?>customers/add" class="btn btn-success btn-sm" title="Tambah Data">
							<i class="fa fa-plus"></i>
						</a>
					</div>
				</div>
				<div class="box-body">
					<div class="table-responsive no-padding">
						<table id="datatables" class="table table-bordered table-hover small" style="width: 100%;">
							<thead>
								<tr>
									<th style="width: 20px;">#</th>
									<th style="width: 100px;">No KTP</th>
									<th style="width: 100px;">Nama</th>
									<th style="width: 100px;">Alias</th>
									<th style="width: 100px;">Tgl Lahir</th>
									<th>Alamat</th>
									<th style="width: 100px;">No Telp</th>
									<th style="width: 100px;">Email</th>
									<th style="width: 100px;">Pekerjaan</th>
									<th style="width: 100px;">Hubungan</th>
									<th style="width: 100px;">Nama Penjamin</th>
									<th style="width: 100px;">Telp Penjamin</th>
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


<div class="modal fade" id="modal_ktp">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span></button>
				<h4 class="modal-title">Foto KTP - <span id="nama_user"></span></h4>
			</div>
			<div class="modal-body">
				<img id="foto_ktp_preview" class="img-responsive" src="" alt="Foto KTP" />
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>