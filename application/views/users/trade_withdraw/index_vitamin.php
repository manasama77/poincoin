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

            if (withdraw_rp.val() < 10000) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Oops...',
                    text: 'Nominal Withdraw kurang dari Rp.10,000, silahkan isi Withdraw (Rp)',
                    timer: 3000,
                });
            } else {

                var vText = ``;
                var datanya = {
                    id_jenis: id_jenis.val(),
                    id_rekening: id_rekening.val(),
                    withdraw_rp: withdraw_rp.val(),
                    hi: null,
                }

                var vTextSuccess = `Proses Withdraw Bioner Trade Berhasil.<br>Silahkan tunggu admin melakukan process transfer.`;

                if (id_jenis.val() == "bank") {
                    vText = `Kamu akan melakukan penarikan sebesar<br><b>Rp.${withdraw_rp.val()}</b><br>Ke No Rekening<br><b>${id_rekening.find(':selected').text()}</b>`;
                } else if (id_jenis.val() == "invest") {
                    vText = `Kamu akan melakukan investment dari balance saldo sebesar Rp.${withdraw_rp.val()} ?`;
                    datanya = {
                        id_jenis: id_jenis.val(),
                        id_rekening: null,
                        withdraw_rp: null,
                        hi: hi.val(),
                    }
                    vTextSuccess = `Proses Withdraw Balance Saldo menjadi Investment Berhasil.`;
                }

                Swal.fire({
                    title: 'Apakah kamu yakin?',
                    html: vText,
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Saya Yakin!',
                    cancelButtonText: 'Tidak jadi!'
                }).then((result) => {
                    if (result.isConfirmed) {
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
                                    text: 'Proses Withdraw Bioner Trade Gagal, Tidak terhubung dengan database, silahkan cek koneksi kamu.',
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
                    }
                });
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

    function deleteData(id, amount_b) {
        Swal.fire({
            title: 'Apakah kamu yakin?',
            text: `Batalkan Withdraw sebesar Rp.${amount_b}`,
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
                            text: 'Proses Batalkan Withdraw Bioner Trade Gagal, Tidak terhubung dengan database, silahkan cek koneksi kamu.',
                            timer: 3000,
                        });
                    } else if (res.code == 200) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success...',
                            html: `Proses Batalkan Withdraw Bioner Trade Berhasil.`,
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
            hi.attr('required', false);
        } else if (id_jenis.val() == 'invest') {
            if (parseInt(withdraw_rp.val()) < 750000) {
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
            hi.attr('required', true);
        } else {
            form_bank.hide();
            form_invest.hide();
            id_rekening.attr('required', true);
            hi.attr('required', true);
        }
    }
</script>