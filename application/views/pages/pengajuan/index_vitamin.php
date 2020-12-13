<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap.min.css">

<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap.min.js">
</script>
<script>
	$(document).ready(function() {
		table = $('#datatables').DataTable({
			"destroy": true,
			"scrollY": function() {
				let winHeight = window.outerHeight;
				if (winHeight <= 907) {
					return '60vh'
				} else if (winHeight >= 908) {
					return '67vh'
				}
			},
			"scrollX": true,
			"responsive": true,
			"processing": true,
			"serverSide": true,
			"order": [],
			"ajax": {
				"url": `<?= site_url('datatables/pengajuan') ?>`,
				"type": "POST"
			},
			"columns": [{
					"data": "no_kredit"
				},
				{
					"data": "nama_marketing",
				},
				{
					"data": "nama_customer",
				},
				{
					"data": "alamat",
				},
				{
					"data": "no_telp",
				},
				{
					"data": "nama_pekerjaan",
				},
				{
					"data": "hubungan"
				},
				{
					"data": "nama_penjamin"
				},
				{
					"data": 'no_telp_penjamin'
				},
				{
					"data": 'total_angsuran'
				},
				{
					"data": 'tanggal_pengajuan'
				},
				{
					"data": null,
					"render": function(res) {
						tombolLihatBarang =
							`<a onclick="lihatBarang('${res.no_kredit}')"><i class="fa fa-cube fa-fw"></i> Lihat Barang</a>`;
						tombolEdit =
							`<a href="<?= site_url(); ?>pengajuan/edit/${res.no_kredit}"><i class="fa fa-pencil fa-fw"></i> Edit</a>`;
						tombolDelete =
							`<a onclick="deleteData('${res.no_kredit}')"><i class="fa fa-trash fa-fw"></i> Delete</a>`;

						html = `
						<div class="text-center">
							<div class="btn-group" role="group">
								<button type="button" class="btn btn-warning btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									Actions <span class="fa fa-caret-down fa-fw"></span>
								</button>
								<ul class="dropdown-menu dropdown-menu-right">
									<li>${tombolLihatBarang}</li>
									<li>${tombolEdit}</li>
									<li>${tombolDelete}</li>
								</ul>
							</div>
						</div>
						`;
						return html;
					}
				},
			],
			"columnDefs": [{
					"targets": [11],
					"orderable": false,
				},
				{
					"targets": [0, 10, 11],
					"className": "text-center"
				},
				{
					"targets": [9],
					"className": "text-right"
				},
			],
		});
	});

	function refreshTable() {
		table.ajax.reload();
	}

	function deleteData(no_kredit) {
		Swal.fire({
			title: `Delete ${no_kredit} ?`,
			text: "Data yang sudah didelete tidak dapat dikembalikan!",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Ya, Delete!'
		}).then((result) => {
			if (result.isConfirmed) {
				$.ajax({
					url: `<?= site_url(); ?>pengajuan/destroy`,
					method: 'post',
					dataType: 'json',
					data: {
						no_kredit: no_kredit,
					},
					beforeSend: function() {
						$.blockUI();
					},
					statusCode: {
						200: function() {
							$.unblockUI();
						},
						404: function() {
							$.unblockUI();
							Swal.fire({
								icon: 'error',
								title: '[404] Oops...',
								text: `Page Not Found`,
							});
						},
						500: function() {
							$.unblockUI();
							Swal.fire({
								icon: 'error',
								title: '[500] Oops...',
								text: `Can't Connect to Database`,
							});
						},
						503: function() {
							$.unblockUI();
							Swal.fire({
								icon: 'error',
								title: '[503] Oops...',
								text: `Connection Timeout, Check your Internet Connection`,
							});
						},
					},
				}).done(function(res) {
					$.unblockUI();
					if (res.code == 200) {
						Swal.fire({
							position: 'top-end',
							icon: 'success',
							title: `Delete ${no_kredit} berhasil`,
							showConfirmButton: false,
							timer: 1500
						}).then(function(result) {
							refreshTable();
						});
					} else {
						Swal.fire({
							position: 'top-end',
							icon: 'error',
							title: `Delete ${no_kredit} gagal, silahkan coba kembali`,
							showConfirmButton: false,
							timer: 1500
						}).then(function(result) {
							refreshTable();
						});
					}

					return false;
				});
			}
		});

	}

	function lihatBarang(no_kredit) {
		if (no_kredit != null) {
			$.ajax({
				url: `<?= site_url(); ?>pengajuan/show_barang`,
				method: 'get',
				dataType: 'json',
				data: {
					no_kredit: no_kredit,
					tipe: 'pengajuan'
				},
				beforeSend: function(res) {
					$.blockUI();
					$('#vbarang').html('');
				}
			}).fail(function(res) {
				console.log(res);
			}).done(function(res) {
				console.log(res);
				let html = ``;

				if (res.code == 404) {
					alert('Data Barang Tidak Ditemukan');
				} else if (res.code == 500) {
					alert('Terjadi kesalahan dengan database');
				} else {
					$.each(res.data, function(i, v) {
						html = `
						<tr>
							<th>Nama Barang</th>
							<th>:</th>
							<td>${v.nama_barang}</td>
						</tr>
						<tr>
							<th>Spesifikasi</th>
							<th>:</th>
							<td>${v.spesifikasi}</td>
						</tr>
						<tr>
							<th>Harga Pengajuan</th>
							<th>:</th>
							<td>Rp.${v.hpp}</td>
						</tr>
						<tr>
							<th>Tenor</th>
							<th>:</th>
							<td>${v.tenor} Bulan</td>
						</tr>
						<tr>
							<th>Pokok</th>
							<th>:</th>
							<td>Rp.${v.pokok}</td>
						</tr>
						<tr>
							<th>Margin</th>
							<th>:</th>
							<td>Rp.${v.margin_rp} (${v.margin_persen} %)</td>
						</tr>
						<tr>
							<th>Harga Jual</th>
							<th>:</th>
							<td>Rp.${v.harga_jual}</td>
						</tr>
						<tr>
							<th>Angsuran</th>
							<th>:</th>
							<td>Rp.${v.angsuran} / Bulan</td>
						</tr>
						`;
					});

					$('#vbarang').html(html);
					$('#no_kredit').text(no_kredit);
					$('#modal_barang').modal('show');
				}

				$.unblockUI();

			});
		}
	}
</script>