<h1 class="text-dark text-center pt-3 pb-2"><?= $title; ?></h1>

<div class="row justify-content-center">

    <div class="col-sm-12 col-md-4 col-lg-4 mt-1 mb-1 text-center">
        <div class="card card-gradient mt-2 mb-2">
            <div class="card-body p-2 text-center">
                <div class="d-flex justify-content-between">
                    <div class="p-1">
                        <i class="fas fa-hand-holding-usd fa-gradient fa-2x"></i><br />
                        <b class="title-special-card">Total Hak Investment</b>
                    </div>
                    <div class="p-1" style="margin-top: 10px;">
                        <p class="font-weight-bold value-special-card"><?= number_format($total_investment, 0); ?> <small>Lot</small></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-12 col-md-4 col-lg-4 mt-1 mb-1 text-center">
        <div class="card card-gradient mt-2 mb-2">
            <div class="card-body p-2 text-center">
                <div class="d-flex justify-content-between">
                    <div class="p-1">
                        <i class="fas fa-coins fa-gradient fa-2x"></i><br />
                        <b class="title-special-card">Balance Saldo</b>
                    </div>
                    <div class="p-1" style="margin-top: 10px;">
                        <p class="font-weight-bold value-special-card"><small>Rp.</small><?= number_format($balance_saldo, 0); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="col-sm-12 col-md-4 col-lg-4 mt-1 mb-1 text-center">
        <div class="card card-gradient mt-2 mb-2 pointer" onclick="window.open('<?= site_url(); ?>trade_withdraw', '_self')">
            <div class="card-body p-2 text-center">
                <div class="d-flex justify-content-center">
                    <div class="p-1">
                        <i class="fas fa-money-bill-wave-alt fa-gradient fa-2x"></i><br />
                        <b class="title-special-card">Withdraw</b>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="row">
    <div class="col-sm-12 col-md-8 offset-md-2 mt-2">
        <div class="card text-white">
            <div class="card-header bg-dark font-weight-bold f-news text-center p-0" style="padding-top: 4px !important;">
                <span style="font-size: 25px;"><i class="fas fa-table"></i> List <?= $title; ?></span>
            </div>
            <div class="card-body bg-grey-1 text-dark p-2 w-100">
                <div class="table-responsive">
                    <table class="table table-bordered w-100">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Status</th>
                                <th class="text-center" style="min-width: 120px;">Created</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($arr_bioner_trade->num_rows() > 0) {
                            ?>
                                <?php
                                foreach ($arr_bioner_trade->result() as $key) {
                                ?>
                                    <tr>
                                        <td class="text-center"><?= $key->kode; ?></td>
                                        <td class="text-center">
                                            <?php
                                            if ($key->status == "aktif") {
                                                echo '<span class="badge badge-success flataja">Aktif</span>';
                                            } elseif ($key->status == "pending") {
                                                echo '<span class="badge badge-warning flataja">Pending</span><br><button type="button" class="btn btn-info btn-sm flataja" onclick="konfirmasiTransfer(\'' . $key->kode . '\', \'750000\')">Konfirmasi Transfer</button>';
                                            } elseif ($key->status == "menunggu verifikasi") {
                                                echo '<span class="badge badge-info flataja">Menunggu Verifikasi</span>';
                                            } elseif ($key->status == "tidak_aktif") {
                                                echo '<span class="badge badge-danger flataja">Tidak Aktif</span>';
                                            }
                                            ?>
                                        </td>
                                        <td class="text-center">
                                            <?php
                                            $created_obj = new DateTime($key->created_at);
                                            $created_obj->createFromFormat('Y-m-d H:i:s', $key->created_at);
                                            echo $created_obj->format('d-M-Y');
                                            ?>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
                            <?php
                            } else {
                                echo '<tr><td colspan="3" class="text-center">Kamu tidak memiliki data investment Bioner Trade</td></tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12 col-md-8 offset-md-2 mt-3">
        <div class="card text-white">
            <div class="card-header bg-dark font-weight-bold f-news text-center p-0" style="padding-top: 4px !important;">
                <span style="font-size: 25px;"><i class="fas fa-plus"></i> Add New Hak Investment</span>
            </div>
            <div class="card-body bg-grey-1 text-dark p-2 w-100">
                <form id="form_new_stack">

                    <div class="form-group row justify-content-center">
                        <label for="total_lot" class="col-sm-12 col-md-12 col-lg-3 col-form-label font-weight-bold text-center">Total Hak Investment</label>
                        <div class="col-sm-12 col-md-12 col-lg-6 input-group">
                            <input type="text" class="form-control text-right" id="total_lot" name="total_lot" placeholder="Total Hak Investment" value="0" readonly required />
                            <div class="input-group-append">
                                <span class="input-group-text">Lot</span>
                            </div>
                            <div class="input-group-append">
                                <button type="button" class="btn btn-info" id="up_value">
                                    <i class="fas fa-arrow-up"></i>
                                </button>
                                <button type="button" class="btn btn-info" id="down_value">
                                    <i class="fas fa-arrow-down"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row justify-content-center">
                        <label for="nilai_investment" class="col-sm-12 col-md-12 col-lg-3 col-form-label font-weight-bold text-center">Nilai Investment</label>
                        <div class="col-sm-12 col-md-12 col-lg-6 input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Rp.</span>
                            </div>
                            <input type="text" class="form-control" id="nilai_investment" name="nilai_investment" placeholder="Nilai Investment" value="0" readonly required />
                        </div>
                    </div>

                    <div class="form-group row justify-content-center">
                        <label for="biaya_sewa" class="col-sm-12 col-md-12 col-lg-3 col-form-label font-weight-bold text-center">Biaya Sewa</label>
                        <div class="col-sm-12 col-md-12 col-lg-6 input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Rp.</span>
                            </div>
                            <input type="text" class="form-control" id="biaya_sewa" name="biaya_sewa" placeholder="Biaya Sewa" value="0" readonly required />
                        </div>
                    </div>

                    <div class="form-group row justify-content-center">
                        <label for="total_transfer" class="col-sm-12 col-md-12 col-lg-3 col-form-label font-weight-bold text-center">Total Transfer</label>
                        <div class="col-sm-12 col-md-12 col-lg-6 input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Rp.</span>
                            </div>
                            <input type="text" class="form-control" id="total_transfer" name="total_transfer" placeholder="Total Transfer" value="0" readonly required />
                        </div>
                    </div>

                    <hr>

                    <div class="form-group row justify-content-center">
                        <label for="profit_per_day" class="col-sm-12 col-md-12 col-lg-3 col-form-label font-weight-bold text-center">Profit Per Day</label>
                        <div class="col-sm-12 col-md-12 col-lg-6 input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon2">Rp.</span>
                            </div>
                            <input type="text" class="form-control text-right" id="profit_per_day" name="profit_per_day" placeholder="Profit Per Day" value="0" readonly required />
                        </div>
                    </div>


                    <div class="alert alert-info" role="alert">
                        <ul>
                            <li>Nilai Pembukaan Hak Investment adalah sebesar <kbd>Rp.600,000</kbd></li>
                            <li>Biaya Sewa Per Satu Hak Investment adalah Sebesar <kbd>Rp.150,000</kbd></li>
                            <li>Profit Per Hari yang akan diberikan per 1 Lot / Hak Investment Sebesar <kbd>Rp.3,000</kbd></li>
                            <li>Jadwal pembagian profit akan dilakukan oleh server setiap hari pada pukul <kbd>00:00</kbd></li>
                            <li>Untuk melakukan transfer bisa di nomor rekening Bank <kbd><?= NAMA_BANK_ADMIN; ?> <?= NO_REKENING_ADMIN; ?> <?= ATAS_NAMA_NO_REKENING_ADMIN; ?></kbd></li>
                        </ul>
                    </div>


                    <div class="form-group row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block font-weight-bold">Add New Hak Investment</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<form id="form_bukti_transfer" enctype="multipart/form-data">
    <div class="modal fade" id="modal_bukti_transfer" tabindex="-1" role="dialog" aria-labelledby="modal_bukti_transfer_label" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Upload Bukti Transfer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="id_bioner_trade">Kode Bioner Trade</label>
                        <input type="text" class="form-control" id="id_bioner_trade" name="id_bioner_trade" readonly required>
                    </div>
                    <div class="form-group">
                        <label for="total_transfer_in_rp">Total Transfer</label>
                        <div class="input-group">
                            <div class="form-group-prepend">
                                <div class="input-group-text">Rp.</div>
                            </div>
                            <input type="text" class="form-control" id="total_transfer_in_rp" name="total_transfer_in_rp" readonly required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="bukti_transfer">Bukti Transfer</label>
                        <input type="file" class="form-control" id="bukti_transfer" name="bukti_transfer" accept="image/*" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" id="btn_upload_bukti_transfer" class="btn btn-primary">Upload</button>
                </div>
            </div>
        </div>
    </div>
</form>