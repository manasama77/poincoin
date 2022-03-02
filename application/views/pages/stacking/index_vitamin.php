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
			"dom": 'Bfrtip',
			"order": [
				[0, "DESC"]
			],
			"columnDefs": [{
				"targets": [10],
				"orderable": false,
			}, ],
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
					url: `<?= site_url(); ?>admin/bioner_stacking/delete_stacking`,
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
				}).always(function(res) {
					$.unblockUI();
				}).fail(function(res) {
					console.log(res);
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

				});
			}
		});
	}
</script>