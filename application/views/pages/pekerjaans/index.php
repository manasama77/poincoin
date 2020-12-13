<section class="content-header">
	<h1><?= $title; ?></h1>
	<ol class="breadcrumb">
		<li><a href="<?= site_url('dashboard'); ?>"><i class="fa fa-home"></i> Home</a></li>
		<li class="active"><i class="fa fa-table"></i> <?= $title; ?></a></li>
	</ol>
</section>

<section class="content">
	<div class="row">
		<div class="col-md-8">
			<div class="box box-info">
				<div class="box-header">
					<h3 class="box-title">List Pekerjaan</h3>
				</div>
				<div class="box-body">
					<div class="table-responsive no-padding">
						<table id="datatables" class="table table-bordered table-stripped table-hover small" style="width: 100%;">
							<thead>
								<tr>
									<th style=" width: 20px;">#</th>
									<th>Nama</th>
									<th class="text-center" style="width: 120px;"><i class="fa fa-cogs"></i></th>
								</tr>
							</thead>
							<tbody>
								<?php
								if ($data->num_rows() > 0) {
								?>
									<?php
									$no = 1;
									foreach ($data->result() as $key) {
									?>
										<tr>
											<td><?= $no; ?></td>
											<td><?= $key->nama; ?></td>
											<td style="width: 120px;" class="text-center">
												<div class="btn-group">
													<button type="button" class="btn btn-info btn-xs" onclick="editData('<?= $key->id; ?>', '<?= $key->nama; ?>');">
														<i class="fa fa-pencil fa-fw"></i> Edit
													</button>
													<button type="button" class="btn btn-danger btn-xs" onclick="destroyData('<?= $key->id; ?>', '<?= $key->nama; ?>');">
														<i class="fa fa-trash fa-fw"></i> Delete
													</button>
												</div>
											</td>
										</tr>
									<?php
										$no++;
									}
									?>
								<?php
								}
								?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-4">
			<div class="box box-info">
				<div class="box-header">
					<h3 class="box-title">Tambah Pekerjaan</h3>
				</div>
				<div class="box-body">
					<form id="form_add" action="#" class="form">
						<div class="form-group">
							<label for="nama">Nama</label>
							<input type="text" name="nama" id="nama" class="form-control" minlength="3" required="required" placeholder="Nama">
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-primary btn-block">Tambah Data</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>

<form id="form_edit">
	<div class="modal fade" id="modal_edit">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span></button>
					<h4 class="modal-title">Edit - <span id="title_edit"></span></h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label for="nama_edit">Nama</label>
						<input type="text" class="form-control" id="nama_edit" name="nama_edit" minlength="3" required>
					</div>
				</div>
				<div class="modal-footer">
					<input type="hidden" id="id_edit" name="id_edit">
					<input type="hidden" id="prev_nama_edit" name="prev_nama_edit">
					<button type="submit" class="btn btn-success">Update</button>
					<button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
</form>