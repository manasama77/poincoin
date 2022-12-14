<!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap.min.css">

<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap.min.js"></script> -->

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.11.5/b-2.2.2/b-colvis-2.2.2/b-html5-2.2.2/b-print-2.2.2/fh-3.2.2/r-2.2.9/sc-2.0.5/sb-1.3.2/sp-2.0.0/datatables.min.css" />

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.11.5/b-2.2.2/b-colvis-2.2.2/b-html5-2.2.2/b-print-2.2.2/fh-3.2.2/r-2.2.9/sc-2.0.5/sb-1.3.2/sp-2.0.0/datatables.min.js"></script>

<script>
	$(document).ready(function() {

		table = $('#datatables').DataTable({
			"dom": 'Blfrtip',
			lengthMenu: [
				[10, 25, 50, -1],
				['10 rows', '25 rows', '50 rows', 'Show all']
			],
			"destroy": true,
			"responsive": false,
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
					"data": "profit_stacking",
				},
				{
					"data": "profit_trade",
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

						if (res.profit_stacking == 'ya') {

							var btnStacking = `
							<li>
								<a href="#" onclick="updateStack('${res.id}', '${res.email}', 'tidak')">
									<i class="fa fa-times"></i> Stop Stacking
								</a>
							</li>`;
						} else {
							var btnStacking = `
							<li>
								<a href="#" onclick="updateStack('${res.id}', '${res.email}', 'ya')">
									<i class="fa fa-times"></i> Start Stacking
								</a>
							</li>`;
						}

						if (res.profit_trade == 'ya') {

							var btnTrade = `
							<li>
								<a href="#" onclick="updateTrade('${res.id}', '${res.email}', 'tidak')">
									<i class="fa fa-times"></i> Stop Trade
								</a>
							</li>`;
						} else {
							var btnTrade = `
							<li>
								<a href="#" onclick="updateTrade('${res.id}', '${res.email}', 'ya')">
									<i class="fa fa-times"></i> Start Trade
								</a>
							</li>`;
						}

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
								<i class="fa fa-refresh"></i> Reset Rekening
							</a>
						</li>`;

						var btnResetWallet = `
						<li>
							<a href="#" onclick="modalWallet('${res.id}')">
								<i class="fa fa-refresh"></i> Reset Wallet
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
								${btnStacking}
								${btnTrade}
								${btnResetEmail}
								${btnResetPassword}
								${btnResetPin}
								${btnResetRekening}
								${btnResetWallet}
								${btnDelete}
							</ul>
						</div>`;
						return htmlnya;
					}
				},
			],
			buttons: [{
				extend: 'excelHtml5',
				exportOptions: {
					modifier: {
						page: 'all',
						search: 'none'
					}
				},
			}]
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

		$('#form_wallet').on('submit', function(e) {
			e.preventDefault();

			$.ajax({
				url: `<?= site_url(); ?>admins/user_reset_wallet`,
				method: 'post',
				dataType: 'json',
				data: {
					id_user_wallet_edit: $('#id_user_wallet_edit').val(),
					no_wallet_edit: $('#no_wallet_edit').val(),
				},
				beforeSend: function() {
					$('#btn_save_wallet').attr('disabled', true);
					$.blockUI();
				}
			}).fail(function(e) {
				console.log(e);
				$.unblockUI();
				$('#btn_save_wallet').attr('disabled', false);
			}).done(function(res) {
				if (res.code == 200) {
					Swal.fire({
						position: 'top-end',
						icon: 'success',
						title: `Reset Wallet Berhasil`,
						showConfirmButton: false,
						timer: 1500
					}).then(function() {
						$('#id_user_wallet_edit').val(null);
						$('#no_wallet_edit').val(null);
						$('#modal_wallet').modal('hide');
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
				$('#btn_save_wallet').attr('disabled', false);
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

	function modalWallet(id) {
		$('#no_wallet_edit').val(null);
		$('#id_user_wallet_edit').val(id);
		$('#modal_wallet').modal('show');
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

	function updateStack(id_user, email, status) {
		var title = 'Stop Profit Stacking ?';
		if (status == 'ya') {
			var title = `Lanjut Profit Stacking email ${email} ?`;
		}
		Swal.fire({
			icon: 'question',
			title: title,
			showConfirmButton: true,
			showCancelButton: true,
		}).then(function(e) {
			if (e.isConfirmed) {
				$.ajax({
					url: `<?= site_url(); ?>admins/user_profit_stacking_update`,
					method: 'post',
					dataType: 'json',
					data: {
						id_user: id_user,
						status: status
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
							text: 'Proses Update Profit Stacking Gagal, Tidak Terhubung Dengan Database',
						});
					} else if (e.code == 200) {
						Swal.fire({
							icon: 'success',
							title: 'Success...',
							text: 'Update Profit Stacking Berhasil.',
						});
					}
					table.draw();
				});
			}
		});
	}

	function updateTrade(id_user, email, status) {
		var title = 'Stop Profit Trade ?';
		if (status == 'ya') {
			var title = `Lanjut Profit Trade email ${email} ?`;
		}
		Swal.fire({
			icon: 'question',
			title: title,
			showConfirmButton: true,
			showCancelButton: true,
		}).then(function(e) {
			if (e.isConfirmed) {
				$.ajax({
					url: `<?= site_url(); ?>admins/user_profit_trade_update`,
					method: 'post',
					dataType: 'json',
					data: {
						id_user: id_user,
						status: status
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
							text: 'Proses Update Profit Trade Gagal, Tidak Terhubung Dengan Database',
						});
					} else if (e.code == 200) {
						Swal.fire({
							icon: 'success',
							title: 'Success...',
							text: 'Update Profit Trade Berhasil.',
						});
					}
					table.draw();
				});
			}
		});
	}
</script>