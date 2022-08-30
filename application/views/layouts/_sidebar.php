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
					<span>Poincoin Stacking</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					<li>
						<a href="<?= site_url(); ?>admin/bioner_stacking/add">
							<i class="fa fa-plus"></i> Add Poincoin Stacking
						</a>
					</li>
					<li>
						<a href="<?= site_url(); ?>admin/bioner_stacking/index">
							<i class="fa fa-circle-o"></i> List Poincoin Stacking
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
			<!-- <li class="treeview">
				<a href="#">
					<i class="fa fa-archive"></i>
					<span>Poincoin Trade</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					<li>
						<a href="<?= site_url(); ?>admin/bioner_trade/add">
							<i class="fa fa-plus"></i> Add Poincoin Trade
						</a>
					</li>
					<li>
						<a href="<?= site_url(); ?>admin/bioner_trade/index">
							<i class="fa fa-circle-o"></i> List Poincoin Trade
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
					<i class="fa fa-balance-scale"></i> <span>TRX/PC Ratio</span>
				</a>
			</li>
		</ul>
	</section>
</aside>