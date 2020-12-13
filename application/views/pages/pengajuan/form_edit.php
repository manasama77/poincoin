<section class="content-header">
	<h1><?= $title; ?> - <small>#<?= $pengajuans->row()->no_kredit; ?></small></h1>
	<ol class="breadcrumb">
		<li><a href="<?= site_url('dashboard'); ?>"><i class="fa fa-home"></i> Home</a></li>
		<li class="active"><i class="fa fa-table"></i> <?= $title; ?></li>
	</ol>
</section>

<form id="form_add" action="#" enctype="multipart/form-data">
	<section class="content">
		<div class="row">
			<div class="col-sm-6 col-md-6">
				<div class="box box-info">
					<div class="box-header">
						<h3 class="box-title">Customer</h3>
						<div class="box-tools">
							<a href="<?= site_url(); ?>pengajuan" class="btn btn-default btn-sm" title="Kembali">
								<i class="fa fa-step-backward"></i> Kembali ke List
							</a>
						</div>
					</div>
					<div class="box-body">
						<div class="form-group">
							<label for="id_customer">Customer</label>
							<select class="form-control select2" id="id_customer" name="id_customer" data-placeholder="Pilih Customer" style="width: 100%;" required>
								<option value=""></option>
								<?php
								foreach ($customers->result() as $key) {
									echo '<option value="' . $key->id . '" data-alamat="' . $key->alamat . '" data-no_telp="' . $key->no_telp . '" data-email="' . $key->email . '" data-id_pekerjaan="' . $key->id_pekerjaan . '" data-hubungan="' . $key->hubungan . '" data-nama_penjamin="' . $key->nama_penjamin . '" data-no_telp_penjamin="' . $key->no_telp_penjamin . '" data-sumber_pendapatan="' . $key->sumber_pendapatan . '" data-penghasilan_perbulan="' . $key->penghasilan_perbulan . '">' . $key->nama . '</option>';
								}
								?>
							</select>
						</div>
						<div class="form-group">
							<label for="alamat">Alamat</label>
							<textarea class="form-control" id="alamat" name="alamat" placeholder="Alamat" required></textarea>
						</div>
						<div class="form-group">
							<label for="no_telp">No Telp</label>
							<input type="tel" class="form-control" id="no_telp" name="no_telp" placeholder="No Telp" autocorrect="off" pattern="[0-9]*" required />
						</div>
						<div class="form-group">
							<label for="email">Email</label>
							<input type="email" class="form-control" id="email" name="email" placeholder="Email" />
						</div>
						<div class="form-group">
							<label for="id_pekerjaan">Pekerjaan</label>
							<select class="form-control" name="id_pekerjaan" id="id_pekerjaan" required>
								<option value=""></option>
								<?php
								foreach ($pekerjaans->result() as $pekerjaan) {
									echo '<option value="' . $pekerjaan->id . '">' . $pekerjaan->nama . '</option>';
								}
								?>
							</select>
						</div>
					</div>
				</div>
				<div class="box box-info">
					<div class="box-header">
						<h3 class="box-title">Base Info</h3>
					</div>
					<div class="box-body">

						<div class="form-group">
							<label for="tanggal_pengajuan">Tanggal Pengajuan</label>
							<input type="date" class="form-control" id="tanggal_pengajuan" name="tanggal_pengajuan" value="<?= $pengajuans->row()->tanggal_pengajuan; ?>" required>
						</div>
						<div class="form-group">
							<label for="id_marketing">Marketing</label>
							<select class="form-control" id="id_marketing" name="id_marketing" required>
								<option value=""></option>
								<?php
								foreach ($marketings->result() as $key) {
									echo '<option value="' . $key->id . '">' . $key->nama . '</option>';
								}
								?>
							</select>
						</div>
						<div class="form-group">
							<label for="hubungan">Hubungan Dengan Marketing</label>
							<input type="text" class="form-control" id="hubungan" name="hubungan" placeholder="Hubungan Dengan Marketing" required />
						</div>
						<div class="form-group">
							<label for="nama_penjamin">Nama Penjamin</label>
							<input type="text" class="form-control" id="nama_penjamin" name="nama_penjamin" placeholder="Nama Penjamin" required />
						</div>
						<div class="form-group">
							<label for="no_telp_penjamin">No Telp Penjamin</label>
							<input type="tel" class="form-control" id="no_telp_penjamin" name="no_telp_penjamin" placeholder="No Telp Penjamin" autocorrect="off" pattern="[0-9]*" required />
						</div>
						<div class="form-group">
							<label for="sumber_pendapatan">Sumber Pendapatan</label>
							<select class="form-control" id="sumber_pendapatan" name="sumber_pendapatan" required>
								<option value=""></option>
								<option value="gaji_tetap">Gaji Tetap</option>
								<option value="honor">Honor</option>
								<option value="bonus">Bonus</option>
								<option value="hasil_usaha">Hasil Usaha</option>
								<option value="hasil_alam">Hasil Alama</option>
							</select>
						</div>
						<div class="form-group">
							<label for="penghasilan_perbulan">Penghasilan Perbulan</label>
							<input type="text" class="form-control" id="penghasilan_perbulan" name="penghasilan_perbulan" maxlength="19" required>
						</div>

					</div>
				</div>
			</div>
			<div class="col-sm-12 col-md-6">
				<div class="box box-success">
					<div class="box-header">
						<h3 class="box-title">Barang</h3>
					</div>
					<div class="box-body">
						<div class="form-group">
							<label for="id_kategori">Kategori</label>
							<select class="form-control" id="id_kategori" name="id_kategori" required>
								<option value=""></option>
								<?php
								if ($kategoris->num_rows() > 0) {
									foreach ($kategoris->result() as $key) {
										echo '<option value="' . $key->id . '">' . $key->nama . '</option>';
									}
								}
								?>
							</select>
						</div>
						<div class="form-group">
							<label for="id_vendor">Vendor</label>
							<select class="form-control" id="id_vendor" name="id_vendor" required disabled>
								<option value=""></option>
							</select>
						</div>
						<div class="form-group">
							<label for="id_jenis_barang">Jenis Barang</label>
							<select class="form-control" id="id_jenis_barang" name="id_jenis_barang" required disabled>
								<option value=""></option>
							</select>
						</div>
						<div class="form-group">
							<label for="id_barang">Barang</label>
							<select class="form-control" id="id_barang" name="id_barang" required disabled>
								<option value=""></option>
							</select>
						</div>
						<div class="form-group">
							<label for="spesifikasi">Spesifikasi</label>
							<textarea class="form-control" id="spesifikasi" name="spesifikasi" placeholder="Spesifikasi" value="<?= $pengajuan_barangs->row()->spesifikasi; ?>" required></textarea>
						</div>
						<div class="form-group">
							<label for="hpp">Harga Barang</label>
							<input type="text" class="form-control" id="hpp" name="hpp" placeholder="Harga Barang" maxlength="19" required />
							<span class="help-block"><i>*Kisaran</i></span>
						</div>
						<div class="form-group">
							<label for="tenor">Lama Kredit</label>
							<select class="form-control" id="tenor" name="tenor" required>
								<option value=""></option>
								<option value="6">6 Bulan (25%)</option>
								<option value="8">8 Bulan (30%)</option>
								<option value="10">10 Bulan (35%)</option>
							</select>
						</div>
						<div class="form-group">
							<label for="pokok">Pokok</label>
							<input type="text" class="form-control" id="pokok" name="pokok" placeholder="Pokok" required readonly />
						</div>
						<div class="form-group">
							<label for="margin">Margin</label>
							<input type="text" class="form-control" id="margin" name="margin" placeholder="Margin" required readonly />
						</div>
						<div class="form-group">
							<label for="total_angsuran">Total Angsuran</label>
							<input type="text" class="form-control" id="total_angsuran" name="total_angsuran" placeholder="Total Angsuran" required readonly />
						</div>
						<div class="form-group">
							<label for="angsuran">Angsuran Perbulan</label>
							<input type="text" class="form-control" id="angsuran" name="angsuran" placeholder="Angsuran Perbulan" required readonly />
						</div>

					</div>
				</div>
			</div>

		</div>
		<div class="row">

			<div class="col-md-12">
				<div class="form-group">
					<input type="hidden" id="no_kredit" name="no_kredit" value="<?= $pengajuans->row()->no_kredit; ?>" readonly />
					<input type="hidden" id="id_customer_prev" name="id_customer_prev" value="<?= $pengajuans->row()->id_customer; ?>" readonly />
					<input type="hidden" id="id_marketing_prev" name="id_marketing_prev" value="<?= $pengajuans->row()->id_marketing; ?>" readonly />
					<input type="hidden" id="id_kategori_prev" name="id_kategori_prev" value="<?= $pengajuan_barangs->row()->id_kategori; ?>" readonly />
					<input type="hidden" id="id_vendor_prev" name="id_vendor_prev" value="<?= $pengajuan_barangs->row()->id_vendor; ?>" readonly />
					<input type="hidden" id="id_jenis_barang_prev" name="id_jenis_barang_prev" value="<?= $pengajuan_barangs->row()->id_jenis_barang; ?>" readonly />
					<input type="hidden" id="id_barang_prev" name="id_barang_prev" value="<?= $pengajuan_barangs->row()->id_barang; ?>" readonly />
					<input type="hidden" id="hpp_prev" name="hpp_prev" value="<?= $pengajuan_barangs->row()->hpp_pengajuan; ?>" readonly />
					<input type="hidden" id="tenor_prev" name="tenor_prev" value="<?= $pengajuan_barangs->row()->tenor; ?>" readonly />
					<button type="submit" id="submit_continue" class="btn btn-primary btn-block" title="Update">Update</button>
					<a href="<?= site_url(); ?>pengajuan" class="btn btn-default btn-block" title="Kembali">
						<i class="fa fa-step-backward"></i> Kembali ke List
					</a>
				</div>
			</div>

		</div>
	</section>
</form>