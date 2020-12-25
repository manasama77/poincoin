<script>
    let form_new_stack = $('#form_new_stack'),
        total_investment = $('#total_investment'),
        total_transfer = $('#total_transfer'),
        upValue = $('#upValue'),
        downValue = $('#downValue'),
        totalInvestment = 0,
        totalTransfer = 0;

    $('document').ready(function() {
        upValue.on('click', function() {
            getTotalTransfer("up");
        });
        downValue.on('click', function() {
            getTotalTransfer("down");
        });

        form_new_stack.on('submit', function(e) {
            e.preventDefault();

            if (total_transfer.val() == 0 || total_transfer.val() < 0) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Oops...',
                    text: 'Nominal Transfer nol, silahkan isi nominal transfer',
                    timer: 3000,
                });
            } else {
                Swal.fire({
                    title: 'Apakah kamu yakin?',
                    text: `Kamu akan melakukan investment sebesar Rp.${total_transfer.val()} ?`,
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
                                    text: 'Proses Add New Bioner Stacking Gagal, Tidak terhubung dengan database, silahkan cek koneksi kamu.',
                                    timer: 3000,
                                });
                            } else if (res.code == 200) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success...',
                                    html: `Proses Add New Bioner Stacking Berhasil.<br>Silahkan lakukan transfer sejumlah <b>${total_transfer.val()}</b> ke no rekening admin dinomor <br> <b>012345678<br>a/n Nama Pemilik Rekening<b>`,
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
        console.log(tipe);


        if (tipe == "up") {
            totalInvestment = parseInt(totalInvestment) + 100;
            totalTransfer = parseInt(totalTransfer) + 1500000;
        } else {
            totalInvestment = parseInt(totalInvestment) - 100;
            totalTransfer = parseInt(totalTransfer) - 1500000;
        }

        if (totalInvestment < 0) {
            totalInvestment = 0;
        }

        if (totalTransfer < 0) {
            totalTransfer = 0;
        }

        total_investment.val(numberWithCommas(totalInvestment));
        total_transfer.val(numberWithCommas(totalTransfer));
    }

    function numberWithCommas(x) {
        return x.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",");
    }

    function replaceComma(x) {
        return x.replace(/\,/g, '');
    }
</script>