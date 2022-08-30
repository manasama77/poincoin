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
        textnya = 0;

    $('document').ready(function() {

        $('.datatables').DataTable({
            responsive: true
        });

        upValue.on('click', function() {
            getTotalTransfer("up");
        });
        downValue.on('click', function() {
            getTotalTransfer("down");
        });

        total_investment.on('change', function() {
            updateTotalTransfer(total_investment.val());
        });


        form_new_stack.on('submit', function(e) {
            e.preventDefault();

            if (total_transfer.val() == 0 || total_transfer.val() < 0) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Oops...',
                    text: 'Total Investment belum terisi, silahkan isi nominal Total Investment',
                    timer: 3000,
                });
            } else {
                if (<?= $count_arr_stacking; ?> == 0) {
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
                            url: '<?= site_url(); ?>stacking_add',
                            method: 'post',
                            dataType: 'json',
                            data: {
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
                                    text: 'Proses Add New Poincoin Stacking Gagal, Tidak terhubung dengan database, silahkan cek koneksi kamu.',
                                    timer: 3000,
                                });
                            } else if (res.code == 200) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success...',
                                    html: `Proses Add New Poincoin Stacking Berhasil.<br>Silahkan lakukan transfer sejumlah <b>${total_transfer.val()}</b> ke no rekening dinomor <br> <b><?= NO_REKENING_ADMIN; ?></b><br><b>a/n <?= ATAS_NAMA_NO_REKENING_ADMIN; ?></b><br><b>Bank <?= NAMA_BANK_ADMIN; ?></b><br>Atau Transfer menggunakan Doge Coin ke Nomor Wallet <b><?= NO_WALLET_ADMIN; ?></b>`,
                                }).then(function(result) {
                                    window.location.reload();
                                });
                            }
                        });
                    }
                })
            }
        });

        form_bukti_transfer.on('submit', function(e) {
            e.preventDefault();

            let isiData = $(this)[0];
            let formData = new FormData(isiData);

            $.ajax({
                url: '<?= site_url(); ?>stacking_upload_bukti_transfer',
                method: 'post',
                contentType: false,
                processData: false,
                dataType: 'json',
                data: formData,
                beforeSend: function() {
                    btn_upload_bukti_transfer.attr('disabled', true);
                    $.blockUI();
                }
            }).always(function(res) {
                $.unblockUI();
                btn_upload_bukti_transfer.attr('disabled', false);
            }).fail(function(res) {
                console.log(res);
            }).done(function(res) {
                if (res.code == 500) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Proses upload bukti transfer gagal, Tidak terhubung dengan database, silahkan cek koneksi kamu.',
                        timer: 3000,
                    });
                } else {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success...',
                        html: `Proses upload bukti transfer Berhasil.`,
                    }).then(function(result) {
                        window.location.reload();
                    });
                }
            });
        });


    });

    function updateTotalTransfer(param_total_transfer) {
        total_transfer_value = param_total_transfer * 10;
        profit_value = param_total_transfer * 0.5 / 100;
        total_transfer.val(total_transfer_value);
        profit_per_day.val(profit_value);
    }

    function copyClipboard() {
        /* Get the text field */
        let copyText = document.getElementById("wallet_admin");

        /* Select the text field */
        copyText.select();
        copyText.setSelectionRange(0, 99999); /* For mobile devices */

        /* Copy the text inside the text field */
        document.execCommand("copy");

        Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'Wallet Admin Berhasil Dicopy',
            showConfirmButton: false,
            timer: 3000,
        });
    }

    function getTotalTransfer(tipe) {

        if (tipe == "up") {
            totalInvestment = parseInt(totalInvestment) + 100;
            totalTransfer = parseInt(totalTransfer) + 1500000;

            if (totalInvestment == 100 && <?= $count_arr_stacking; ?> == 0) {
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

            if (totalInvestment == 100 && <?= $count_arr_stacking; ?> == 0) {
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

    function konfirmasiTransfer(kode, total_transfer_x) {
        id_bioner_stacking.val('').val(kode);
        total_transfer_in_rp.val('').val(numberWithCommas(total_transfer_x));
        modal_bukti_transfer.modal('show');

    }
</script>