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
				"url": `<?= site_url('admins/user_datatables') ?>`,
				"type": "POST"
			},
			"columns": [{
					"data": "id"
				},
				{
					"data": "nama",
				},
				{
					"data": "email"
				},
				{
					"data": "no_hp",
				},
				{
					"data": "no_rekening",
				},
				{
					"data": "no_wallet",
				},
				{
					"data": null,
					"render": function(res) {
						var btnResetEmail = `<button type="button" class="btn btn-primary btn-sm" title="Reset Email" onclick="modalEmail('${res.id}', '${res.email}')">
							<i class="fa fa-envelope"></i> Reset Email
						</button>`;
						var btnResetPassword = `<button type="button" class="btn btn-info btn-sm" title="Reset Password" onclick="modalPassword('${res.id}')">
							<i class="fa fa-key"></i> Reset Password
						</button>`;
						var btnResetPin = `<button type="button" class="btn btn-warning btn-sm" title="Reset PIN" onclick="modalPin('${res.id}')">
							<i class="fa fa-lock"></i> Reset PIN
						</button>`;
						htmlnya = `<div class="btn-group">
						${btnResetEmail}
						${btnResetPassword}
						${btnResetPin}
						</div>`;
						return htmlnya;
					}
				}
			],
			"columnDefs": [{
				"targets": [6],
				"orderable": false,
				"className": "text-center"
			}, ],
		});

		$('#form_email').on('submit', function(e) {
			e.preventDefault();

			if ($('#old_email').val() == $('#new_email').val()) {
				$('#modal_email').modal('hide');
			} else {
				$.ajax({
					url: `<?= site_url(); ?>admins/user_reset_email`,
					method: 'post',
					dataType: 'json',
					data: {
						id: $('#id_email').val(),
						new_email: $('#new_email').val()
					},
					beforeSend: function() {
						$('#btn_save_email').attr('disabled', true);
						$.blockUI();
					}
				}).done(function(res) {
					if (res.code == 200) {
						Swal.fire({
							position: 'top-end',
							icon: 'success',
							title: `Reset Email Berhasil`,
							showConfirmButton: false,
							timer: 1500
						}).then(function() {
							$('#id_email').val(null);
							$('#old_email').val(null);
							$('#new_email').val(null);
							$('#modal_email').modal('hide');
							table.draw();
						});
					} else if (res.code == 404) {
						Swal.fire({
							position: 'top-end',
							icon: 'warning',
							title: `Email telah terdaftar, silahkan gunakan alamat email lain`,
							showConfirmButton: false,
							timer: 1500
						});
					} else {
						Swal.fire({
							position: 'top-end',
							icon: 'error',
							title: `Terjadi kesalahan dengan koneksi, silahkan refresh halaman`,
							showConfirmButton: false,
							timer: 1500
						});
					}
					$('#btn_save_email').attr('disabled', false);
					$.unblockUI();
				});
			}
		});

		$('#form_password').on('submit', function(e) {
			e.preventDefault();

			$.ajax({
				url: `<?= site_url(); ?>admins/user_reset_password`,
				method: 'post',
				dataType: 'json',
				data: {
					id: $('#id_password').val(),
					new_password: $('#new_password').val()
				},
				beforeSend: function() {
					$('#btn_save_password').attr('disabled', true);
					$.blockUI();
				}
			}).done(function(res) {
				if (res.code == 200) {
					Swal.fire({
						position: 'top-end',
						icon: 'success',
						title: `Reset Password Berhasil`,
						showConfirmButton: false,
						timer: 1500
					}).then(function() {
						$('#id_password').val(null);
						$('#new_password').val(null);
						$('#modal_password').modal('hide');
						table.draw();
					});
				} else {
					Swal.fire({
						position: 'top-end',
						icon: 'error',
						title: `Terjadi kesalahan dengan koneksi, silahkan refresh halaman`,
						showConfirmButton: false,
						timer: 1500
					});
				}
				$('#btn_save_password').attr('disabled', false);
				$.unblockUI();
			});
		});

		$('#form_pin').on('submit', function(e) {
			e.preventDefault();

			if ($('#new_pin').val().length < 6 || $('#new_pin').val().length > 6) {
				Swal.fire({
					position: 'top-end',
					icon: 'warning',
					title: `PIN harus diisi sebanyak 6 angka`,
					showConfirmButton: false,
					timer: 1500
				});
			} else {
				$.ajax({
					url: `<?= site_url(); ?>admins/user_reset_pin`,
					method: 'post',
					dataType: 'json',
					data: {
						id: $('#id_pin').val(),
						new_pin: $('#new_pin').val()
					},
					beforeSend: function() {
						$('#btn_save_pin').attr('disabled', true);
						$.blockUI();
					}
				}).done(function(res) {
					if (res.code == 200) {
						Swal.fire({
							position: 'top-end',
							icon: 'success',
							title: `Reset PIN Berhasil`,
							showConfirmButton: false,
							timer: 1500
						}).then(function() {
							$('#id_pin').val(null);
							$('#new_pin').val(null);
							$('#modal_pin').modal('hide');
							table.draw();
						});
					} else {
						Swal.fire({
							position: 'top-end',
							icon: 'error',
							title: `Terjadi kesalahan dengan koneksi, silahkan refresh halaman`,
							showConfirmButton: false,
							timer: 1500
						});
					}
					$('#btn_save_pin').attr('disabled', false);
					$.unblockUI();
				});
			}
		});

	});

	function refreshTable() {
		table.ajax.reload();
	}

	function modalEmail(id, email) {
		$('#old_email').val(email);
		$('#new_email').val(email);
		$('#id_email').val(id);
		$('#modal_email').modal('show');
	}

	function modalPassword(id) {
		$('#new_password').val(null);
		$('#id_password').val(id);
		$('#modal_password').modal('show');
	}

	function modalPin(id) {
		$('#new_pin').val(null);
		$('#id_pin').val(id);
		$('#modal_pin').modal('show');
	}
</script>