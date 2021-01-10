<section class="content-header">
	<h1><?= $title; ?></h1>
	<ol class="breadcrumb">
		<li><a href="<?= site_url(); ?>dashboard"><i class="fa fa-home"></i> Home</a></li>
		<li class="active"><i class="fa fa-table"></i> <?= $title; ?></a></li>
	</ol>
</section>

<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-info">
				<div class="box-body">
					<div class="table-responsive">
						<table id="datatables" class="table table-bordered small" style="width: 100%;">
							<thead>
								<tr>
									<th>#</th>
									<th>Kode</th>
									<th>User</th>
									<th class="text-center">Status</th>
									<th class="text-center">Created</th>
									<th class="text-center" style="width: 170px !important;"><i class="fa fa-cogs"></i></th>
								</tr>
							</thead>
							<tbody>
								<?php
								if ($arr_trade->num_rows() > 0) {
								?>
									<?php
									$no = 1;
									foreach ($arr_trade->result() as $key) {
									?>
										<tr>
											<td><?= $no; ?></td>
											<td><?= $key->kode; ?></td>
											<td><?= $key->nama; ?></td>
											<td class="text-center">
												<?php
												if ($key->status == "aktif") {
													echo '<span class="label label-success flataja">Aktif</span>';
												} elseif ($key->status == "pending") {
													echo '<span class="label label-warning flataja">Menunggu Transfer</span>';
												} elseif ($key->status == "menunggu verifikasi") {
													echo '<span class="label label-info flataja">Menunggu Verifikasi</span>';
												} elseif ($key->status == "tidak aktif") {
													echo '<span class="label label-danger flataja">Tidak Aktif</span>';
												}
												?>
											</td>
											<td class="text-center"><?= $key->created_at; ?></td>
											<td class="text-center" style="width: 170px !important;">
												<div class="btn-group">
													<?php
													if ($key->status == "pending") {
													?>
														<button type="button" class="btn btn-primary btn-xs" onclick="verifikasiTransfer('<?= $key->id; ?>', '<?= $key->kode; ?>')">
															<i class="fa fa-check fa-fw"></i> Verifikasi
														</button>
													<?php
													} elseif ($key->status == "menunggu verifikasi") {
													?>
														<a href="<?= base_url('public/img/bukti_transfer_trade/' . $key->bukti_transfer); ?>" class="btn btn-info btn-xs" target="_blank"><i class="fa fa-picture-o"></i></a>
														<button type="button" class="btn btn-primary btn-xs" onclick="verifikasiTransfer('<?= $key->id; ?>', '<?= $key->kode; ?>')">
															<i class="fa fa-check fa-fw"></i> Verifikasi
														</button>
													<?php
													}
													?>
													<button type="button" class="btn btn-danger btn-xs" onclick="deleteData('<?= $key->id; ?>', '<?= $key->kode; ?>')">
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
	</div>
</section>