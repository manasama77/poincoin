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
									<th class="text-right">Withdraw (B)</th>
									<th class="text-right">Withdraw (Rp)</th>
									<th class="text-right">Rekening</th>
									<th class="text-center">Created</th>
									<th class="text-center">Updated</th>
								</tr>
							</thead>
							<tbody>
								<?php
								if ($arr_stacking->num_rows() > 0) {
								?>
									<?php
									$no = 1;
									foreach ($arr_stacking->result() as $key) {
									?>
										<tr>
											<td><?= $no; ?></td>
											<td><?= $key->kode_withdraw; ?></td>
											<td><?= $key->nama; ?></td>
											<td class="text-right"><?= number_format($key->withdraw_b, 2); ?></td>
											<td class="text-right"><?= number_format($key->withdraw_rp, 0); ?></td>
											<td class="text-center">
												<?= $key->nama_bank; ?> - <?= $key->no_rekening; ?> - <?= $key->atas_nama; ?>
											</td>
											<td class="text-center"><?= $key->created_at; ?></td>
											<td class="text-center"><?= $key->updated_at; ?></td>
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