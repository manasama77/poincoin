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
					"data": "username"
				},
				{
					"data": null,
					"render": function(res) {
						let vdel = ``;
						let vres = ``;
						if (res.id != 1) {
							vdel = `<button class="btn btn-danger btn-xs" onclick="deleteData('${res.id}');"><i class="fa fa-trash fa-fw"></i> Delete</button>`;
							vres = `<button class="btn btn-warning btn-xs" onclick="resetPassword('${res.id}', '${res.username}');"><i class="fa fa-key fa-fw"></i> Reset Password</button>`;
						}
						html = `
						<div class="text-center">
							<div class="btn-group">
								${vdel}
								${vres}
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
					Swal.fire({
						position: 'top-end',
						icon: 'success',
						title: `Reset Admin Password Berhasil`,
						showConfirmButton: false,
						timer: 1500
					});
					$('#reset_id').val(null);
					$('#reset_username').val(null);
					$('#reset_username_text').val(null);
					$('#modal-reset').modal('hide');
					table.draw();
				} else {
					Swal.fire({
						position: 'top-end',
						icon: 'error',
						title: `Reset Admin Password Gagal, silahkan refresh halaman`,
						showConfirmButton: false,
						timer: 1500
					});
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
							title: `Hapus Admin Berhasil, silahkan refresh halaman`,
							showConfirmButton: false,
							timer: 1500
						});
						table.draw();
					} else {
						Swal.fire({
							position: 'top-end',
							icon: 'error',
							title: `Hapus Admin Gagal, silahkan refresh halaman`,
							showConfirmButton: false,
							timer: 1500
						});
					}
					$.unblockUI();

				});
		}
	}

	function resetPassword(id, username) {
		$('#reset_id').val(id);
		$('#reset_username').val(username);
		$('#reset_username_text').val(username);
		$('#modal-reset').modal('show');

	}
</script>