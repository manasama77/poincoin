<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap.min.css">

<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap.min.js">
</script>
<script>
	$(document).ready(function() {
		table = $('#datatables').DataTable({
			"columnDefs": [{
				"targets": [2],
				"orderable": false,
			}, ],
		});

		$('#form_add').on('submit', function(e) {
			e.preventDefault();

			$.ajax({
				url: `<?= site_url(); ?>vendors/store`,
				method: 'post',
				dataType: 'json',
				data: $('#form_add').serialize(),
				beforeSend: function() {
					$.blockUI();
				}
			}).fail(function(res) {
				console.log(res);
				$.unblockUI();
			}).done(function(res) {
				if (res.code == 201) {
					alert('Tambah Data Berhasil');
					window.location.reload();
				} else if (res.code == 409) {
					let nama = $('#nama').val();
					let nama_kategori = $('#id_kategori').find(':selected').text();
					alert(`Vendor ${nama} dengan Kategori ${nama_kategori} telah terdaftar`);
				} else {
					alert('Tambah Data Gagal');
				}
				$.unblockUI();
			});
		});

		$('#form_edit').on('submit', function(e) {
			e.preventDefault();

			if ($('#nama_edit').val() == $('#prev_nama_edit').val()) {
				$.unblockUI();
				$('#modal_edit').modal('hide');
			} else {
				$.ajax({
					url: `<?= site_url(); ?>vendors/update`,
					method: 'post',
					dataType: 'json',
					data: $('#form_edit').serialize(),
					beforeSend: function() {
						$.blockUI();
					}
				}).fail(function(res) {
					console.log(res);
					$.unblockUI();
				}).done(function(res) {
					if (res.code == 200) {
						alert('Edit Data Berhasil');
						window.location.reload();
					} else if (res.code == 400) {
						alert(`Nama ${$('#nama_edit').val()} Kategori ${$('#id_kategori_edit').find(':selected').text()} Telah Terdaftar`)
					} else {
						alert('Edit Data Gagal');
					}
					$.unblockUI();
				});
			}
		});

	});

	function editData(id, nama, id_kategori) {
		$('#id_edit').val(id);
		$('#nama_edit').val(nama);
		$('#prev_nama_edit').val(nama);
		$('#id_kategori_edit').val(id_kategori);
		$('#modal_edit').modal('show');
	}

	function deleteData(id) {
		let c = confirm('Hapus Data ?');

		if (c == true) {
			$.ajax({
					url: `<?= site_url(); ?>vendors/destroy`,
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
					if (res.code == 204) {
						alert('Hapus Data Berhasil');
						window.location.reload();
					} else {
						alert('Hapus Data Gagal');
					}
					$.unblockUI();

				});
		}
	}
</script>