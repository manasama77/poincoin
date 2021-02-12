<script>
    $('document').ready(function() {

        $('#form_input').on('submit', function(e) {
            e.preventDefault();

            Swal.fire({
                title: 'Apakah kamu yakin?',
                text: `Update API Key & Secret Key`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Saya Yakin!',
                cancelButtonText: 'Tidak jadi!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '<?= site_url(); ?>store_api_setup',
                        method: 'post',
                        dataType: 'json',
                        data: $('#form_input').serialize(),
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
                                text: 'Proses Update API & Secret Key Gagal, Tidak terhubung dengan database, silahkan cek koneksi kamu.',
                                timer: 3000,
                            });
                        } else if (res.code == 200) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success...',
                                html: `Proses Update API & Secret Key Berhasil.`,
                            }).then(function(result) {
                                window.location.reload();
                            });
                        }
                    });
                }
            });
        });

    });
</script>