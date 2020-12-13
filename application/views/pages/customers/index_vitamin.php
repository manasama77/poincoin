<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap.min.css">

<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap.min.js"></script>
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
			"responsive": true,
			"processing": true,
			"serverSide": true,
			"order": [],
			"ajax": {
				"url": `<?= site_url('datatables/customers') ?>`,
				"type": "POST"
			},
			"columns": [{
					"data": "id"
				},
				{
					"data": "no_ktp",
				},
				{
					"data": "nama",
				},
				{
					"data": "alias",
				},
				{
					"data": "tgl_lahir",
				},
				{
					"data": "alamat",
				},
				{
					"data": "no_telp",
				},
				{
					"data": "email"
				},
				{
					"data": "nama_pekerjaan"
				},
				{
					"data": 'hubungan'
				},
				{
					"data": 'nama_penjamin'
				},
				{
					"data": 'no_telp_penjamin'
				},
				{
					"data": null,
					"render": function(res) {
						let tombolBan,
							tombolLihatKTP,
							tombolEdit,
							tombolDelete;

						tombolLihatKTP = `<a onclick="lihatKTP('${res.id}', '${res.nama}', '${res.foto_ktp_name}')"><i class="fa fa-key fa-fw"></i> Lihat KTP</a>`;
						tombolEdit = `<a href="<?= site_url(); ?>customers/edit/${res.id}"><i class="fa fa-pencil fa-fw"></i> Edit</a>`;
						tombolDelete = `<a onclick="deleteData('${res.id}', '${res.nama}')"><i class="fa fa-trash fa-fw"></i> Delete</a>`;

						html = `
						<div class="text-center">
							<div class="btn-group" role="group">
								<button type="button" class="btn btn-warning btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									Actions <span class="fa fa-caret-down fa-fw"></span>
								</button>
								<ul class="dropdown-menu dropdown-menu-right">
									<li>${tombolLihatKTP}</li>
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
				"targets": [12],
				"orderable": false,
				"className": "text-center"
			}, ],
		});
	});

	function refreshTable() {
		table.ajax.reload();
	}

	function deleteData(id, nama) {
		Swal.fire({
			title: `Delete ${nama} ?`,
			text: "Data yang sudah didelete tidak dapat dikembalikan!",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Ya, Delete!'
		}).then((result) => {
			if (result.isConfirmed) {
				$.ajax({
					url: `<?= site_url(); ?>customers/destroy`,
					method: 'post',
					dataType: 'json',
					data: {
						id: id,
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
							title: `Delete ${nama} berhasil`,
							showConfirmButton: false,
							timer: 1500
						}).then(function(result) {
							refreshTable();
						});
					} else {
						Swal.fire({
							position: 'top-end',
							icon: 'error',
							title: `Delete ${nama} gagal, silahkan coba kembali`,
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

	function lihatKTP(id, nama, foto_ktp) {
		$('#nama_user').text(nama);
		$('#foto_ktp_preview').attr('src', `<?= base_url(); ?>public/img/ktp/${foto_ktp}`);
		$('#modal_ktp').modal('show');
	}
</script>