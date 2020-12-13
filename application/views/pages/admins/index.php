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
									<th>Email</th>
									<th>Role</th>
									<th class="text-center" style="min-width: 200px;"><i class="fa fa-cogs"></i></th>
								</tr>
							</thead>
						</table>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xs-4">
			<div class="box box-warning">
				<div class="box-header with-border">
					<h3 class="box-title">Tambah Admin</h3>
				</div>

				<form class="form-horizontal" method="post" action="<?= site_url(); ?>admins">
					<div class="box-body">

						<div class="form-group">
							<label for="email" class="col-sm-5 control-label">Email</label>
							<div class="col-sm-6">
								<input type="email" class="form-control" id="email" name="email" placeholder="Email" minlength="3" maxlength="100" value="<?= set_value('email'); ?>" required>
								<?= form_error('email'); ?>
							</div>
						</div>

						<div class="form-group">
							<label for="password" class="col-sm-5 control-label">Password</label>
							<div class="col-sm-6">
								<input type="password" class="form-control" id="password" name="password" placeholder="Password" minlength="4" maxlength="100" value="<?= set_value('password'); ?>" required>
								<?= form_error('password'); ?>
							</div>
						</div>

						<div class="form-group">
							<label for="verify_password" class="col-sm-5 control-label">Verify Password</label>
							<div class="col-sm-6">
								<input type="password" class="form-control" id="verify_password" name="verify_password" placeholder="Verify Password" minlength="4" maxlength="100" required>
								<?= form_error('verify_password'); ?>
							</div>
						</div>

						<div class="form-group">
							<label for="role" class="col-sm-5 control-label">Role</label>
							<div class="col-sm-6">
								<select class="form-control" id="role" name="role" required>
									<option value=""></option>
									<option value="marketing">Marketing</option>
									<option value="admin">Admin</option>
									<option value="master_admin">Master Admin</option>
								</select>
								<?= form_error('role'); ?>
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

<form id="form_reset" action="#" method="post">
	<div class="modal fade" id="modal-reset">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Reset Password</h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label for="reset_email_text">Email</label>
						<input type="email" class="form-control" id="reset_email_text" name="reset_email_text" disabled>
					</div>
					<div class="form-group">
						<label for="reset_password">New Password</label>
						<input type="password" class="form-control" id="reset_password" name="reset_password" required>
					</div>
				</div>
				<div class="modal-footer">
					<input type="hidden" id="reset_id" name="reset_id">
					<input type="hidden" id="reset_email" name="reset_email">
					<button type="submit" id="reset_submit" class="btn btn-primary">Reset</button>
					<button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
</form>