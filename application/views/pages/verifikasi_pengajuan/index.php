<section class="content-header">
	<h1><?= $title; ?></h1>
	<ol class="breadcrumb">
		<li><a href="<?= site_url('dashboard'); ?>"><i class="fa fa-home"></i> Home</a></li>
		<li class="active"><i class="fa fa-table"></i> <?= $title; ?></li>
	</ol>
</section>

<section class="content">
	<div class="row">
		<form id="form_no_kredit" action="#">
			<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
				<div class="box box-info">
					<div class="box-header">
						<h3 class="box-title">No Kredit Pengajuan</h3>
						<div class="box-tools">
							<a href="<?= site_url(); ?>pengajuan" class="btn btn-default btn-sm btn-block" title="Kembali">
								<i class="fa fa-step-backward"></i> Kembali ke List
							</a>
						</div>
					</div>
					<div class="box-body">
						<div class="form-group">
							<label for="no_kredit">No Kredit</label>
							<select class="form-control select2" id="no_kredit" name="no_kredit" data-placeholder="No Kredit" style="width: 100%;" required>
								<option value=""></option>
								<?php
								foreach ($arr_pengajuan->result() as $key) {
									echo '<option value="' . $key->no_kredit . '" 
									data-id_marketing="' . $key->id_marketing . '" 
									data-nama_customer="' . $key->nama . '" 
									data-alamat="' . $key->alamat . '" 
									data-no_telp="' . $key->no_telp . '" 
									data-email="' . $key->email . '" 
									data-id_pekerjaan="' . $key->id_pekerjaan . '" 
									data-hubungan="' . $key->hubungan . '" 
									data-nama_penjamin="' . $key->nama_penjamin . '" 
									data-no_telp_penjamin="' . $key->no_telp_penjamin . '" 
									data-sumber_pendapatan="' . $key->sumber_pendapatan . '"
									data-penghasilan_perbulan="' . $key->penghasilan_perbulan . '"
									data-tanggal_pengajuan="' . $key->tanggal_pengajuan . '"
									>' . $key->no_kredit . ' / ' . $key->nama . '</option>';
								}
								?>
							</select>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
	<div class="row">
		<form id="form_data_pengajuan" action="#" style="display:none;">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
				<div class="box box-success">
					<div class="box-body">
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
								<h3>Data Customer</h3>
								<div class="form-group">
									<label for="id_customer">Customer</label>
									<input type="text" class="form-control" id="nama_customer" name="nama_customer" placeholder="Customer" required readonly>
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
								<div class="form-group">
									<label for="tanggal_pengajuan">Tanggal Pengajuan</label>
									<input type="date" class="form-control" id="tanggal_pengajuan" name="tanggal_pengajuan" required readonly>
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
							<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
								<h3>Data Barang</h3>
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
									<textarea class="form-control" id="spesifikasi" name="spesifikasi" placeholder="Spesifikasi" required></textarea>
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
					<div class="box-footer">
						<button type="submit" id="submit_continue" class="btn btn-success btn-block" title="Tambah">Tambah Data</button>
					</div>
				</div>
			</div>
		</form>
	</div>
</section>