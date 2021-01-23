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
									<th>#</th>
									<th>Judul</th>
									<th>Status</th>
									<th>Created</th>
									<th>Updated</th>
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
					<h3 class="box-title">Tambah News</h3>
				</div>

				<form class="form-horizontal" method="post" action="<?= site_url(); ?>admins/news">
					<div class="box-body">

						<div class="form-group">
							<label for="title" class="col-sm-4 control-label">Judul</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="title" name="title" placeholder="title" minlength="3" maxlength="100" value="<?= set_value('username'); ?>" required>
								<?= form_error('title'); ?>
							</div>
						</div>

						<div class="form-group">
							<label for="content" class="col-sm-4 control-label">Content</label>
							<div class="col-sm-8">
								<textarea class="form-control" id="content" name="content" cols="30" rows="10" required></textarea>
								<?= form_error('content'); ?>
							</div>
						</div>

						<div class="form-group">
							<label for="status" class="col-sm-4 control-label">Status</label>
							<div class="col-sm-8">
								<select class="form-control" id="status" name="status" required>
									<option value="show">Show</option>
									<option value="hide">Hide</option>
								</select>
								<?= form_error('verify_password'); ?>
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

<form id="form_edit" action="#" method="post">
	<div class="modal fade" id="modal-edit">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Edit Berita</h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label for="title_edit">Judul</label>
						<input type="text" class="form-control" id="title_edit" name="title_edit" required>
					</div>
					<div class="form-group">
						<label for="content_edit">Content</label>
						<textarea class="form-control" id="content_edit" name="content_edit" cols="30" rows="10" required></textarea>
					</div>
					<div class="form-group">
						<label for="status_edit">Status</label>
						<select class="form-control" id="status_edit" name="status_edit" required>
							<option value="show">Show</option>
							<option value="hide">Hide</option>
						</select>
					</div>
				</div>
				<div class="modal-footer">
					<input type="hidden" id="id_edit" name="id_edit">
					<button type="submit" id="edit_submit" class="btn btn-primary">Edit</button>
					<button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
</form>