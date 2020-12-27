<aside class="main-sidebar">
	<section class="sidebar">
		<ul class="sidebar-menu" data-widget="tree">
			<li class="header">Navigation</li>
			<li class="active">
				<a href="<?= site_url('dashboard'); ?>">
					<i class="fa fa-dashboard"></i> <span>Dashboard</span>
				</a>
			</li>
			<li class="header">Bioner Stacking</li>
			<li class="treeview">
				<a href="#">
					<i class="fa fa-archive"></i>
					<span>Bioner Stacking</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					<li>
						<a href="<?= site_url(); ?>admin/bioner_stacking/index">
							<i class="fa fa-circle-o"></i> List Bioner Stacking
						</a>
					</li>
					<li>
						<a href="<?= site_url(); ?>admin/bioner_stacking/verifikasi_transfer">
							<i class="fa fa-circle-o"></i> List Verifikasi Transfer
						</a>
					</li>
				</ul>
			</li>
			<!-- <li class="header">Pengajuan</li>
			<li class="treeview">
				<a href="#">
					<i class="fa fa-archive"></i>
					<span>Pengajuan</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					<li>
						<a href="<?= site_url(); ?>pengajuan">
							<i class="fa fa-circle-o"></i> List Pengajuan
						</a>
					</li>
					<li>
						<a href="<?= site_url(); ?>pengajuan/create">
							<i class="fa fa-plus"></i> Add Pengajuan
						</a>
					</li>
					<li>
						<a href="<?= site_url('verifikasi_pengajuan'); ?>">
							<i class="fa fa-check"></i> <span>Verifikasi Pengajuan</span>
						</a>
					</li>
				</ul>
			</li> -->
			<li class="header">Setup</li>
			<li class="">
				<a href="<?= site_url('admins'); ?>">
					<i class="fa fa-user-secret"></i> <span>Admin Management</span>
				</a>
			</li>
		</ul>
	</section>
</aside>