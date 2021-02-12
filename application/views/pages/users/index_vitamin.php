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
					"data": "stacking_invest",
				},
				{
					"data": "stacking_profit",
				},
				{
					"data": "trade_hi",
				},
				{
					"data": "trade_saldo",
				},
				{
					"data": null,
					"render": function(res) {
						var btnResetEmail = `
						<li>
							<a href="#" onclick="modalEmail('${res.id}', '${res.email}')">
								<i class="fa fa-envelope"></i> Reset Email
							</a>
						</li>`;

						var btnResetPassword = `
						<li>
							<a href="#" onclick="modalPassword('${res.id}')">
								<i class="fa fa-key"></i> Reset Password
							</a>
						</li>`;

						var btnResetPin = `
						<li>
							<a href="#" onclick="modalPin('${res.id}')">
								<i class="fa fa-lock"></i> Reset PIN
							</a>
						</li>`;

						var btnResetRekening = `
						<li>
							<a href="#" onclick="modalRekening('${res.id}')">
								<i class="fa fa-book"></i> Reset Rekening
							</a>
						</li>`;

						var btnDelete = `
						<li>
							<a href="#" onclick="deleteUser('${res.id}')">
								<i class="fa fa-times"></i> Delete User
							</a>
						</li>`;

						htmlnya = `
						<div class="dropdown">
							<button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
								Actions
								<span class="caret"></span>
							</button>
							<ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu1">
								${btnResetEmail}
								${btnResetPassword}
								${btnResetPin}
								${btnResetRekening}
								${btnDelete}
							</ul>
						</div>`;
						return htmlnya;
					}
				}
			],
			"columnDefs": [{
				"targets": [10],
				"orderable": false,
				"className": "text-center"
			}],
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

		$('#form_rekening').on('submit', function(e) {
			e.preventDefault();

			$.ajax({
				url: `<?= site_url(); ?>admins/user_reset_rekening`,
				method: 'post',
				dataType: 'json',
				data: {
					id_user_rekening_edit: $('#id_user_rekening_edit').val(),
					id_bank_edit: $('#id_bank_edit').val(),
					no_rekening_edit: $('#no_rekening_edit').val(),
					atas_nama_edit: $('#atas_nama_edit').val(),
				},
				beforeSend: function() {
					$('#btn_save_rekening').attr('disabled', true);
					$.blockUI();
				}
			}).done(function(res) {
				if (res.code == 200) {
					Swal.fire({
						position: 'top-end',
						icon: 'success',
						title: `Reset Rekening Berhasil`,
						showConfirmButton: false,
						timer: 1500
					}).then(function() {
						$('#id_user_rekening_edit').val(null);
						$('#id_bank_edit').val(null);
						$('#no_rekening_edit').val(null);
						$('#atas_nama_edit').val(null);
						$('#modal_rekening').modal('hide');
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
				$('#btn_save_rekening').attr('disabled', false);
				$.unblockUI();
			});
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

	function modalRekening(id) {
		$("#id_bank_edit").val("").trigger('change');
		$('#no_rekening_edit').val(null);
		$('#atas_nama_edit').val(null);
		$('#id_user_rekening_edit').val(id);
		$('#modal_rekening').modal('show');
	}

	function deleteUser(id) {
		Swal.fire({
			icon: 'question',
			title: `Delete User`,
			showConfirmButton: true,
			showCancelButton: true,
			timer: 1500
		}).then(function(e) {
			if (e.isConfirmed) {
				$.ajax({
					url: `<?= site_url(); ?>admins/user_delete`,
					method: 'post',
					dataType: 'json',
					data: {
						id_user: id
					},
					beforeSend: function() {
						$.blockUI();
					}
				}).always(function() {
					$.unblockUI();
				}).fail(function(e) {
					console.log(e);
				}).done(function(e) {
					if (e.code == 500) {
						Swal.fire({
							icon: 'error',
							title: 'Oops...',
							text: 'Proses Delete Gagal, Tidak Terhubung Dengan Database',
						});
					} else if (e.code == 200) {
						Swal.fire({
							icon: 'success',
							title: 'Success...',
							text: 'Delete User Berhasil.',
						});
					}
					table.draw();
				});
			}
		});
	}
</script>