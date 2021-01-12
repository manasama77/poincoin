<script>
	let form_edit = $('#form_edit'),
		no_ktp = $('#no_ktp'),
		nama = $('#nama'),
		alias = $('#alias'),
		tgl_lahir = $('#tgl_lahir'),
		alamat = $('#alamat'),
		no_telp = $('#no_telp'),
		email = $('#email'),
		id_pekerjaan = $('#id_pekerjaan'),
		hubungan = $('#hubungan'),
		nama_penjamin = $('#nama_penjamin'),
		no_telp_penjamin = $('#no_telp_penjamin'),
		foto_ktp = $('#foto_ktp'),
		id = $('#id'),
		prev_no_ktp = $('#prev_no_ktp'),
		prev_foto_ktp = $('#prev_foto_ktp');

	$(document).ready(function() {
		form_edit.on('submit', function(e) {
			e.preventDefault();
			prosesEdit('back');
		});

		id_pekerjaan.val('<?= $data['id_pekerjaan']; ?>');
	});

	function prosesEdit(tipe) {
		if (no_ktp.val().length < 3) {
			Swal.fire({
				icon: 'warning',
				title: 'Oops...',
				text: `Panjang No KTP kurang dari 3 Digit`,
				showCancelButton: false,
				confirmButtonText: 'OK'
			}).then(function(result) {
				console.log(result);
				if (result.isConfirmed) {
					setTimeout(function() {
						no_ktp.focus();
					}, 500);
				}
			});
		} else {
			let isiData = form_edit[0];
			let formData = new FormData(isiData);
			$.ajax({
				url: `<?= site_url(); ?>customers/update`,
				method: 'post',
				dataType: 'json',
				contentType: false,
				processData: false,
				data: formData,
				beforeSend: function() {
					$.blockUI();
				}
			}).fail(function(res) {
				console.log(res);
				$.unblockUI();
			}).done(function(res) {
				if (res.code == 400) {
					if (res.field == 'nama') {
						Swal.fire({
							icon: 'error',
							title: '[400] Oops...',
							text: `Customer dengan nama ${nama.val()} telah terdaftar, silahkan gunakan nama lain`,
						}).then(function(result) {
							if (result.isConfirmed) {
								setTimeout(function() {
									nama.focus();
								}, 500);
							}
						});
					} else if (res.field == 'no_ktp') {
						Swal.fire({
							icon: 'error',
							title: '[400] Oops...',
							text: `Customer dengan no ktp ${no_ktp.val()} telah terdaftar, silahkan gunakan no ktp lain`,
						}).then(function(result) {
							if (result.isConfirmed) {
								setTimeout(function() {
									no_ktp.focus();
								}, 500);
							}
						});
					}
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
							if (tipe == 'continue') {
								window.location.reload();
							} else {
								window.location.replace(`<?= site_url(); ?>customers`);
							}
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
	}
</script>