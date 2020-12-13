<aside class="main-sidebar">
	<section class="sidebar">
		<ul class="sidebar-menu" data-widget="tree">
			<li class="header">Navigation</li>
			<li class="active">
				<a href="<?= site_url('dashboard'); ?>">
					<i class="fa fa-dashboard"></i> <span>Dashboard</span>
				</a>
			</li>
			<li class="header">Pengajuan</li>
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
			</li>
			<li class="header">Barang</li>
			<li class="">
				<a href="<?= site_url('barang'); ?>">
					<i class="fa fa-cubes"></i> <span>Barang Management</span>
				</a>
			</li>
			<li class="">
				<a href="<?= site_url('vendors'); ?>">
					<i class="fa fa-tag"></i> <span>Vendor</span>
				</a>
			</li>
			<li class="">
				<a href="<?= site_url('jenis_barang'); ?>">
					<i class="fa fa-tag"></i> <span>Jenis Barang</span>
				</a>
			</li>
			<li class="header">Customer</li>
			<li class="">
				<a href="<?= site_url('customers'); ?>">
					<i class="fa fa-users"></i> <span>Customer Management</span>
				</a>
			</li>
			<li class="">
				<a href="<?= site_url('pekerjaans'); ?>">
					<i class="fa fa-tags"></i> <span>Pekerjaan</span>
				</a>
			</li>
			<li class="header">Setup</li>
			<li class="">
				<a href="<?= site_url('admins'); ?>">
					<i class="fa fa-user-secret"></i> <span>Admin Management</span>
				</a>
			</li>
		</ul>
	</section>
</aside>