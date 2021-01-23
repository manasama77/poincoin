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
				"url": `<?= site_url('datatables/news') ?>`,
				"type": "POST"
			},
			"columns": [{
					"data": "no"
				},
				{
					"data": "title"
				},
				{
					"data": null,
					"render": function(res) {
						console.log(res.status);
						(res.status == "show") ? color = "success": color = "danger";
						let htmlnya = `<button type="button" class="btn btn-${color} btn-sm" onclick="changeStatus('${res.id}', '${res.status}');">${res.status.toUpperCase()}</button>`;
						return htmlnya;
					}
				},
				{
					"data": "created_at"
				},
				{
					"data": "updated_at"
				},
				{
					"data": null,
					"render": function(res) {
						let vdel = ``;
						let vres = ``;

						vdel = `<button class="btn btn-danger btn-xs" onclick="deleteData('${res.id}');"><i class="fa fa-trash fa-fw"></i> Delete</button>`;

						vres = `<button class="btn btn-warning btn-xs" onclick="editData('${res.id}', '${res.title}', '${res.content.replace(/(\r\n|\n|\r)/gm, "")}', '${res.status}');"><i class="fa fa-pencil fa-fw"></i> Edit</button>`;

						html = `
						<div class="text-center">
							<div class="btn-group">
								${vres}
								${vdel}
							</div>
						</div>
						`;
						return html;
					}
				},
			],
			"columnDefs": [{
				"targets": [5],
				"orderable": false,
			}, ],
		});

		$('#form_edit').on('submit', function(e) {
			e.preventDefault();

			$.ajax({
				url: `<?= site_url(); ?>admins/news/update`,
				method: 'post',
				dataType: 'json',
				data: {
					id: $('#id_edit').val(),
					title: $('#title_edit').val(),
					content: $('#content_edit').val(),
					status: $('#status_edit').val(),
				},
				beforeSend: function() {
					$('#edit_submit').attr('disabled', true);
					$.blockUI();
				}
			}).done(function(res) {
				if (res.code == 200) {
					Swal.fire({
						position: 'top-end',
						icon: 'success',
						title: `Edit Berita Berhasil`,
						showConfirmButton: false,
						timer: 1500
					});
					$('#id_edit').val(null);
					$('#title_edit').val(null);
					$('#content_edit').val(null);
					$('#status_edit').val(null);
					$('#modal-edit').modal('hide');
					table.draw();
				} else {
					Swal.fire({
						position: 'top-end',
						icon: 'error',
						title: `Edit Berita Gagal, silahkan refresh halaman`,
						showConfirmButton: false,
						timer: 1500
					});
				}
				$('#edit_submit').attr('disabled', false);
				$.unblockUI();
			});
		});

	});

	function deleteData(id) {
		let c = confirm('Hapus Berita ?');

		if (c == true) {
			$.ajax({
				url: `<?= site_url(); ?>admins/news/destroy`,
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
						title: `Tidak terhubung dengan database, silahkan refresh halaman`,
						showConfirmButton: false,
						timer: 1500
					});
				}
			}).done(function(res) {
				if (res.code == 200) {
					Swal.fire({
						position: 'top-end',
						icon: 'success',
						title: `Hapus Berita Berhasil`,
						showConfirmButton: false,
						timer: 1500
					});
					table.draw();
				} else {
					Swal.fire({
						position: 'top-end',
						icon: 'error',
						title: `Hapus Berita Gagal, silahkan refresh halaman`,
						showConfirmButton: false,
						timer: 1500
					});
				}
				$.unblockUI();

			});
		}
	}

	function editData(id, title, content, status) {
		// console.log(content);
		$('#id_edit').val(id);
		$('#title_edit').val(title);
		$('#content_edit').val(content.replace(/<br\s*[\/]?>/gi, "\n"));
		$('#status_edit').val(status);
		$('#modal-edit').modal('show');

	}

	function changeStatus(id, status) {
		$.ajax({
			url: `<?= site_url(); ?>admins/news/change_status`,
			method: 'post',
			data: {
				id: id,
				status: status,
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
					title: `Tidak terhubung dengan database, silahkan refresh halaman`,
					showConfirmButton: false,
					timer: 1500
				});
			}
		}).done(function(res) {
			if (res.code == 200) {
				Swal.fire({
					position: 'top-end',
					icon: 'success',
					title: `Update Berhasil Berhasil`,
					showConfirmButton: false,
					timer: 1500
				});
				table.draw();
			} else {
				Swal.fire({
					position: 'top-end',
					icon: 'error',
					title: `Update Gagal, silahkan refresh halaman`,
					showConfirmButton: false,
					timer: 1500
				});
			}
			$.unblockUI();

		});
	}
</script>