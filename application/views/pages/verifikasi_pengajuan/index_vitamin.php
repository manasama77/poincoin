<script>
	let select2 = $('.select2'),
		form_data_pengajuan = $('#form_data_pengajuan'),
		form_add = $('#form_add'),
		html_option = `<option value=""></option>`,
		no_kredit = $('#no_kredit'),
		tanggal_pengajuan = $('#tanggal_pengajuan'),
		id_marketing = $('#id_marketing'),
		nama_customer = $('#nama_customer'),
		alamat = $('#alamat'),
		no_telp = $('#no_telp'),
		email = $('#email'),
		id_pekerjaan = $('#id_pekerjaan'),
		hubungan = $('#hubungan'),
		nama_penjamin = $('#nama_penjamin'),
		no_telp_penjamin = $('#no_telp_penjamin'),
		sumber_pendapatan = $('#sumber_pendapatan'),
		penghasilan_perbulan = $('#penghasilan_perbulan'),
		id_kategori = $('#id_kategori'),
		id_vendor = $('#id_vendor'),
		id_jenis_barang = $('#id_jenis_barang'),
		id_barang = $('#id_barang'),
		spesifikasi = $('#spesifikasi'),
		hpp = $('#hpp'),
		tenor = $('#tenor'),
		pokok = $('#pokok'),
		margin = $('#margin'),
		total_angsuran = $('#total_angsuran'),
		angsuran = $('#angsuran'),
		nilai_pokok = 0,
		nilai_margin = 0,
		nilai_total_angsuran = 0,
		nilai_angsuran = 0;

	const enam = 25,
		delapan = 30,
		sepuluh = 35;

	$(document).ready(function() {

		select2.select2({
			allowClear: true,
			theme: 'classic',
			width: 'resolve'
		});

		penghasilan_perbulan.inputmask({
			alias: 'currency',
			placeholder: '0',
			autoGroup: !0,
			digits: 0,
			digitsOptional: !1,
			clearMaskOnLostFocus: !1
		});

		hpp.inputmask({
			alias: 'currency',
			placeholder: '0',
			autoGroup: !0,
			digits: 0,
			digitsOptional: !1,
			clearMaskOnLostFocus: !1
		});

		pokok.inputmask({
			alias: 'currency',
			placeholder: '0',
			autoGroup: !0,
			digits: 0,
			digitsOptional: !1,
			clearMaskOnLostFocus: !1
		});

		margin.inputmask({
			alias: 'currency',
			placeholder: '0',
			autoGroup: !0,
			digits: 0,
			digitsOptional: !1,
			clearMaskOnLostFocus: !1
		});

		angsuran.inputmask({
			alias: 'currency',
			placeholder: '0',
			autoGroup: !0,
			digits: 0,
			digitsOptional: !1,
			clearMaskOnLostFocus: !1
		});

		total_angsuran.inputmask({
			alias: 'currency',
			placeholder: '0',
			autoGroup: !0,
			digits: 0,
			digitsOptional: !1,
			clearMaskOnLostFocus: !1
		});

		initTrigger();
	});

	function initTrigger() {

		no_kredit.on('change', function() {
			emptyFormData();
			if (no_kredit.val().length > 0) {
				setTimeout(function() {
					dataNamaCustomer = no_kredit.find(':selected').data('nama_customer');
					dataAlamat = no_kredit.find(':selected').data('alamat');
					dataNoTelp = no_kredit.find(':selected').data('no_telp');
					dataEmail = no_kredit.find(':selected').data('email');
					dataIdPekerjaan = no_kredit.find(':selected').data('id_pekerjaan');
					dataHubungan = no_kredit.find(':selected').data('hubungan');
					dataNamaPenjamin = no_kredit.find(':selected').data('nama_penjamin');
					dataNoPenjamin = no_kredit.find(':selected').data('no_telp_penjamin');
					dataSumberPendapatan = no_kredit.find(':selected').data('sumber_pendapatan');
					dataPenghasilanPerbulan = no_kredit.find(':selected').data('penghasilan_perbulan');
					dataTanggalPengajuan = no_kredit.find(':selected').data('tanggal_pengajuan');
					dataIdMarketing = no_kredit.find(':selected').data('id_marketing');

					nama_customer.val(dataNamaCustomer);
					alamat.val(dataAlamat);
					no_telp.val(dataNoTelp);
					email.val(dataEmail);
					id_pekerjaan.val(dataIdPekerjaan);
					hubungan.val(dataHubungan);
					nama_penjamin.val(dataNamaPenjamin);
					no_telp_penjamin.val(dataNoPenjamin);
					sumber_pendapatan.val(dataSumberPendapatan);
					penghasilan_perbulan.val(dataPenghasilanPerbulan);
					tanggal_pengajuan.val(dataTanggalPengajuan);
					id_marketing.val(dataIdMarketing);

					getPengajuanBarang();

					form_data_pengajuan.show('slow');
				}, 300);
			} else {
				setTimeout(function() {
					form_data_pengajuan.hide('slow');
				}, 300);
			}
		});

		id_kategori.on('change', function(e) {
			e.preventDefault();

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
						id_vendor.parent().block({
							message: '...'
						});
						id_vendor.html(`<option value=""></option>`).attr('disabled', true);
						id_jenis_barang.html(`<option value=""></option>`).attr('disabled', true);
						id_barang.html(`<option value=""></option>`).attr('disabled', true);
					}
				}).always(function(res) {
					id_vendor.parent().unblock();
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

						id_vendor.html(html).attr('disabled', false);
					}
				});
			} else {
				console.log("do nothing");
			}

		});

		id_vendor.on('change', function(e) {
			e.preventDefault();

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
						id_jenis_barang.parent().block({
							message: '...'
						});
						id_jenis_barang.html(`<option value=""></option>`).attr('disabled', true);
						id_barang.html(`<option value=""></option>`).attr('disabled', true);
					}
				}).always(function(res) {
					id_jenis_barang.parent().unblock();
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

						id_jenis_barang.html(html).attr('disabled', false);
					}
				});
			} else {
				console.log("do nothing");
			}

		});

		id_jenis_barang.on('change', function(e) {
			e.preventDefault();

			if (id_jenis_barang.val().length > 0) {
				$.ajax({
					url: '<?= base_url(); ?>barang/show',
					method: 'get',
					dataType: 'json',
					data: {
						id: null,
						id_jenis_barang: id_jenis_barang.val()
					},
					beforeSend: function() {
						id_barang.parent().block({
							message: '...'
						});
						id_barang.html(`<option value=""></option>`).attr('disabled', true);
					}
				}).always(function(res) {
					id_barang.parent().unblock();
				}).fail(function(res) {
					console.warn(res);
				}).done(function(res) {
					console.log(res);

					if (res.code == 404) {
						Swal.fire({
							position: 'top-end',
							icon: 'info',
							title: 'Data Barang Kosong',
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
							let data = `
							data-id_kategori="${k.id_kategori}" 
							data-id_vendor="${k.id_vendor}" 
							data-id_jenis_barang="${k.id_jenis_barang}" 
							data-spesifikasi="${k.spesifikasi}" 
							data-hpp="${k.hpp}" 
							`;
							html += `<option value="${k.id}" ${data}>${k.nama}</option>`;
						});

						id_barang.html(html).attr('disabled', false);
					}
				});
			} else {
				console.log("do nothing");
			}

		});

		id_barang.on('change', function() {
			dataSpesifikasi = $(this).find(':selected').data('spesifikasi');
			dataHpp = $(this).find(':selected').data('hpp');

			spesifikasi.val(dataSpesifikasi);
			hpp.val(dataHpp);

			if (tenor.val().length > 0 || hpp.val().replace(/,/g, '') > 0) {
				hitungPokok();
			} else {
				console.log("nothing to do");
			}
		});

		hpp.on('change, keyup', function() {
			if (tenor.val().length > 0) {
				hitungPokok();
			}
		});

		tenor.on('change', function() {
			if (hpp.val().replace(/,/g, '') > 0) {
				hitungPokok();
			}
		});

		form_data_pengajuan.on('submit', function(e) {
			e.preventDefault();
			Swal.fire({
				title: 'Apakah kamu yakin?',
				text: "Kamu akan menambahkan data pengajuan baru menjadi data terverfikasi, pastikan pada saat pengisian data tidak ada kesalahan!",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Ya, saya mengerti!'
			}).then((result) => {
				if (result.isConfirmed) {
					prosesAdd();
				}
			});
		});
	}

	function hitungPokok() {
		nilai_pokok = parseFloat(hpp.val().replace(/,/g, ''));
		nilai_pokok = Math.round(nilai_pokok.toFixed(2));
		nilai_pokok = nilai_pokok.toString();

		nilai_pokok_perbulan = parseFloat(hpp.val().replace(/,/g, '') / tenor.val());
		nilai_pokok_perbulan = Math.round(nilai_pokok_perbulan.toFixed(2));
		nilai_pokok_perbulan = nilai_pokok_perbulan.toString();

		pokok.val(hpp.val().replace(/,/g, ''));

		hitungMargin();
	}

	function hitungMargin() {
		let persenMargin = 0;
		if (tenor.val() == 6) {
			persenMargin = enam;
		} else if (tenor.val() == 8) {
			persenMargin = delapan;
		} else if (tenor.val() == 10) {
			persenMargin = sepuluh;
		}

		nilai_margin = (hpp.val().replace(/,/g, '') * persenMargin / 100);
		nilai_margin = Math.round(parseFloat(nilai_margin.toFixed(2)));
		nilai_margin = nilai_margin.toString();

		nilai_margin_perbulan = (hpp.val().replace(/,/g, '') * persenMargin / 100) / tenor.val();
		nilai_margin_perbulan = Math.round(parseFloat(nilai_margin_perbulan.toFixed(2)));
		nilai_margin_perbulan = nilai_margin_perbulan.toString();

		margin.val(nilai_margin.replace('.', ','));

		hitungAngsuran();
	}

	function hitungAngsuran() {
		nilai_angsuran = parseFloat(nilai_pokok_perbulan) + parseFloat(nilai_margin_perbulan);
		nilai_angsuran = Math.round(parseFloat(nilai_angsuran.toFixed(2)));
		nilai_angsuran = nilai_angsuran.toString();
		angsuran.val(nilai_angsuran.replace('.', ','));

		hitungTotalAngsuran();
	}

	function hitungTotalAngsuran() {
		nilai_total_angsuran = parseFloat(nilai_angsuran) * parseFloat(tenor.val());
		nilai_total_angsuran = Math.round(parseFloat(nilai_total_angsuran.toFixed(2)));
		nilai_total_angsuran = nilai_total_angsuran.toString();
		total_angsuran.val(nilai_total_angsuran.replace('.', ','));
	}

	function prosesAdd() {
		if (no_kredit.val().length <= 1) {
			Swal.fire({
				icon: 'warning',
				title: 'Oops...',
				text: `No Kredit Belum Terpilih, silahkan cek kembali`,
				showCancelButton: false,
				confirmButtonText: 'OK'
			}).then(function(result) {
				console.log(result);
				if (result.isConfirmed) {
					setTimeout(function() {
						no_kredit.focus();
					}, 500);
				}
			});
		} else if (hpp.val().length <= 1) {
			Swal.fire({
				icon: 'warning',
				title: 'Oops...',
				text: `Harga Produk Salah, silahkan cek kembali`,
				showCancelButton: false,
				confirmButtonText: 'OK'
			}).then(function(result) {
				console.log(result);
				if (result.isConfirmed) {
					setTimeout(function() {
						hpp.focus();
					}, 500);
				}
			});
		} else if (pokok.val().length <= 1) {
			Swal.fire({
				icon: 'warning',
				title: 'Oops...',
				text: `Pokok Salah, silahkan cek kembali`,
				showCancelButton: false,
				confirmButtonText: 'OK'
			}).then(function(result) {
				console.log(result);
				if (result.isConfirmed) {
					setTimeout(function() {
						pokok.focus();
					}, 500);
				}
			});
		} else if (margin.val().length <= 1) {
			Swal.fire({
				icon: 'warning',
				title: 'Oops...',
				text: `Margin Salah, silahkan cek kembali`,
				showCancelButton: false,
				confirmButtonText: 'OK'
			}).then(function(result) {
				console.log(result);
				if (result.isConfirmed) {
					setTimeout(function() {
						margin.focus();
					}, 500);
				}
			});
		} else if (angsuran.val().length <= 1) {
			Swal.fire({
				icon: 'warning',
				title: 'Oops...',
				text: `Angsuran Salah, silahkan cek kembali`,
				showCancelButton: false,
				confirmButtonText: 'OK'
			}).then(function(result) {
				console.log(result);
				if (result.isConfirmed) {
					setTimeout(function() {
						angsuran.focus();
					}, 500);
				}
			});
		} else {
			let isiData = form_add[0];
			let formData = new FormData(isiData);
			$.ajax({
				url: `<?= site_url(); ?>pengajuan/store`,
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
				if (res.code == 500) {
					Swal.fire({
						icon: 'error',
						title: '[500] Oops...',
						text: 'Tidak terhubung dengan database, silahkan refresh halaman',
					});
				} else if (res.code == 200) {
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
	}

	function emptyFormData() {
		nama_customer.val('');
		alamat.val('');
		no_telp.val('');
		email.val('');
		id_pekerjaan.val('');
		tanggal_pengajuan.val('');
		id_marketing.val('');
		hubungan.val('');
		nama_penjamin.val('');
		no_telp_penjamin.val('');
		sumber_pendapatan.val('');
		penghasilan_perbulan.val('');
		id_kategori.val('');
		id_vendor.val('');
		id_jenis_barang.val('');
		id_barang.val('');
		spesifikasi.val('');
		hpp.val('');
		tenor.val('');
		pokok.val('');
		total_angsuran.val('');
	}

	function getPengajuanBarang() {
		$.ajax({
			url: '<?= site_url(); ?>pengajuan/show_barang',
			method: 'get',
			dataType: 'json',
			data: {
				no_kredit: no_kredit.val()
			},
			beforeSend: function() {
				$.blockUI();
			}
		}).always(function(res) {
			console.log(res);
			$.unblockUI();
		}).fail(function(res) {
			console.log(res);
		}).done(function(res) {
			console.log(res);
			if (res.code == 404) {
				alert('Data Barang Tidak Ditemukan');
			} else if (res.code == 500) {
				alert('Terjadi kesalahan dengan database');
			} else {
				console.log(res.data)
				$.each(res.data, function(i, k) {
					id_kategori.val(k.id_kategori).trigger('change');
					setTimeout(function() {
						id_vendor.val(k.id_vendor).trigger('change');
						setTimeout(function() {
							id_jenis_barang.val(k.id_jenis_barang).trigger('change');
							setTimeout(function() {
								id_barang.val(k.id_barang).trigger('change');
								setTimeout(function() {
									tenor.val(k.tenor).trigger('change');
								}, 300);
							}, 300);
						}, 300);
					}, 300);
				});
			}
		});
	}
</script>