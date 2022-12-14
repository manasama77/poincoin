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
					</div>
				</div>
				<div class="box-body">
					<div class="table-responsive no-padding">
						<table id="datatables" class="table table-bordered table-hover small" style="width: 100%;">
							<thead>
								<tr>
									<th style="width: 20px;">#</th>
									<th style="width: 100px;">Nama</th>
									<th style="width: 100px;">Email</th>
									<th style="width: 100px;">No HP</th>
									<th style="width: 100px;">No Rekening</th>
									<th style="width: 100px;">No Wallet</th>
									<th style="width: 100px;">Stacking Invest</th>
									<th style="width: 100px;">Stacking Profit</th>
									<th style="width: 100px;">Trade HI</th>
									<th style="width: 100px;">Trade Saldo</th>
									<th style="width: 100px;">Profit Stacking</th>
									<th style="width: 100px;">Profit Trade</th>
									<th class="text-center" style="width: 500px !important;"><i class="fa fa-cogs"></i></th>
								</tr>
							</thead>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<form id="form_email">
	<div class="modal fade" id="modal_email" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Reset Email</h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label for="new_email">Email Baru</label>
						<input type="email" class="form-control" id="new_email" name="new_email" required>
					</div>
				</div>
				<div class="modal-footer">
					<input type="hidden" id="id_email">
					<input type="hidden" id="old_email">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="submit" id="btn_save_email" class="btn btn-primary">Save changes</button>
				</div>
			</div>
		</div>
	</div>
</form>

<form id="form_password">
	<div class="modal fade" id="modal_password" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Reset Password</h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label for="new_password">Password Baru</label>
						<input type="password" class="form-control" id="new_password" name="new_password" autocomplete="new_password" required>
					</div>
				</div>
				<div class="modal-footer">
					<input type="hidden" id="id_password">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="submit" id="btn_save_password" class="btn btn-primary">Save changes</button>
				</div>
			</div>
		</div>
	</div>
</form>

<form id="form_pin">
	<div class="modal fade" id="modal_pin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Reset PIN</h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label for="new_pin">PIN Baru</label>
						<input type="text" class="form-control" id="new_pin" name="new_pin" inputmode="numeric" minlength="6" maxlength="6" pattern="[0-9]*" required>
					</div>
				</div>
				<div class="modal-footer">
					<input type="hidden" id="id_pin">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="submit" id="btn_save_pin" class="btn btn-primary">Save changes</button>
				</div>
			</div>
		</div>
	</div>
</form>

<form id="form_rekening">
	<div class="modal fade" id="modal_rekening" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Reset Rekening</h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label for="id_bank_edit">Bank</label>
						<select class="form-control select2" id="id_bank_edit" name="id_bank_edit" style="width: 100%;" data-placeholder="Bank" required>
							<option value=""></option>
							<?php
							foreach ($arr_bank->result() as $key) {
								echo '<option value="' . $key->id . '">' . $key->nama_bank . '</option>';
							}
							?>
						</select>
					</div>
					<div class="form-group">
						<label for="no_rekening_edit">No Rekening</label>
						<input type="number" class="form-control" id="no_rekening_edit" name="no_rekening_edit" required>
					</div>
					<div class="form-group">
						<label for="atas_nama_edit">Atas Nama</label>
						<input type="text" class="form-control" id="atas_nama_edit" name="atas_nama_edit" required>
					</div>
				</div>
				<div class="modal-footer">
					<input type="hidden" id="id_user_rekening_edit">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="submit" id="btn_save_rekening" class="btn btn-primary">Save changes</button>
				</div>
			</div>
		</div>
	</div>
</form>

<form id="form_wallet">
	<div class="modal fade" id="modal_wallet" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Reset Tronlink Wallet</h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label for="no_rekening_edit">No Wallet</label>
						<input type="text" class="form-control" id="no_wallet_edit" name="no_wallet_edit" required>
					</div>
				</div>
				<div class="modal-footer">
					<input type="hidden" id="id_user_wallet_edit">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="submit" id="btn_save_wallet" class="btn btn-primary">Save changes</button>
				</div>
			</div>
		</div>
	</div>
</form>