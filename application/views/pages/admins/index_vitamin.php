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
				"url": `<?= site_url('datatables/admins') ?>`,
				"type": "POST"
			},
			"columns": [{
					"data": "email"
				},
				{
					"data": null,
					"render": function(res) {
						let nama_role = '';
						if (res.role == 'master_admin') {
							nama_role = 'Master Admin';
						} else if (res.role == 'admin') {
							nama_role = 'Admin';
						} else if (res.role == 'marketing') {
							nama_role = 'Marketing';
						}
						return nama_role.toUpperCase();
					}
				},
				{
					"data": null,
					"render": function(res) {
						let vdel = ``;
						if (res.id != 1) {
							vdel = `<button class="btn btn-danger btn-xs" onclick="deleteData('${res.id}');"><i class="fa fa-trash fa-fw"></i> Delete</button>`;
						}
						html = `
						<div class="text-center">
							<div class="btn-group">
								${vdel}
								<button class="btn btn-warning btn-xs" onclick="resetPassword('${res.id}', '${res.email}');"><i class="fa fa-key fa-fw"></i> Reset Password</button>
							</div>
						</div>
						`;
						return html;
					}
				},
			],
			"columnDefs": [{
				"targets": [2],
				"orderable": false,
			}, ],
		});

		$('#form_reset').on('submit', function(e) {
			e.preventDefault();

			$.ajax({
				url: `<?= site_url(); ?>admins/reset`,
				method: 'post',
				dataType: 'json',
				data: {
					id: $('#reset_id').val(),
					password: $('#reset_password').val()
				},
				beforeSend: function() {
					$('#reset_submit').attr('disabled', true);
					$.blockUI();
				}
			}).done(function(res) {
				if (res.code == 200) {
					alert('Reset Akun Berhasil');
					$('#reset_id').val(null);
					$('#reset_email').val(null);
					$('#reset_email_text').val(null);
					$('#modal-reset').modal('hide');
					table.draw();
				} else {
					alert('Reset Akun Gagal');
				}
				$('#reset_submit').attr('disabled', false);
				$.unblockUI();
			});
		});

	});

	function deleteData(id) {
		let c = confirm('Hapus Akun ?');

		if (c == true) {
			$.ajax({
					url: `<?= site_url(); ?>admins/destroy`,
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
						alert("[500] Tidak terhubung dengan database");
					}
				})
				.done(function(res) {
					if (res.code == 200) {
						alert('Hapus Akun Berhasil');
						table.draw();
					} else {
						alert('Hapus Akun Gagal');
					}
					$.unblockUI();

				});
		}
	}

	function resetPassword(id, email) {
		$('#reset_id').val(id);
		$('#reset_email').val(email);
		$('#reset_email_text').val(email);
		$('#modal-reset').modal('show');

	}
</script>