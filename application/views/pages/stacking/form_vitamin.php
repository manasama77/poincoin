<script>
    let form_new_stack = $('#form_new_stack'),
        total_investment = $('#total_investment'),
        total_transfer = $('#total_transfer'),
        profit_per_day = $('#profit_per_day'),
        upValue = $('#upValue'),
        downValue = $('#downValue'),
        form_bukti_transfer = $('#form_bukti_transfer'),
        modal_bukti_transfer = $('#modal_bukti_transfer'),
        id_bioner_stacking = $('#id_bioner_stacking'),
        total_transfer_in_rp = $('#total_transfer_in_rp'),
        bukti_transfer = $('#bukti_transfer'),
        btn_upload_bukti_transfer = $('#btn_upload_bukti_transfer'),
        totalInvestment = 0,
        totalTransfer = 0,
        totalTransferAlt = 0,
        totalTransferAltRp = 0,
        profitPerDay = 0,
        textnya = 0,
        count_arr_stacking = 0;
    $(document).ready(function() {

        $("#id_user").on('change', function() {
            let id_user = $(this).find(':selected').val();

            $.ajax({
                url: '<?= site_url(); ?>admin/bioner_stacking/count',
                method: 'get',
                dataType: 'json',
                data: {
                    id_user: id_user
                },
                beforeSend: function(e) {
                    $.blockUI();
                    upValue.attr('disabled', true);
                    downValue.attr('disabled', true);
                    total_investment.val('');
                    total_transfer.val('');
                    profit_per_day.val('');
                    totalInvestment = 0;
                    totalTransfer = 0;
                }
            }).always(function(e) {
                $.unblockUI();
            }).fail(function(e) {
                console.log(e.responseText);
            }).done(function(e) {
                console.log(e);
                count_arr_stacking = e.count;
                upValue.attr('disabled', false);
                downValue.attr('disabled', false);
            });
        });

        upValue.on('click', function() {
            getTotalTransfer("up");
        });
        downValue.on('click', function() {
            getTotalTransfer("down");
        });

        form_new_stack.on('submit', function(e) {
            e.preventDefault();

            if ($('#id_user').find(':selected').val().length == 0) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Oops...',
                    text: 'Silahkan pilih user telebih dahulu',
                    timer: 3000,
                });
            } else if (total_transfer.val() == 0 || total_transfer.val() < 0) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Oops...',
                    text: 'Nominal Transfer nol, silahkan isi nominal transfer',
                    timer: 3000,
                });
            } else {
                if (count_arr_stacking == 0) {
                    xtransfer = parseInt(replaceComma(total_transfer.val())) - 100000;
                    textnya = `Kamu akan melakukan investment sebesar Rp.${numberWithCommas(xtransfer)} & Biaya pembukaan awal sebesar Rp.100,000 ?`
                } else {
                    textnya = `Kamu akan melakukan investment sebesar Rp.${total_transfer.val()} ?`
                }

                Swal.fire({
                    title: 'Apakah kamu yakin?',
                    text: textnya,
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Saya Yakin!',
                    cancelButtonText: 'Tidak jadi!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '<?= site_url(); ?>admin/bioner_stacking/store',
                            method: 'post',
                            dataType: 'json',
                            data: {
                                id_user: $('#id_user').find(':selected').val(),
                                total_investment: total_investment.val(),
                                total_transfer: total_transfer.val()
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
                                    text: 'Proses Add New Bioner Stacking Gagal, Tidak terhubung dengan database, silahkan cek koneksi kamu.',
                                    timer: 3000,
                                });
                            } else if (res.code == 200) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success...',
                                    html: `Proses Add New Bioner Stacking Berhasil.<br>Silahkan lakukan transfer sejumlah <b>${total_transfer.val()}</b> ke no rekening dinomor <br> <b><?= NO_REKENING_ADMIN; ?></b><br><b>a/n <?= ATAS_NAMA_NO_REKENING_ADMIN; ?></b><br><b>Bank <?= NAMA_BANK_ADMIN; ?></b><br>Atau Transfer menggunakan Doge Coin ke Nomor Wallet <b><?= NO_WALLET_ADMIN; ?></b>`,
                                }).then(function(result) {
                                    window.location.reload();
                                });
                            }
                        });
                    }
                })
            }
        });

    });

    function getTotalTransfer(tipe) {

        if (tipe == "up") {
            totalInvestment = parseInt(totalInvestment) + 100;
            totalTransfer = parseInt(totalTransfer) + 1500000;

            if (totalInvestment == 100 && count_arr_stacking == 0) {
                totalTransferAlt = parseInt(1500000);
                totalTransferAltRp = numberWithCommas(totalTransferAlt);
                totalTransfer = parseInt(1500000) + 100000;
            } else if (totalInvestment == 0) {
                totalTransferAlt = 0;
                totalTransferRp = 0;
                totalTransfer = 0;
            } else {
                totalTransferAlt = parseInt(totalTransfer);
                totalTransferRp = numberWithCommas(totalTransferAlt);
            }

        } else {
            totalInvestment = parseInt(totalInvestment) - 100;
            totalTransfer = parseInt(totalTransfer) - 1500000;

            if (totalInvestment == 100 && count_arr_stacking == 0) {
                totalTransferAlt = parseInt(1500000);
                totalTransferAltRp = numberWithCommas(totalTransferAlt);
                totalTransfer = parseInt(1500000) + 100000;
            } else if (totalInvestment == 0) {
                totalTransferAlt = 0;
                totalTransferRp = 0;
                totalTransfer = 0;
            }
        }

        profitPerDay = parseFloat(totalInvestment * 0.5 / 100);

        if (totalInvestment < 0) {
            totalInvestment = 0;
        }

        if (totalTransfer < 0) {
            totalTransfer = 0;
        }

        if (totalTransferAlt < 0) {
            totalTransfer = 0;
        }

        if (profitPerDay < 0) {
            profitPerDay = 0;
        }

        total_investment.val(numberWithCommas(totalInvestment));
        total_transfer.val(numberWithCommas(totalTransfer));
        profit_per_day.val(numberWithCommas(profitPerDay));
    }

    function numberWithCommas(x) {
        return x.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",");
    }

    function replaceComma(x) {
        return x.replace(/\,/g, '');
    }
</script>