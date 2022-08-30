<script>
    let form_withdraw = $('#form_withdraw'),
        withdraw_rp = $('#withdraw_rp'),
        upValue = $('#upValue'),
        downValue = $('#downValue'),
        id_jenis = $('#id_jenis'),
        form_bank = $('#form_bank'),
        id_rekening = $('#id_rekening'),
        hi = $('#hi'),
        max_withdraw = parseFloat(<?= $balance_saldo; ?>),
        trigger_ask = '<?= $trigger_ask; ?>',
        form_invest = $('#form_invest');

    $('document').ready(function() {
        $('.datatables').DataTable({
            responsive: true
        });

        withdraw_rp.on('change', function() {
            getTotalTransfer();
        });

        if (trigger_ask == "ya") {
            Swal.fire({
                icon: 'info',
                title: 'Information',
                text: 'Balance Saldo kamu mencukupi untuk menambahkan Hak Investment baru',
                timer: 5000,
            });
        }

        form_withdraw.on('submit', function(e) {
            e.preventDefault();

            var vText = ``;
            var datanya = {
                id_jenis: id_jenis.val(),
                id_rekening: id_rekening.val(),
                withdraw_rp: withdraw_rp.val(),
                hi: null,
            }

            var vTextSuccess = `Proses Withdraw Poincoin Trade Berhasil.<br>Silahkan tunggu Admin melakukan process transfer.`;

            if (id_jenis.val() == "bank") {
                vText = `Kamu akan melakukan penarikan sebesar<br><b>Rp.${numberWithCommas(withdraw_rp.val())}</b><br>Ke No Rekening<br><b>${id_rekening.find(':selected').text()}</b>`;
            } else if (id_jenis.val() == "invest") {
                vText = `Kamu akan melakukan investment sebanyak<br><b><mark>${hi.val()}</mark></b> Lot<br>Dari balance saldo sebesar<br><b><mark>Rp.${numberWithCommas(hi.val() * 750000)}</mark></b> ?`;
                datanya = {
                    id_jenis: id_jenis.val(),
                    id_rekening: null,
                    withdraw_rp: null,
                    hi: hi.val(),
                }
                vTextSuccess = `Proses Withdraw Balance Saldo menjadi Investment Berhasil.`;
            }

            if (id_jenis.val() == "bank" && withdraw_rp.val() < 10000) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Oops...',
                    text: 'Nominal Withdraw kurang dari Rp.10,000, silahkan isi Withdraw Amount (Rp)',
                    timer: 3000,
                });
            } else {

                // swal
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
                                url: '<?= site_url(); ?>trade_withdraw_process',
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
                                        text: 'Proses Withdraw Poincoin Trade Gagal, Tidak terhubung dengan database, silahkan cek koneksi kamu.',
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
                // end swal

            }
        });

    });

    function getTotalTransfer() {

        if (withdraw_rp.val() < 750000 && id_jenis.val() == 'invest') {
            form_invest.hide();
        } else if (withdraw_rp.val() >= 750000 && id_jenis.val() == 'invest') {
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

    function deleteData(id, amount_rp) {
        Swal.fire({
            title: 'Apakah kamu yakin?',
            text: `Batalkan Withdraw sebesar Rp.${numberWithCommas(parseInt(amount_rp))}`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Saya Yakin!',
            cancelButtonText: 'Tidak jadi!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?= site_url(); ?>trade_withdraw_delete',
                    method: 'post',
                    dataType: 'json',
                    data: {
                        id: id,
                        amount_rp: amount_rp
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
                            text: 'Proses Batalkan Withdraw Poincoin Trade Gagal, Tidak terhubung dengan database, silahkan cek koneksi kamu.',
                            timer: 3000,
                        });
                    } else if (res.code == 200) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success...',
                            html: `Proses Batalkan Withdraw Poincoin Trade Berhasil.`,
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
            form_invest.hide();

            id_rekening.attr('required', true);
            withdraw_rp.attr('required', true);
            hi.attr('required', false);
        } else if (id_jenis.val() == 'invest') {
            if (parseInt(max_withdraw) < 750000) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Oops...',
                    text: 'Balance Saldo tidak mencukupi. Minimal Balance Saldo adalah Rp.750,000',
                    timer: 3000,
                });
                form_bank.hide();
                form_invest.hide();
            } else {
                form_bank.hide();
                form_invest.show();
            }

            id_rekening.attr('required', false);
            withdraw_rp.attr('required', false);
            hi.attr('required', true);
        } else {
            form_bank.hide();
            form_invest.hide();
            id_rekening.attr('required', true);
            withdraw_rp.attr('required', true);
            hi.attr('required', true);
        }
    }
</script>