<?php
if ($this->session->flashdata('first_login')) {
?>
	<div class="alert alert-info">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<strong><?= $this->session->flashdata('first_login'); ?></strong>
	</div>
<?php
}
?>
<section class="content-header">
	<h1>
		Dashboard
	</h1>
	<ol class="breadcrumb">
		<li class="active"><i class="fa fa-dashboard"></i> Dashboard</li>
	</ol>
</section>

<section class="content">
	<div class="row">
		<div class="col-lg-3 col-xs-6">
			<div class="small-box bg-primary">
				<div class="inner">
					<h3><?= $admin_count; ?></h3>
					<p>Admin</p>
				</div>
				<div class="icon">
					<i class="fa fa-user-secret"></i>
				</div>
				<a href="<?= site_url('admin'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
			</div>
		</div>
		<div class="col-lg-3 col-xs-6">
			<div class="small-box bg-primary">
				<div class="inner">
					<h3><?= $user_count; ?></h3>
					<p>User</p>
				</div>
				<div class="icon">
					<i class="fa fa-users"></i>
				</div>
				<a href="<?= site_url('admin'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
			</div>
		</div>
	</div>
</section>