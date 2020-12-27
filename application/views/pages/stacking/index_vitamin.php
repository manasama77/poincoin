<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap.min.css">

<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap.min.js">
</script>
<script>
	$(document).ready(function() {
		table = $('#datatables').DataTable({
			"columnDefs": [{
				"targets": [9],
				"orderable": false,
			}, ],
		});
	});

	function verifikasiTransfer(id, kode) {
		Swal.fire({
			title: 'Apakah kamu yakin?',
			text: `Kamu akan memverifikasi bioner stacking dengan kode ${kode}`,
			icon: 'question',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Ya, Verifikasi!'
		}).then(function(result) {
			if (result.isConfirmed) {
				$.ajax({
					url: `<?= site_url(); ?>admin/bioner_stacking/verifikasi_transfer`,
					method: 'post',
					dataType: 'json',
					data: {
						id: id
					},
					beforeSend: function() {
						$.blockUI();
					},
				}).always(function(res) {
					$.unblockUI();
				}).fail(function(res) {
					Swal.fire({
						position: 'top-end',
						icon: 'error',
						title: `Terjadi kesalahan dengan database, silahkan hubungi team IT`,
						showConfirmButton: false,
						timer: 1500
					});
				}).done(function(res) {
					if (res.code == 200) {
						Swal.fire({
							position: 'top-end',
							icon: 'success',
							title: 'Verifikasi Data Berhasil',
							showConfirmButton: false,
							timer: 1500
						}).then((result) => {
							window.location.reload();
						});
					} else {
						Swal.fire({
							position: 'top-end',
							icon: 'error',
							title: `Terjadi kesalahan dengan database, silahkan hubungi team IT`,
							showConfirmButton: false,
							timer: 1500
						});
					}
					$.unblockUI();

				});
			}
		});
	}

	function deleteData(id) {
		Swal.fire({
			title: 'Apakah kamu yakin?',
			text: "Kamu akan menghapus data!",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Ya, Hapus Data!'
		}).then(function(result) {
			if (result.isConfirmed) {
				$.ajax({
					url: `<?= site_url(); ?>barang/destroy`,
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
							title: `Terjadi kesalahan dengan database, silahkan hubungi team IT`,
							showConfirmButton: false,
							timer: 1500
						});
					}
				}).done(function(res) {
					if (res.code == 200) {
						Swal.fire({
							position: 'top-end',
							icon: 'success',
							title: 'Hapus Data Berhasil',
							showConfirmButton: false,
							timer: 1500
						}).then((result) => {
							window.location.reload();
						});
					} else {
						Swal.fire({
							position: 'top-end',
							icon: 'error',
							title: `Terjadi kesalahan dengan database, silahkan hubungi team IT`,
							showConfirmButton: false,
							timer: 1500
						});
					}
					$.unblockUI();

				});
			}
		});
	}
</script>