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
									<th>Nama</th>
									<th>Email</th>
									<th class="text-right">Investment (B)</th>
									<th class="text-right">Total Transfer (Rp)</th>
									<th class="text-right">Profit / Day (B)</th>
									<th class="text-right">Profit / Day (Rp)</th>
									<th class="text-center">Status</th>
									<th class="text-center">Created</th>
									<th class="text-center" style="width: 170px !important;"><i class="fa fa-cogs"></i></th>
								</tr>
							</thead>
							<tbody>
								<?php
								if ($arr_stacking->num_rows() > 0) {
								?>
									<?php
									$no = $arr_stacking->num_rows();
									foreach ($arr_stacking->result() as $key) {
									?>
										<tr>
											<td><?= $key->id; ?></td>
											<td><?= $key->kode; ?></td>
											<td><?= $key->nama; ?></td>
											<td><?= $key->email; ?></td>
											<td class="text-right"><?= number_format($key->total_investment, 0); ?></td>
											<td class="text-right"><?= number_format($key->total_transfer, 0); ?></td>
											<td class="text-right"><?= number_format($key->profit_perhari_b, 2); ?></td>
											<td class="text-right"><?= number_format($key->profit_perhari_rp, 0); ?></td>
											<td class="text-center">
												<?php
												if ($key->status == "aktif") {
													echo '<span class="label label-success flataja">Aktif</span>';
												} elseif ($key->status == "menunggu_transfer") {
													echo '<span class="label label-warning flataja">Menunggu Transfer</span>';
												} elseif ($key->status == "menunggu_verifikasi") {
													echo '<span class="label label-info flataja">Menunggu Verifikasi</span>';
												} elseif ($key->status == "tidak_aktif") {
													echo '<span class="label label-danger flataja">Tidak Aktif</span>';
												}
												?>
											</td>
											<td class="text-center"><?= $key->created_at; ?></td>
											<td class="text-center" style="width: 170px !important;">
												<?php
												if ($key->status == "menunggu_transfer") {
												?>
													<button type="button" class="btn btn-primary" onclick="verifikasiTransfer('<?= $key->id; ?>', '<?= $key->kode; ?>')">
														<i class="fa fa-check fa-fw"></i> Verifikasi
													</button>
												<?php
												} elseif ($key->status == "menunggu_verifikasi") {
												?>
													<a href="<?= base_url('public/img/bukti_transfer/' . $key->bukti_transfer); ?>" class="btn btn-info" target="_blank"><i class="fa fa-picture-o"></i></a>
													<button type="button" class="btn btn-primary" onclick="verifikasiTransfer('<?= $key->id; ?>', '<?= $key->kode; ?>')">
														<i class="fa fa-check fa-fw"></i> Verifikasi
													</button>
												<?php
												}
												?>
												<button type="button" class="btn btn-danger btn-sm" onclick="deleteData('<?= $key->id; ?>', '<?= $key->kode; ?>')">
													<i class="fa fa-trash fa-fw"></i> Delete
												</button>
											</td>
										</tr>
									<?php
										$no--;
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