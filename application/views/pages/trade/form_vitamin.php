<script>
    let form_new_trade = $('#form_new_trade'),
        id_user = $('#id_user'),
        total_lot = $('#total_lot'),
        nilai_investment = $('#nilai_investment'),
        biaya_sewa = $('#biaya_sewa'),
        total_transfer = $('#total_transfer'),
        profit_per_day = $('#profit_per_day'),
        upValue = $('#upValue'),
        downValue = $('#downValue'),
        basicRate = 600000,
        basicSewa = 150000,
        basicProfit = 3000,
        valueLot = 0,
        valueNilaiInvestment = 0,
        valueBiayaSewa = 0,
        valueTotalTransfer = 0,
        valueProfitPerDay = 0;

    $(document).ready(function() {

        $("#id_user").on('change', function() {
            if ($('#id_user').val().length == 0) {
                upValue.attr('disabled', true);
                downValue.attr('disabled', true);
            } else {
                upValue.attr('disabled', false);
                downValue.attr('disabled', false);
            }
        });

        upValue.on('click', function() {
            getTotalTransfer("up");
        });
        downValue.on('click', function() {
            getTotalTransfer("down");
        });

        form_new_trade.on('submit', function(e) {
            e.preventDefault();

            if (total_transfer.val() == 0 || total_transfer.val() < 0) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Oops...',
                    text: 'Nominal Transfer nol, silahkan isi nominal transfer',
                    timer: 3000,
                });
            } else {
                textnya = `Kamu akan melakukan investment sebanyak ${numberWithCommas(valueLot)} Lot, dengan Nilai Investment sebesar Rp.${numberWithCommas(valueNilaiInvestment)} & biaya sewa sebesar Rp.${numberWithCommas(valueBiayaSewa)} ?`

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
                            url: '<?= site_url(); ?>admin/bioner_trade/store',
                            method: 'post',
                            dataType: 'json',
                            data: {
                                id_user: id_user.find(':selected').val(),
                                total_lot: valueLot,
                                total_transfer: valueTotalTransfer
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
                                    text: 'Proses Add New Hak Investment Gagal, Tidak terhubung dengan database, silahkan cek koneksi kamu.',
                                    timer: 3000,
                                });
                            } else if (res.code == 200) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success...',
                                    html: `Proses Add New Hak Investment Berhasil.<br>Silahkan lakukan transfer sejumlah <b>Rp.${numberWithCommas(valueTotalTransfer)}</b> ke no rekening dinomor <br> <b><?= NO_REKENING_ADMIN; ?><br>a/n <?= ATAS_NAMA_NO_REKENING_ADMIN; ?><br>Bank <?= NAMA_BANK_ADMIN; ?><b>`,
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
            valueLot = valueLot + 1; // 1
            valueNilaiInvestment = valueNilaiInvestment + basicRate;
            valueBiayaSewa = valueBiayaSewa + basicSewa;
            valueTotalTransfer = valueTotalTransfer + (basicRate + basicSewa);
            valueProfitPerDay = basicProfit * valueLot;
        } else {
            valueLot = valueLot - 1;
            valueNilaiInvestment = valueNilaiInvestment - basicRate;
            valueBiayaSewa = valueBiayaSewa - basicSewa;
            valueTotalTransfer = valueTotalTransfer - (basicRate + basicSewa);
            valueProfitPerDay = valueProfitPerDay - basicProfit;
        }

        if (valueLot <= 0) {
            valueLot = 0;
            valueNilaiInvestment = 0;
            valueBiayaSewa = 0;
            valueTotalTransfer = 0;
            valueProfitPerDay = 0;
        }

        total_lot.val(numberWithCommas(valueLot));
        nilai_investment.val(numberWithCommas(valueNilaiInvestment));
        biaya_sewa.val(numberWithCommas(valueBiayaSewa));
        total_transfer.val(numberWithCommas(valueTotalTransfer));
        profit_per_day.val(numberWithCommas(valueProfitPerDay));
    }

    function numberWithCommas(x) {
        return x.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",");
    }

    function replaceComma(x) {
        return x.replace(/\,/g, '');
    }
</script>