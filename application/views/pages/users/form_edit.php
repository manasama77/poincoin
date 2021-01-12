<section class="content-header">
	<h1><?= $title; ?></h1>
	<ol class="breadcrumb">
		<li><a href="<?= site_url('dashboard'); ?>"><i class="fa fa-home"></i> Home</a></li>
		<li class="active"><i class="fa fa-table"></i> <?= $title; ?></a></li>
	</ol>
</section>

<section class="content">
	<div class="row">
		<div class="col-sm-12 col-md-6">
			<div class="box box-info">
				<div class="box-header">
					<h3 class="box-title">Edit Customer</h3>
					<div class="box-tools">
						<a href="<?= site_url(); ?>customers" class="btn btn-default btn-sm" title="Kembali">
							<i class="fa fa-step-backward"></i> Kembali ke List
						</a>
					</div>
				</div>
				<div class="box-body">
					<form id="form_edit" action="#" enctype="multipart/form-data">
						<div class="form-group">
							<label for="no_ktp">No KTP</label>
							<input type="text" class="form-control" id="no_ktp" name="no_ktp" placeholder="No KTP" patter="[0-9]*" value="<?= $data['no_ktp']; ?>" required />
						</div>
						<div class="form-group">
							<label for="nama">Nama</label>
							<input type="text" class="form-control" id="nama" name="nama" minlength="3" placeholder="Nama" value="<?= $data['nama']; ?>" required />
						</div>
						<div class="form-group">
							<label for="alias">Alias</label>
							<input type="text" class="form-control" id="alias" name="alias" minlength="3" placeholder="Alias" value="<?= $data['alias']; ?>" />
						</div>
						<div class="form-group">
							<label for="tgl_lahir">Tgl Lahir</label>
							<input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" placeholder="Tgl Lahir" value="<?= $data['tgl_lahir']; ?>" required />
						</div>
						<div class="form-group">
							<label for="alamat">Alamat</label>
							<input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat" value="<?= $data['alamat']; ?>" required />
						</div>
						<div class="form-group">
							<label for="no_telp">No Telp</label>
							<input type="tel" class="form-control" id="no_telp" name="no_telp" placeholder="No Telp" autocorrect="off" pattern="[0-9]*" value="<?= $data['no_telp']; ?>" required />
						</div>
						<div class="form-group">
							<label for="email">Email</label>
							<input type="email" class="form-control" id="email" name="email" placeholder="Email" value="<?= $data['email']; ?>" />
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
							<label for="hubungan">Hubungan Dengan Marketing</label>
							<input type="text" class="form-control" id="hubungan" name="hubungan" placeholder="Hubungan Dengan Marketing" value="<?= $data['hubungan']; ?>" required />
						</div>
						<div class="form-group">
							<label for="nama_penjamin">Nama Penjamin</label>
							<input type="text" class="form-control" id="nama_penjamin" name="nama_penjamin" placeholder="Nama Penjamin" value="<?= $data['nama_penjamin']; ?>" required />
						</div>
						<div class="form-group">
							<label for="no_telp_penjamin">No Telp Penjamin</label>
							<input type="tel" class="form-control" id="no_telp_penjamin" name="no_telp_penjamin" placeholder="No Telp Penjamin" autocorrect="off" pattern="[0-9]*" value="<?= $data['no_telp_penjamin']; ?>" required />
						</div>
						<div class="form-group">
							<label for="foto_ktp">Foto KTP</label>
							<img src="<?= base_url(); ?>public/img/ktp/<?= $data['foto_ktp']; ?>" alt="Foto KTP" class="img-thumbnail" style="margin-bottom:10px;">
							<input type="file" class="form-control" id="foto_ktp" name="foto_ktp" placeholder="foto_ktp" accept="image/*" />
						</div>
						<div class="form-group">
							<input type="hidden" id="id" name="id" value="<?= $data['id']; ?>">
							<input type="hidden" id="prev_no_ktp" name="prev_no_ktp" value="<?= $data['no_ktp']; ?>">
							<input type="hidden" id="prev_foto_ktp" name="prev_foto_ktp" value="<?= $data['foto_ktp']; ?>">
							<button type="submit" id="submit_continue" class="btn btn-primary btn-block">Update</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>