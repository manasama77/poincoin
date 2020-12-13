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
									<th>Nama</th>
									<th>Kategori</th>
									<th>Vendor</th>
									<th>Jenis Barang</th>
									<th>Spesifikasi</th>
									<th class="text-right">Harga Beli</th>
									<th class="text-center" style="width: 120px;"><i class="fa fa-cogs"></i></th>
								</tr>
							</thead>
							<tbody>
								<?php
								if (count($barangs) > 0) {
								?>
									<?php
									foreach ($barangs as $key) {
									?>
										<tr>
											<td><?= $key['nama']; ?></td>
											<td><?= $key['nama_kategori']; ?></td>
											<td><?= $key['nama_vendor']; ?></td>
											<td><?= $key['nama_jenis_barang']; ?></td>
											<td><?= $key['spesifikasi']; ?></td>
											<td class="text-right"><?= $key['hpp']; ?></td>
											<td class="text-center" style="width: 120px;">
												<div class="btn-group">
													<button type="button" class="btn btn-info btn-xs" onclick="editData(
														'<?= $key['id_kategori']; ?>', 
														'<?= $key['id_vendor']; ?>', 
														'<?= $key['id_jenis_barang']; ?>', 
														'<?= $key['nama']; ?>', 
														'<?= $key['spesifikasi']; ?>',
														'<?= $key['hpp']; ?>',
														'<?= $key['id']; ?>'
													)">
														<i class="fa fa-pencil fa-fw"></i> Edit
													</button>
													<button type="button" class="btn btn-danger btn-xs" onclick="deleteData('<?= $key['id']; ?>')">
														<i class="fa fa-trash fa-fw"></i> Delete
													</button>
												</div>
											</td>
										</tr>
									<?php
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
		<div class="col-xs-12 col-sm-12 col-md-4">
			<div class="box box-warning">
				<div class="box-header with-border">
					<h3 class="box-title">Tambah Barang</h3>
				</div>

				<form id="form_add" class="form-horizontal" method="post" action="#">
					<div class="box-body">

						<div class="form-group">
							<label for="id_kategori" class="col-sm-4 control-label">Kategori</label>
							<div class="col-sm-8">
								<select id="id_kategori" name="id_kategori" class="form-control" required>
									<option value=""></option>
									<?php
									foreach ($kategoris->result() as $key) {
										echo '<option value="' . $key->id . '">' . $key->nama . '</option>';
									}
									?>
								</select>
							</div>
						</div>

						<div class="form-group">
							<label for="id_vendor" class="col-sm-4 control-label">Vendor</label>
							<div class="col-sm-8">
								<select id="id_vendor" name="id_vendor" class="form-control" onchange="getJenisProduk();" required disabled>
									<option value=""></option>
								</select>
							</div>
						</div>

						<div class="form-group">
							<label for="id_jenis_barang" class="col-sm-4 control-label">Jenis Barang</label>
							<div class="col-sm-8">
								<select id="id_jenis_barang" name="id_jenis_barang" class="form-control" required disabled>
									<option value=""></option>
								</select>
							</div>
						</div>

						<div class="form-group">
							<label for="nama" class="col-sm-4 control-label">Nama Barang</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Barang" minlength="3" maxlength="100" required>
							</div>
						</div>



						<div class="form-group">
							<label for="spesifikasi" class="col-sm-4 control-label">Spesifikasi</label>
							<div class="col-sm-8">
								<textarea class="form-control" id="spesifikasi" name="spesifikasi" cols=" 30" rows="10" placeholder="Spesifikasi"></textarea>
							</div>
						</div>

						<div class="form-group">
							<label for="hpp" class="col-sm-4 control-label">Harga Beli</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="hpp" name="hpp" placeholder="Harga Beli" maxlength="19" required>
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

<form id="form_edit" class="form-horizontal" action="#" method="post">
	<div class="modal fade" id="modal_edit">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Edit</h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label for="id_kategori_edit" class="col-sm-3 control-label">Kategori</label>
						<div class="col-sm-9">
							<select id="id_kategori_edit" name="id_kategori_edit" class="form-control" required>
								<option value=""></option>
								<?php
								foreach ($kategoris->result() as $key) {
									echo '<option value="' . $key->id . '">' . $key->nama . '</option>';
								}
								?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="id_vendor_edit" class="col-sm-3 control-label">Vendor</label>
						<div class="col-sm-9">
							<select id="id_vendor_edit" name="id_vendor_edit" class="form-control" required disabled>
								<option value=""></option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="id_jenis_barang_edit" class="col-sm-3 control-label">Jenis barang</label>
						<div class="col-sm-9">
							<select id="id_jenis_barang_edit" name="id_jenis_barang_edit" class="form-control" required disabled>
								<option value=""></option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="nama_edit" class="col-sm-3 control-label">Nama</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="nama_edit" name="nama_edit" placeholder="Nama" minlength="3" maxlength="100" required>
						</div>
					</div>
					<div class="form-group">
						<label for="spesifikasi_edit" class="col-sm-3 control-label">Spesifikasi</label>
						<div class="col-sm-9">
							<textarea class="form-control" id="spesifikasi_edit" name="spesifikasi_edit" cols=" 30" rows="10" placeholder="Spesifikasi"></textarea>
						</div>
					</div>
					<div class="form-group">
						<label for="hpp_edit" class="col-sm-3 control-label">HPP</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="hpp_edit" name="hpp_edit" placeholder="HPP" required>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<input type="hidden" id="id_edit" name="id_edit">
					<input type="hidden" id="prev_id_jenis_barang" name="prev_id_jenis_barang">
					<input type="hidden" id="prev_nama" name="prev_nama">
					<button type="submit" class="btn btn-primary">Edit</button>
					<button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
</form>