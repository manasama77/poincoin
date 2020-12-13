<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Bioner | Admin Log in</title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="icon" type="image/x-icon" href="<?= base_url(); ?>favicon.ico">
	<link rel="stylesheet" href="<?= base_url(); ?>vendor/almasaeed2010/adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?= base_url(); ?>vendor/almasaeed2010/adminlte/bower_components/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?= base_url(); ?>vendor/almasaeed2010/adminlte/bower_components/Ionicons/css/ionicons.min.css">
	<link rel="stylesheet" href="<?= base_url(); ?>vendor/almasaeed2010/adminlte/dist/css/AdminLTE.min.css">
	<link rel="stylesheet" href="<?= base_url(); ?>vendor/almasaeed2010/adminlte/plugins/iCheck/square/blue.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition login-page">
	<div class="login-box">
		<div class="login-logo">
			<a href="<?= site_url(); ?>">
				<img src="<?= base_url(); ?>public/img/logo.png" style="width: 150px !important;" />
				<p><b>BIONER</b>ADMIN</p>
			</a>
		</div>
		<div class="login-box-body">
			<?php
			if ($this->session->flashdata('expired')) {
			?>
				<div class="alert alert-info">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<strong><?= $this->session->flashdata('expired'); ?></strong>
				</div>
			<?php
			}
			?>

			<?php
			if ($this->session->flashdata('logout')) {
			?>
				<div class="alert alert-success">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<strong><?= $this->session->flashdata('logout'); ?></strong>
				</div>
			<?php
			}
			?>

			<?php
			if ($this->session->flashdata('unknown')) {
			?>
				<div class="alert alert-danger">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<strong><?= $this->session->flashdata('unknown'); ?></strong>
				</div>
			<?php
			}
			?>

			<form class="form" action="<?= site_url(); ?>login" method="post">
				<div class="form-group has-feedback">
					<input type="username" class="form-control" placeholder="Username" name="username" value="<?= set_value('username'); ?>" required>
					<span class="glyphicon glyphicon-user form-control-feedback"></span>
					<?php echo form_error('username'); ?>
				</div>
				<div class="form-group has-feedback">
					<input type="password" class="form-control" placeholder="Password" name="password" minlength="4" required>
					<span class="glyphicon glyphicon-lock form-control-feedback"></span>
					<?php echo form_error('password'); ?>
				</div>
				<div class="row">
					<div class="col-xs-8">
						<div class="checkbox icheck">
							<label>
								<input type="checkbox" name="remember" value="on"> Remember Me
							</label>
						</div>
					</div>
					<div class="col-xs-4">
						<button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
					</div>
				</div>
			</form>

			<!-- <a href="#">Lupa Password?</a> -->

		</div>
	</div>

	<script src="<?= base_url(); ?>vendor/almasaeed2010/adminlte/bower_components/jquery/dist/jquery.min.js"></script>
	<script src="<?= base_url(); ?>vendor/almasaeed2010/adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
	<script src="<?= base_url(); ?>vendor/almasaeed2010/adminlte/plugins/iCheck/icheck.min.js"></script>
	<script>
		$(function() {
			$('input').iCheck({
				checkboxClass: 'icheckbox_square-blue',
				radioClass: 'iradio_square-blue',
				increaseArea: '20%'
			});
		});
	</script>
</body>

</html>