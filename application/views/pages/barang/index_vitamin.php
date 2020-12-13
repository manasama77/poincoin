<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap.min.css">

<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap.min.js">
</script>
<script>
	$(document).ready(function() {
		table = $('#datatables').DataTable({
			"columnDefs": [{
				"targets": [6],
				"orderable": false,
			}, ],
		});

		$('#hpp').inputmask({
			alias: 'currency',
			placeholder: '0',
			autoGroup: !0,
			digits: 0,
			digitsOptional: !1,
			clearMaskOnLostFocus: !1
		});

		$('#hpp_edit').inputmask({
			alias: 'currency',
			placeholder: '0',
			autoGroup: !0,
			digits: 0,
			digitsOptional: !1,
			clearMaskOnLostFocus: !1
		});

		$('#id_kategori').on('change', function(e) {
			e.preventDefault();

			let id_kategori = $(this);

			if (id_kategori.val().length > 0) {
				$.ajax({
					url: '<?= base_url(); ?>vendors/show',
					method: 'get',
					dataType: 'json',
					data: {
						id: null,
						id_kategori: id_kategori.val()
					},
					beforeSend: function() {
						$('#id_vendor').parent().block({
							message: '...'
						});
						$('#id_vendor').html(`<option value=""></option>`).attr('disabled', true);
						$('#id_jenis_barang').html(`<option value=""></option>`).attr('disabled', true);
					}
				}).always(function(res) {
					$('#id_vendor').parent().unblock();
				}).fail(function(res) {
					console.warn(res);
				}).done(function(res) {
					console.log(res);

					if (res.code == 404) {
						Swal.fire({
							position: 'top-end',
							icon: 'info',
							title: 'Data Vendor Kosong',
							showConfirmButton: false,
							timer: 1500
						});
					} else if (res.code == 500) {
						Swal.fire({
							position: 'top-end',
							icon: 'error',
							title: 'Terjadi kesalahan dengan database, silahkan hubungi Team IT',
							showConfirmButton: false,
							timer: 1500
						});
					} else {
						let html = `<option value=""></option>`;
						$.each(res.data, function(i, k) {
							html += `<option value="${k.id}">${k.nama}</option>`;
						});

						$('#id_vendor').html(html).attr('disabled', false);
					}
				});
			} else {
				console.log("do nothing");
			}

		});

		$('#id_vendor').on('change', function(e) {
			e.preventDefault();

			let id_vendor = $(this);

			if (id_vendor.val().length > 0) {
				$.ajax({
					url: '<?= base_url(); ?>jenis_barang/show',
					method: 'get',
					dataType: 'json',
					data: {
						id: null,
						id_vendor: id_vendor.val()
					},
					beforeSend: function() {
						$('#id_jenis_barang').parent().block({
							message: '...'
						});
						$('#id_jenis_barang').html(`<option value=""></option>`).attr('disabled', true);
					}
				}).always(function(res) {
					$('#id_jenis_barang').parent().unblock();
				}).fail(function(res) {
					console.warn(res);
				}).done(function(res) {
					console.log(res);

					if (res.code == 404) {
						Swal.fire({
							position: 'top-end',
							icon: 'info',
							title: 'Data Jenis Barang Kosong',
							showConfirmButton: false,
							timer: 1500
						});
					} else if (res.code == 500) {
						Swal.fire({
							position: 'top-end',
							icon: 'error',
							title: 'Terjadi kesalahan dengan database, silahkan hubungi Team IT',
							showConfirmButton: false,
							timer: 1500
						});
					} else {
						let html = `<option value=""></option>`;
						$.each(res.data, function(i, k) {
							html += `<option value="${k.id}">${k.nama}</option>`;
						});

						$('#id_jenis_barang').html(html).attr('disabled', false);
					}
				});
			} else {
				console.log("do nothing");
			}

		});

		$('#form_add').on('submit', function(e) {
			e.preventDefault();

			Swal.fire({
				title: 'Apakah kamu yakin?',
				text: "Kamu akan menambahkan data baru!",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Ya, Tambah Data!'
			}).then(function(result) {
				if (result.isConfirmed) {
					$.ajax({
						url: `<?= site_url(); ?>barang/store`,
						method: 'post',
						dataType: 'json',
						data: $('#form_add').serialize(),
						beforeSend: function() {
							$.blockUI();
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
								title: 'Tambah Data Berhasil',
								showConfirmButton: false,
								timer: 1500
							}).then((result) => {
								window.location.reload();
							});
						} else if (res.code == 400) {
							let nama = $('#nama').val();
							let nama_jenis_barang = $('#id_jenis_barang').find(':selected').text();
							Swal.fire({
								position: 'top-end',
								icon: 'warning',
								title: `Jenis Barang ${nama} dengan Jenis Barang ${nama_jenis_barang} telah terdaftar`,
								showConfirmButton: false,
								timer: 1500
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
		});

		$('#id_kategori_edit').on('change', function(e) {
			e.preventDefault();

			let id_kategori = $(this);

			if (id_kategori.val().length > 0) {
				$.ajax({
					url: '<?= base_url(); ?>vendors/show',
					method: 'get',
					dataType: 'json',
					data: {
						id: null,
						id_kategori: id_kategori.val()
					},
					beforeSend: function() {
						$('#id_vendor_edit').parent().block({
							message: '...'
						});
						$('#id_vendor_edit').html(`<option value=""></option>`).attr('disabled', true);
					}
				}).always(function(res) {
					$('#id_vendor_edit').parent().unblock();
				}).fail(function(res) {
					console.warn(res);
				}).done(function(res) {
					console.log(res);

					if (res.code == 404) {
						Swal.fire({
							position: 'top-end',
							icon: 'info',
							title: 'Data Vendor Kosong',
							showConfirmButton: false,
							timer: 1500
						});
					} else if (res.code == 500) {
						Swal.fire({
							position: 'top-end',
							icon: 'error',
							title: 'Terjadi kesalahan dengan database, silahkan hubungi Team IT',
							showConfirmButton: false,
							timer: 1500
						});
					} else {
						let html = `<option value=""></option>`;
						$.each(res.data, function(i, k) {
							html += `<option value="${k.id}">${k.nama}</option>`;
						});

						$('#id_vendor_edit').html(html).attr('disabled', false);
					}
				});
			} else {
				console.log("do nothing");
			}

		});

		$('#id_vendor_edit').on('change', function(e) {
			e.preventDefault();

			let id_vendor = $(this);

			if (id_vendor.val().length > 0) {
				$.ajax({
					url: '<?= base_url(); ?>jenis_barang/show',
					method: 'get',
					dataType: 'json',
					data: {
						id: null,
						id_vendor: id_vendor.val()
					},
					beforeSend: function() {
						$('#id_jenis_barang_edit').parent().block({
							message: '...'
						});
						$('#id_jenis_barang_edit').html(`<option value=""></option>`).attr('disabled', true);
					}
				}).always(function(res) {
					$('#id_jenis_barang_edit').parent().unblock();
				}).fail(function(res) {
					console.warn(res);
				}).done(function(res) {
					console.log(res);

					if (res.code == 404) {
						Swal.fire({
							position: 'top-end',
							icon: 'info',
							title: 'Data Jenis Barang Kosong',
							showConfirmButton: false,
							timer: 1500
						});
					} else if (res.code == 500) {
						Swal.fire({
							position: 'top-end',
							icon: 'error',
							title: 'Terjadi kesalahan dengan database, silahkan hubungi Team IT',
							showConfirmButton: false,
							timer: 1500
						});
					} else {
						let html = `<option value=""></option>`;
						$.each(res.data, function(i, k) {
							html += `<option value="${k.id}">${k.nama}</option>`;
						});

						$('#id_jenis_barang_edit').html(html).attr('disabled', false);
					}
				});
			} else {
				console.log("do nothing");
			}

		});

		$('#form_edit').on('submit', function(e) {
			e.preventDefault();

			Swal.fire({
				title: 'Apakah kamu yakin?',
				text: "Kamu akan mengedit data!",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Ya, Edit Data!'
			}).then(function(result) {
				if (result.isConfirmed) {
					$.ajax({
						url: `<?= site_url(); ?>barang/update`,
						method: 'post',
						dataType: 'json',
						data: $('#form_edit').serialize(),
						beforeSend: function() {
							$('#modal_edit').block();
						}
					}).always(function(res) {
						$('#modal_edit').unblock();
					}).fail(function(res) {
						console.log(res);
					}).done(function(res) {
						if (res.code == 200) {
							Swal.fire({
								position: 'top-end',
								icon: 'success',
								title: 'Edit Data Berhasil',
								showConfirmButton: false,
								timer: 1500
							}).then((result) => {
								window.location.reload();
							});
						} else if (res.code == 400) {
							let nama = $('#nama_edit').val();
							let nama_jenis_barang = $('#id_jenis_barang_edit').find(':selected').text();
							Swal.fire({
								position: 'top-end',
								icon: 'warning',
								title: `Jenis Barang ${nama} dengan Vendor ${nama_jenis_barang} telah terdaftar`,
								showConfirmButton: false,
								timer: 1500
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
		});

	});

	function editData(id_kategori, id_vendor, id_jenis_barang, nama, spesifikasi, hpp, id) {
		$.blockUI();

		if (id_kategori != 0) {
			$('#id_kategori_edit').val(id_kategori).trigger('change');

			setTimeout(function() {

				if (id_vendor != 0) {
					$('#id_vendor_edit').val(id_vendor).trigger('change');
					setTimeout(function() {
						$('#id_jenis_barang_edit').val(id_jenis_barang);
					}, 500);
				}

			}, 500);
		}

		$('#nama_edit').val(nama);
		$('#spesifikasi_edit').val(spesifikasi);
		$('#hpp_edit').val(hpp);
		$('#id_edit').val(id);
		$('#prev_nama').val(nama);
		$('#prev_id_jenis_barang').val(id_jenis_barang);
		$('#id_edit').val(id);

		setTimeout(function() {
			$('#modal_edit').modal('show');
			$.unblockUI();
		}, 1000);
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