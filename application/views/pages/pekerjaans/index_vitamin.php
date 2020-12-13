<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap.min.css">

<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap.min.js"></script>
<script>
	let form_add = $('#form_add'),
		nama = $('#nama'),
		form_edit = $('#form_edit'),
		modal_edit = $('#modal_edit'),
		title_edit = $('#title_edit'),
		nama_edit = $('#nama_edit'),
		id_edit = $('#id_edit'),
		prev_nama_edit = $('#prev_nama_edit');

	$(document).ready(function() {
		table = $('#datatables').DataTable({
			"columnDefs": [{
					"targets": [2],
					"orderable": false,
				},
				{
					"targets": [0, 2],
					"className": "text-center"
				}
			],
		});

		form_add.on('submit', function(e) {
			e.preventDefault();

			if (nama.val().length == 0) {
				Swal.fire({
					icon: 'warning',
					title: 'Oops...',
					text: 'Nama tidak boleh kosong',
				}).then(function(result) {
					if (result.isConfirmed) {
						nama.focus();
					}
				});
			} else if (nama.val().length < 3) {
				Swal.fire({
					icon: 'warning',
					title: 'Oops...',
					text: 'Nama tidak boleh kurang dari 3 karakter',
				}).then(function(result) {
					if (result.isConfirmed) {
						nama.focus();
					}
				});
			} else {
				$.ajax({
					url: `<?= site_url(); ?>pekerjaans/store`,
					method: 'post',
					dataType: 'json',
					data: form_add.serialize(),
					beforeSend: function() {
						$.blockUI();
					}
				}).fail(function(res) {
					console.log(res);
					$.unblockUI();
				}).done(function(res) {
					if (res.code == 400) {
						Swal.fire({
							icon: 'error',
							title: '[400] Oops...',
							text: 'Nama Pekerjaan telah terdaftar, silahkan gunakan nama lain',
						}).then(function(result) {
							if (result.isConfirmed) {
								nama.focus();
							}
						});
					} else if (res.code == 500) {
						Swal.fire({
							icon: 'error',
							title: '[500] Oops...',
							text: 'Tidak terhubung dengan database, silahkan refresh halaman',
						});
					} else if (res.code == 200) {
						nama.val('');
						Swal.fire({
							icon: 'success',
							title: '[200] Success...',
							text: 'Tambah data berhasil',
						}).then(function(result) {
							if (result.isConfirmed) {
								window.location.reload();
							}
						});
					} else {
						Swal.fire({
							icon: 'error',
							title: 'Unknown response...',
							text: 'Silahkan refresh halaman',
						});
					}

					$.unblockUI();
				});
			}
		});

		form_edit.on('submit', function(e) {
			e.preventDefault();

			if (nama_edit.val().length == 0) {
				Swal.fire({
					icon: 'warning',
					title: 'Oops...',
					text: 'Nama tidak boleh kosong',
				}).then(function(result) {
					if (result.isConfirmed) {
						nama_edit.focus();
					}
				});
			} else if (nama_edit.val().length < 3) {
				Swal.fire({
					icon: 'warning',
					title: 'Oops...',
					text: 'Nama tidak boleh kurang dari 3 karakter',
				}).then(function(result) {
					if (result.isConfirmed) {
						nama_edit.focus();
					}
				});
			} else if (nama_edit.val() == prev_nama_edit.val()) {
				Swal.fire({
					icon: 'warning',
					title: 'Oops...',
					text: 'Tidak ada perubahan nama pekerjaan',
				}).then(function(result) {
					if (result.isConfirmed) {
						modal_edit.modal('hide');
					}
				});
			} else {
				$.ajax({
					url: `<?= site_url(); ?>pekerjaans/update`,
					method: 'post',
					dataType: 'json',
					data: form_edit.serialize(),
					beforeSend: function() {
						$.blockUI();
					}
				}).fail(function(res) {
					console.log(res);
					$.unblockUI();
				}).done(function(res) {
					if (res.code == 400) {
						Swal.fire({
							icon: 'error',
							title: '[400] Oops...',
							text: 'Nama Pekerjaan telah terdaftar, silahkan gunakan nama lain',
						}).then(function(result) {
							if (result.isConfirmed) {
								nama.focus();
							}
						});
					} else if (res.code == 500) {
						Swal.fire({
							icon: 'error',
							title: '[500] Oops...',
							text: 'Tidak terhubung dengan database, silahkan refresh halaman',
						});
					} else if (res.code == 200) {
						nama.val('');
						Swal.fire({
							icon: 'success',
							title: '[200] Success...',
							text: 'Update data berhasil',
						}).then(function(result) {
							if (result.isConfirmed) {
								window.location.reload();
							}
						});
					} else {
						Swal.fire({
							icon: 'error',
							title: 'Unknown response...',
							text: 'Silahkan refresh halaman',
						});
					}

					$.unblockUI();
				});
			}
		});

	});

	function editData(data_id_edit, data_nama_edit) {
		title_edit.text(data_nama_edit);
		id_edit.val(data_id_edit);
		nama_edit.val(data_nama_edit);
		prev_nama_edit.val(data_nama_edit);
		modal_edit.modal('show');
	}

	function destroyData(id_delete, nama_delete) {
		Swal.fire({
			icon: 'question',
			title: 'Delete Data ?',
			text: `Kamu akan delete data pekerjaan ${nama_delete} ?`,
		}).then(function(result) {
			if (result.isConfirmed) {
				$.ajax({
					url: `<?= site_url(); ?>pekerjaans/destroy`,
					method: 'post',
					dataType: 'json',
					data: {
						id: id_delete
					},
					beforeSend: function() {
						$.blockUI();
					}
				}).fail(function(res) {
					console.log(res);
					$.unblockUI();
				}).done(function(res) {
					if (res.code == 500) {
						Swal.fire({
							icon: 'error',
							title: '[500] Oops...',
							text: 'Tidak terhubung dengan database, silahkan refresh halaman',
						});
					} else if (res.code == 200) {
						nama.val('');
						Swal.fire({
							icon: 'success',
							title: '[200] Success...',
							text: 'Delete data berhasil',
						}).then(function(result) {
							if (result.isConfirmed) {
								window.location.reload();
							}
						});
					} else {
						Swal.fire({
							icon: 'error',
							title: 'Unknown response...',
							text: 'Silahkan refresh halaman',
						});
					}

					$.unblockUI();
				});
			}
		});
	}
</script>