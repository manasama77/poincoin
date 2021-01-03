<script>
    let form_tambah_rekening = $('#form_tambah_rekening'),
        form_edit_rekening = $('#form_edit_rekening'),
        modal_edit_rekening = $('#modal_edit_rekening'),
        id_bank_edit = $('#id_bank_edit'),
        no_rekening_edit = $('#no_rekening_edit'),
        atas_nama_edit = $('#atas_nama_edit'),
        id_user_banks_edit = $('#id_user_banks_edit');

    $('document').ready(function() {

        form_tambah_rekening.on('submit', function(e) {
            e.preventDefault();

            Swal.fire({
                title: 'Apakah kamu yakin?',
                text: `Tambah No Rekening Baru`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Saya Yakin!',
                cancelButtonText: 'Tidak jadi!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '<?= site_url(); ?>store_rekening',
                        method: 'post',
                        dataType: 'json',
                        data: form_tambah_rekening.serialize(),
                        beforeSend: function() {
                            $.blockUI();
                        }
                    }).always(function() {
                        $.unblockUI();
                    }).fail(function(res) {
                        console.log(res);
                    }).done(function(res) {
                        if (res.code == 500) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Proses Tambah Rekening Gagal, Tidak terhubung dengan database, silahkan cek koneksi kamu.',
                                timer: 3000,
                            });
                        } else if (res.code == 200) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success...',
                                html: `Proses Tambah Rekening Berhasil.`,
                            }).then(function(result) {
                                window.location.reload();
                            });
                        }
                    });
                }
            });
        });

        form_edit_rekening.on('submit', function(e) {
            e.preventDefault();

            Swal.fire({
                title: 'Apakah kamu yakin?',
                text: `Update No Rekening`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Saya Yakin!',
                cancelButtonText: 'Tidak jadi!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '<?= site_url(); ?>update_rekening',
                        method: 'post',
                        dataType: 'json',
                        data: form_edit_rekening.serialize(),
                        beforeSend: function() {
                            $.blockUI();
                        }
                    }).always(function() {
                        $.unblockUI();
                    }).fail(function(res) {
                        console.log(res);
                    }).done(function(res) {
                        if (res.code == 500) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Proses Update Rekening Gagal, Tidak terhubung dengan database, silahkan cek koneksi kamu.',
                                timer: 3000,
                            });
                        } else if (res.code == 200) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success...',
                                html: `Proses Update Rekening Berhasil.`,
                            }).then(function(result) {
                                window.location.reload();
                            });
                        }
                    });
                }
            });
        });


    });

    function editData(id_user_banks_ori, id_bank_ori, no_rekening_ori, atas_nama_ori) {
        id_user_banks_edit.val(id_user_banks_ori);
        id_bank_edit.val(id_bank_ori);
        no_rekening_edit.val(no_rekening_ori);
        atas_nama_edit.val(atas_nama_ori);
        modal_edit_rekening.modal('show');
    }

    function deleteData(id_user_banks_ori, id_bank_ori, no_rekening_ori, atas_nama_ori) {
        Swal.fire({
            title: 'Apakah kamu yakin?',
            text: `Delete No Rekening ${no_rekening_ori}`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Saya Yakin!',
            cancelButtonText: 'Tidak jadi!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?= site_url(); ?>destroy_rekening',
                    method: 'post',
                    dataType: 'json',
                    data: {
                        id: id_user_banks_ori
                    },
                    beforeSend: function() {
                        $.blockUI();
                    }
                }).always(function() {
                    $.unblockUI();
                }).fail(function(res) {
                    console.log(res);
                }).done(function(res) {
                    if (res.code == 500) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Proses Delete Rekening Gagal, Tidak terhubung dengan database, silahkan cek koneksi kamu.',
                            timer: 3000,
                        });
                    } else if (res.code == 200) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success...',
                            html: `Proses Delete Rekening Berhasil.`,
                        }).then(function(result) {
                            window.location.reload();
                        });
                    }
                });
            }
        });
    }
</script>