<aside class="main-sidebar">
	<section class="sidebar">
		<ul class="sidebar-menu" data-widget="tree">
			<li class="header">Navigation</li>
			<li class="active">
				<a href="<?= site_url('dashboard'); ?>">
					<i class="fa fa-dashboard"></i> <span>Dashboard</span>
				</a>
			</li>
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
						<a href="<?= site_url(); ?>admin/bioner_stacking/add">
							<i class="fa fa-plus"></i> Add Bioner Stacking
						</a>
					</li>
					<li>
						<a href="<?= site_url(); ?>admin/bioner_stacking/index">
							<i class="fa fa-circle-o"></i> List Bioner Stacking
						</a>
					</li>
					<li>
						<a href="<?= site_url(); ?>admin/bioner_stacking_withdraw/pending">
							<i class="fa fa-circle-o"></i> List Withdraw Pending
						</a>
					</li>
					<li>
						<a href="<?= site_url(); ?>admin/bioner_stacking_withdraw/success">
							<i class="fa fa-circle-o"></i> List Withdraw Success
						</a>
					</li>
				</ul>
			</li>
			<li class="treeview">
				<a href="#">
					<i class="fa fa-archive"></i>
					<span>Bioner Trade</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					<li>
						<a href="<?= site_url(); ?>admin/bioner_trade/add">
							<i class="fa fa-plus"></i> Add Bioner Trade
						</a>
					</li>
					<li>
						<a href="<?= site_url(); ?>admin/bioner_trade/index">
							<i class="fa fa-circle-o"></i> List Bioner Trade
						</a>
					</li>
					<li>
						<a href="<?= site_url(); ?>admin/bioner_trade_withdraw/pending">
							<i class="fa fa-circle-o"></i> List Withdraw Pending
						</a>
					</li>
					<li>
						<a href="<?= site_url(); ?>admin/bioner_trade_withdraw/success">
							<i class="fa fa-circle-o"></i> List Withdraw Success
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
			<li class="">
				<a href="<?= site_url('admins/user_management'); ?>">
					<i class="fa fa-user"></i> <span>User Management</span>
				</a>
			</li>
			<li class="">
				<a href="<?= site_url('admins'); ?>">
					<i class="fa fa-user-secret"></i> <span>Admin Management</span>
				</a>
			</li>
			<li class="">
				<a href="<?= site_url('admins/news'); ?>">
					<i class="fa fa-newspaper-o"></i> <span>News Management</span>
				</a>
			</li>
			<li class="">
				<a href="<?= site_url('admins/ratio'); ?>">
					<i class="fa fa-balance-scale"></i> <span>TRX/BNR Ratio</span>
				</a>
			</li>
		</ul>
	</section>
</aside>