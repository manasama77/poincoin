<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap.min.css">

<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap.min.js"></script>
<script>
	$(document).ready(function() {
		table = $('#datatables').DataTable({
			"destroy": true,
			"responsive": true,
			"processing": true,
			"serverSide": true,
			"order": [],
			"ajax": {
				"url": `<?= site_url('datatables/ratio') ?>`,
				"type": "POST"
			},
			"columns": [{
					"data": "tanggal"
				},
				{
					"data": "trx"
				},
				{
					"data": "bnr"
				},
				{
					"data": null,
					"render": function(res) {
						let vres = `<button class="btn btn-warning btn-xs" onclick="editData('${res.id}', '${res.tanggal}', '${res.trx}', '${res.bnr}');"><i class="fa fa-edit fa-fw"></i> Edit</button>`;
						let vdel = `<button class="btn btn-danger btn-xs" onclick="deleteData('${res.id}');"><i class="fa fa-trash fa-fw"></i> Delete</button>`;
						if (res.id != 1) {}
						html = `
						<div class="text-center">
							<div class="btn-group">
							${vres}
							${vdel}
							</div>
						</div>
						`;
						return html;
					}
				},
			],
			"columnDefs": [{
				"targets": [1],
				"orderable": false,
			}, ],
		});

		$('#form_edit').on('submit', function(e) {
			e.preventDefault();

			$.ajax({
				url: `<?= site_url(); ?>admins/ratio/update`,
				method: 'post',
				dataType: 'json',
				data: {
					id: $('#id_edit').val(),
					tanggal: $('#tanggal_edit').val(),
					trx: $('#trx_edit').val(),
					bnr: $('#bnr_edit').val(),
				},
				beforeSend: function() {
					$('#edit_submit').attr('disabled', true);
					$.blockUI();
				}
			}).done(function(res) {
				if (res.code == 200) {
					Swal.fire({
						position: 'top-end',
						icon: 'success',
						title: `Edit Ratio  Berhasil`,
						showConfirmButton: false,
						timer: 1500
					});
					$('#id_edit').val(null);
					$('#tanggal_edit').val(null);
					$('#trx_edit').val(null);
					$('#bnr_edit').val(null);
					$('#modal-edit').modal('hide');
					table.draw();
				} else {
					Swal.fire({
						position: 'top-end',
						icon: 'error',
						title: `Update Ratio Gagal, silahkan refresh halaman`,
						showConfirmButton: false,
						timer: 1500
					});
				}
				$('#edit_submit').attr('disabled', false);
				$.unblockUI();
			});
		});

	});

	function deleteData(id) {
		let c = confirm('Hapus Ratio ?');

		if (c == true) {
			$.ajax({
					url: `<?= site_url(); ?>admins/ratio/destroy`,
					method: 'post',
					data: {
						id: id
					},
					dataType: 'json',
					beforeSend: function() {
						$.blockUI();
					},
					errors: function() {
						$.unblockUI();
						Swal.fire({
							position: 'top-end',
							icon: 'error',
							title: `Tidak terhubung dengan database, silahkan refresh halaman`,
							showConfirmButton: false,
							timer: 1500
						});
					}
				})
				.done(function(res) {
					if (res.code == 200) {
						Swal.fire({
							position: 'top-end',
							icon: 'success',
							title: `Hapus Ratio Berhasil`,
							showConfirmButton: false,
							timer: 1500
						});
						table.draw();
					} else {
						Swal.fire({
							position: 'top-end',
							icon: 'error',
							title: `Hapus Ratio Gagal, silahkan refresh halaman`,
							showConfirmButton: false,
							timer: 1500
						});
					}
					$.unblockUI();

				});
		}
	}

	function editData(id, tanggal, trx, bnr) {
		$('#id_edit').val(id);
		$('#tanggal_edit').val(tanggal);
		$('#trx_edit').val(trx);
		$('#bnr_edit').val(bnr);
		$('#modal-edit').modal('show');

	}
</script>