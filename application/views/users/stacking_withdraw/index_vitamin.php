<script>
    let form_withdraw = $('#form_withdraw'),
        withdraw_b = $('#withdraw_b'),
        upValue = $('#upValue'),
        downValue = $('#downValue'),
        withdraw_rp = $('#withdraw_rp'),
        id_jenis = $('#id_jenis'),
        form_bank = $('#form_bank'),
        id_rekening = $('#id_rekening'),
        form_doge = $('#form_doge'),
        id_wallet = $('#id_wallet'),
        max_withdraw = parseFloat(<?= $bioner_profit; ?>),
        withdraw_b_value = 0,
        withdraw_amount = 0,
        form_invest = $('#form_invest');

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

                var vText = ``;
                var datanya = {
                    withdraw_b: withdraw_b.val(),
                    withdraw_rp: replaceComma(withdraw_rp.val()),
                    id_jenis: id_jenis.val(),
                    id_rekening: id_rekening.val(),
                    id_wallet: id_wallet.val(),
                }

                var vTextSuccess = `Proses Withdraw Bioner Stacking Berhasil.<br>Silahkan tunggu admin melakukan process transfer.`;

                if (id_jenis.val() == "bank") {
                    vText = `Kamu akan melakukan penarikan sebesar<br><b>Rp.${withdraw_rp.val()}</b><br>Ke No Rekening<br><b>${id_rekening.find(':selected').text()}</b>`;
                } else if (id_jenis.val() == "doge") {
                    vText = `Kamu akan melakukan penarikan sebesar<br><b>Rp.${withdraw_rp.val()}</b><br>Ke No Doge Wallet<br><b>${id_wallet.find(':selected').text()}</b>`;
                } else if (id_jenis.val() == "invest") {
                    vText = `Kamu akan melakukan investment stacking dari profit sebesar ${withdraw_b.val()} B ?`;
                    datanya = {
                        id_jenis: id_jenis.val(),
                        withdraw_b: withdraw_b.val(),
                        withdraw_rp: 0,
                    }
                    vTextSuccess = `Proses Withdraw Bioner Stacking menjadi Investment Berhasil.`;
                }

                Swal.mixin({
                    confirmButtonText: 'Next &rarr;',
                    showCancelButton: true,
                    progressSteps: ['1', '2'],
                    icon: 'question',
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    cancelButtonText: 'Tidak jadi !'
                }).queue([{
                        title: 'Apakah kamu yakin ?',
                        html: vText,
                        input: false
                    },
                    {
                        title: 'Masukan Kode PIN Transaksi',
                        html: `<input type="password" class="swal2-input" id="pin_input" name="pin_input" placeholder="PIN Transaksi" pattern="[0-9]*" inputmode="numeric" minlength="6" maxlength="6" autofill="new-password">`,
                        preConfirm: () => {
                            const pin_input = Swal.getPopup().querySelector('#pin_input').value;
                            if (!pin_input) {
                                Swal.showValidationMessage(`Silahkan masukan PIN Transaksi`)
                            } else if (pin_input != <?= $this->session->userdata(SESS . 'pin'); ?>) {
                                Swal.showValidationMessage(`PIN Transaksi Salah`)
                            }
                            return {
                                pin_input: pin_input
                            }
                        }
                    },
                ]).then((result) => {
                    if (result.value) {
                        pin_input = result.value[1].pin_input;

                        if (pin_input == <?= $this->session->userdata(SESS . 'pin'); ?>) {
                            $.ajax({
                                url: '<?= site_url(); ?>stacking_withdraw_process',
                                method: 'post',
                                dataType: 'json',
                                data: datanya,
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
                                        html: vTextSuccess,
                                    }).then(function(result) {
                                        window.location.reload();
                                    });
                                }
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'PIN Transaksi Salah',
                                timer: 3000,
                            });
                        }
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

        if (withdraw_b_value < 10 && id_jenis.val() == 'invest') {
            form_invest.hide();
        } else if (withdraw_b_value >= 10 && id_jenis.val() == 'invest') {
            form_invest.show();
        } else {
            form_invest.hide();
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

    function cekJenis() {
        if (id_jenis.val() == 'bank') {
            form_bank.show();
            form_doge.hide();
            form_invest.hide();

            id_rekening.attr('required', true);
            id_wallet.attr('required', false);
        } else if (id_jenis.val() == 'doge') {
            form_bank.hide();
            form_doge.show();
            form_invest.hide();

            id_rekening.attr('required', false);
            id_wallet.attr('required', true);
        } else if (id_jenis.val() == 'invest') {
            if (parseInt(withdraw_b.val()) < 10) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Oops...',
                    text: 'Profit tidak mencukupi. Minimal Bioner Profit adalah 10 B',
                    timer: 3000,
                });
                form_bank.hide();
                form_doge.hide();
                form_invest.hide();
            } else {
                form_bank.hide();
                form_doge.hide();
                form_invest.show();
            }

            id_rekening.attr('required', false);
            id_wallet.attr('required', false);
        } else {
            form_bank.hide();
            form_doge.hide();
            form_invest.hide();
        }
    }
</script>