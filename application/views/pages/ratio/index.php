<section class="content-header">
	<h1><?= $title; ?></h1>
	<ol class="breadcrumb">
		<li><a href="<?= site_url(); ?>dashboard"><i class="fa fa-home"></i> Home</a></li>
		<li class="active"><i class="fa fa-table"></i> <?= $title; ?></a></li>
	</ol>
</section>

<section class="content">
	<div class="row">
		<div class="col-md-8">
			<div class="box box-info">
				<div class="box-body">
					<div class="table-responsive">
						<table id="datatables" class="table table-bordered small" style="width: 100%;">
							<thead>
								<tr>
									<th>Tanggal</th>
									<th>TRX</th>
									<th>PC</th>
									<th class="text-center" style="min-width: 200px;"><i class="fa fa-cogs"></i></th>
								</tr>
							</thead>
						</table>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xs-12 col-sm-12 col-lg-4">
			<div class="box box-warning">
				<div class="box-header with-border">
					<h3 class="box-title">Tambah Ratio</h3>
				</div>

				<form class="form-horizontal" method="post" action="<?= site_url(); ?>admins/ratio">
					<div class="box-body">

						<div class="form-group">
							<label for="tanggal" class="col-sm-5 control-label">Tanggal</label>
							<div class="col-sm-12 col-md-7 col-lg-7">
								<input type="date" class="form-control" id="tanggal" name="tanggal" placeholder="TANGGAL" value="<?= set_value('tanggal'); ?>" required>
								<?= form_error('tanggal'); ?>
							</div>
						</div>

						<div class="form-group">
							<label for="trx" class="col-sm-5 control-label">TRON (TRX)</label>
							<div class="col-sm-12 col-md-4 col-lg-4">
								<input type="number" class="form-control" id="trx" name="trx" placeholder="VALUE" min="1" max="10" value="<?= set_value('trx'); ?>" required>
								<?= form_error('trx'); ?>
							</div>
						</div>

						<div class="form-group">
							<label for="bnr" class="col-sm-5 control-label">Poincoin (PC)</label>
							<div class="col-sm-12 col-md-4 col-lg-4">
								<input type="number" class="form-control" id="bnr" name="bnr" placeholder="VALUE" min="1" max="10" value="<?= set_value('bnr'); ?>" required>
								<?= form_error('bnr'); ?>
							</div>
						</div>

					</div>
					<div class="box-footer">
						<button type="submit" class="btn btn-warning btn-block">Tambah</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>

<form id="form_edit" class="form-horizontal">
	<div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Edit TRX/PC</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<div class="form-group">
								<label for="tanggal_edit" class="col-sm-3 control-label">Tanggal</label>
								<div class="col-sm-12 col-md-4 col-lg-4">
									<input type="date" class="form-control" id="tanggal_edit" name="tanggal_edit" placeholder="Tanggal" value="<?= set_value('tanggal_edit'); ?>" required>
									<?= form_error('tanggal_edit'); ?>
								</div>
							</div>

							<div class="form-group">
								<label for="trx_edit" class="col-sm-3 control-label">TRON (TRX)</label>
								<div class="col-sm-12 col-md-4 col-lg-4">
									<input type="number" class="form-control" id="trx_edit" name="trx_edit" placeholder="VALUE" min="1" max="10" value="<?= set_value('trx_edit'); ?>" required>
									<?= form_error('trx_edit'); ?>
								</div>
							</div>

							<div class="form-group">
								<label for="bnr_edit" class="col-sm-3 control-label">Poincoin (PC)</label>
								<div class="col-sm-12 col-md-4 col-lg-4">
									<input type="number" class="form-control" id="bnr_edit" name="bnr_edit" placeholder="VALUE" min="1" max="10" value="<?= set_value('bnr_edit'); ?>" required>
									<?= form_error('bnr_edit'); ?>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<input type="hidden" id="id_edit" name="id_edit">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="submit" id="edit_submit" class="btn btn-primary">Save changes</button>
				</div>
			</div>
		</div>
	</div>
</form>