<script>
    let form_withdraw = $('#form_withdraw'),
        withdraw_b = $('#withdraw_b'),
        upValue = $('#upValue'),
        downValue = $('#downValue'),
        withdraw_rp = $('#withdraw_rp'),
        id_rekening = $('#id_rekening'),
        max_withdraw = parseFloat(<?= $bioner_profit; ?>),
        withdraw_b_value = 0,
        withdraw_amount = 0;

    $('document').ready(function() {
        upValue.on('click', function() {
            getTotalTransfer("up");
        });
        downValue.on('click', function() {
            getTotalTransfer("down");
        });

        form_withdraw.on('submit', function(e) {
            e.preventDefault();

            if (withdraw_b.val() == 0) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Oops...',
                    text: 'Nominal Withdraw nol, silahkan isi Withdraw (B)',
                    timer: 3000,
                });
            } else {

                Swal.fire({
                    title: 'Apakah kamu yakin?',
                    html: `Kamu akan melakukan penarikan sebesar<br><b>Rp.${withdraw_rp.val()}</b><br>Ke No Rekening<br><b>${id_rekening.find(':selected').text()}</b>`,
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Saya Yakin!',
                    cancelButtonText: 'Tidak jadi!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '<?= site_url(); ?>stacking_withdraw_process',
                            method: 'post',
                            dataType: 'json',
                            data: {
                                withdraw_b: withdraw_b.val(),
                                withdraw_rp: replaceComma(withdraw_rp.val()),
                                id_rekening: id_rekening.val(),
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
                                    text: 'Proses Withdraw Bioner Stacking Gagal, Tidak terhubung dengan database, silahkan cek koneksi kamu.',
                                    timer: 3000,
                                });
                            } else if (res.code == 200) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success...',
                                    html: `Proses Withdraw Bioner Stacking Berhasil.<br>Silahkan tunggu admin melakukan process transfer.`,
                                }).then(function(result) {
                                    window.location.reload();
                                });
                            }
                        });
                    }
                });
            }
        });

    });

    function getTotalTransfer(tipe) {

        if (tipe == "up") {
            withdraw_b_value = parseFloat(withdraw_b.val());
            withdraw_b_value = withdraw_b_value + 0.5;

            if (withdraw_b_value > max_withdraw) {
                withdraw_b_value = max_withdraw;
            }

            withdraw_amount = parseInt(withdraw_b_value * 10000);

            withdraw_b.val(withdraw_b_value);
            withdraw_rp.val(numberWithCommas(withdraw_amount));

        } else {
            withdraw_b_value = parseFloat(withdraw_b.val());
            withdraw_b_value = withdraw_b_value - 0.5;

            if (withdraw_b_value < 0) {
                withdraw_b_value = 0;
            }

            withdraw_amount = parseInt(withdraw_b_value * 10000);

            withdraw_b.val(withdraw_b_value);
            withdraw_rp.val(numberWithCommas(withdraw_amount));
        }

    }

    function numberWithCommas(x) {
        return x.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",");
    }

    function replaceComma(x) {
        return x.replace(/\,/g, '');
    }

    function deleteData(id, amount_b) {
        Swal.fire({
            title: 'Apakah kamu yakin?',
            text: `Batalkan Withdraw sebesar ${amount_b} Bioner`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Saya Yakin!',
            cancelButtonText: 'Tidak jadi!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?= site_url(); ?>stacking_withdraw_delete',
                    method: 'post',
                    dataType: 'json',
                    data: {
                        id: id,
                        amount_b: amount_b
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
                            text: 'Proses Batalkan Withdraw Bioner Stacking Gagal, Tidak terhubung dengan database, silahkan cek koneksi kamu.',
                            timer: 3000,
                        });
                    } else if (res.code == 200) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success...',
                            html: `Proses Batalkan Withdraw Bioner Stacking Berhasil.`,
                        }).then(function(result) {
                            window.location.reload();
                        });
                    }
                });
            }
        });
    }
</script>