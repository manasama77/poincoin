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
									<th class="text-right">Withdraw (Rp)</th>
									<th class="text-right">Rekening</th>
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
											<td><?= $key->kode_withdraw; ?></td>
											<td><?= $key->nama; ?></td>
											<td class="text-right"><?= number_format($key->withdraw_rp, 0); ?></td>
											<td class="text-center">
												<?php
												$rekening = "";
												$rekening = $key->nama_bank . " - " . $key->no_rekening . " - " . $key->atas_nama;

												echo $rekening;
												?>
											</td>
											<td class="text-center"><?= $key->created_at; ?></td>
											<td class="text-center" style="width: 170px !important;">
												<div class="btn-group">
													<button type="button" class="btn btn-primary btn-xs" onclick="verifikasiTransfer('<?= $key->id; ?>', '<?= $key->kode_withdraw; ?>')">
														<i class="fa fa-check fa-fw"></i> Verifikasi
													</button>
													<button type="button" class="btn btn-danger btn-xs" onclick="deleteData('<?= $key->id; ?>', '<?= $key->kode_withdraw; ?>')">
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