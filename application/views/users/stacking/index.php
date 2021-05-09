<h1 class="text-dark text-center pt-3 pb-2">Bioner Stacking</h1>

<div class="row justify-content-center">

    <div class="col-sm-12 col-md-4 col-lg-4 mt-1 mb-1 text-center">
        <div class="card card-gradient mt-2 mb-2">
            <div class="card-body p-2 text-center">
                <div class="d-flex justify-content-between">
                    <div class="p-1">
                        <i class="fas fa-hand-holding-usd fa-gradient fa-2x"></i><br />
                        <b class="title-special-card">Bioner Profit</b>
                    </div>
                    <div class="p-1" style="margin-top: 10px;">
                        <p class="font-weight-bold value-special-card"><?= number_format($bioner_profit, 4); ?> <small>BNR</small></p>
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
                        <b class="title-special-card">Total Investment</b>
                    </div>
                    <div class="p-1" style="margin-top: 10px;">
                        <p class="font-weight-bold value-special-card"><?= number_format($total_investment, 0); ?> <small>BNR</small></p>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="col-sm-12 col-md-4 col-lg-4 mt-1 mb-1 text-center">
        <div class="card card-gradient mt-2 mb-2 pointer" onclick="window.open('<?= site_url(); ?>stacking_withdraw', '_self')">
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
                <span style="font-size: 25px;"><i class="fas fa-table"></i> List Bioner Stacking</span>
            </div>
            <div class="card-body bg-grey-1 text-dark p-2 w-100">
                <div class="table-responsive">
                    <table class="table table-bordered w-100 datatables">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Code</th>
                                <th class="text-right">Investment</th>
                                <th class="text-right" style="min-width: 100px;">Profit Per Day</th>
                                <th class="text-center">Status</th>
                                <th class="text-center" style="min-width: 120px;">Created</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($arr_stacking->num_rows() > 0) {
                            ?>
                                <?php
                                $no = 1;
                                foreach ($arr_stacking->result() as $key) {
                                ?>
                                    <tr>
                                        <td class="text-center"><?= $no; ?></td>
                                        <td class="text-center"><?= $key->kode; ?></td>
                                        <td class="text-right"><?= number_format($key->total_investment, 0); ?> BNR</td>
                                        <td class="text-right"><?= number_format($key->profit_perhari_b, 4); ?> BNR</td>
                                        <td class="text-center">
                                            <?php
                                            if ($key->status == "aktif") {
                                                echo '<span class="badge badge-success flataja">Aktif</span>';
                                            } elseif ($key->status == "menunggu_transfer") {
                                                echo '<span class="badge badge-warning flataja">Menunggu Transfer</span><br><button type="button" class="btn btn-info btn-sm flataja" onclick="konfirmasiTransfer(\'' . $key->kode . '\', \'' . number_format($key->total_transfer, 0) . '\')">Konfirmasi Transfer</button>';
                                            } elseif ($key->status == "menunggu_verifikasi") {
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
                                            echo $created_obj->format('d-M-Y H:i');
                                            ?>
                                        </td>
                                    </tr>
                                <?php
                                    $no++;
                                }
                                ?>
                            <?php
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
    <div class="col-sm-12 col-md-8 offset-md-2 mt-2">
        <div class="card text-white">
            <div class="card-header bg-dark font-weight-bold f-news text-center p-0" style="padding-top: 4px !important;">
                <span style="font-size: 25px;"><i class="fas fa-table"></i> Logs Bioner Stacking</span>
            </div>
            <div class="card-body bg-grey-1 text-dark p-2 w-100">
                <div class="table-responsive">
                    <table class="table table-bordered datatables w-100">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Kode</th>
                                <th class="text-left">Tipe</th>
                                <th class="text-left" style="min-width: 100px;">Keterangan</th>
                                <th class="text-center" style="min-width: 120px;">Created</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($arr_logs->num_rows() > 0) {
                            ?>
                                <?php
                                $no = 1;
                                foreach ($arr_logs->result() as $key) {
                                ?>
                                    <tr>
                                        <td class="text-center"><?= $no; ?></td>
                                        <td class="text-center"><?= $key->kode; ?></td>
                                        <td class="text-left"><?= strtoupper($key->type) ?></td>
                                        <td class="text-left"><?= $key->keterangan; ?></td>
                                        <td class="text-center">
                                            <?php
                                            $created_obj = new DateTime($key->created_at);
                                            $created_obj->createFromFormat('Y-m-d H:i:s', $key->created_at);
                                            echo $created_obj->format('d-M-Y H:i');
                                            ?>
                                        </td>
                                    </tr>
                                <?php
                                    $no++;
                                }
                                ?>
                            <?php
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
    <div class="col-sm-12 col-md-8 offset-md-2 mt-2">
        <div class="card text-white">
            <div class="card-header bg-dark font-weight-bold f-news text-center p-0" style="padding-top: 4px !important;">
                <span style="font-size: 25px;"><i class="fas fa-plus"></i> Add New Stack</span>
            </div>
            <div class="card-body bg-grey-1 text-dark p-2 w-100">
                <form id="form_new_stack">

                    <div class="form-group row justify-content-center">
                        <label for="total_investment" class="col-sm-12 col-md-12 col-lg-3 col-form-label font-weight-bold text-center">Total Investment</label>
                        <div class="col-sm-12 col-md-12 col-lg-6 input-group">
                            <input type="number" class="form-control" id="total_investment" name="total_investment" placeholder="Total Investment" value="0" min="100" max="100000" step="100" required />
                            <div class="input-group-append">
                                <span class="input-group-text bg-primary text-white">BNR</span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row justify-content-center">
                        <label for="total_transfer" class="col-sm-12 col-md-12 col-lg-3 col-form-label font-weight-bold text-center">Total TRX Transfer</label>
                        <div class="col-sm-12 col-md-12 col-lg-6 input-group">
                            <input type="text" class="form-control" id="total_transfer" name="total_transfer" placeholder="Total Transfer" value="0" readonly required />
                            <div class="input-group-append">
                                <span class="input-group-text bg-danger text-white" id="basic-addon2">TRX</span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row justify-content-center">
                        <label for="profit_per_day" class="col-sm-12 col-md-12 col-lg-3 col-form-label font-weight-bold text-center">Profit Per Day</label>
                        <div class="col-sm-12 col-md-12 col-lg-6 input-group">
                            <input type="text" class="form-control" id="profit_per_day" name="profit_per_day" placeholder="Profit Per Day" value="0" readonly required />
                            <div class="input-group-append">
                                <span class="input-group-text bg-primary text-white" id="basic-addon2">BNR</span>
                            </div>
                        </div>
                    </div>


                    <div class="alert alert-info" role="alert">
                        <ul>
                            <li>Minimal Investment adalah <kbd>100 Bioner</kbd> beserta kelipatannya</li>
                            <li>Nilai Awal Investment <kbd>1 Bioner (BNR) setara 10 Tron (TRX)</kbd></li>
                            <li>Dengan melakukan Investment <kbd>100 Bioner (BNR)</kbd> user harus melakukan transfer ke wallet admin sebesar <kbd>1000 Tron (TRX)</kbd></li>
                            <li>Setiap hari pada pukul <kbd>00:00</kbd> Setiap Stack akan di compund sebesar <kbd>0.5%</kbd> dari nilai awal investment</li>
                            <li>Pengambilan modal stacking yang belum mencapai <kbd>1 Tahun</kbd> akan dikenakan <kbd>potongan 25% dari nilai awal investment</kbd> untuk menjaga keseimbangan sirkulasi</li>
                            <li>Jika Bioner Profit telah mencapai nilai <kbd>100 BNR</kbd>. Nilai tersebut dapat diinvestmentkan kembali pada fitur <kbd>Withdraw</kbd></li>
                            <li>Untuk pembukaan stack baru bisa dengan melakukan transfer <kbd>Tron Coin (TRX)</kbd> ke wallet admin di <div class="input-group"><input type="text" id="wallet_admin" value="<?= NO_WALLET_ADMIN; ?>" class="form-control bg-dark text-white input-sm" readonly />
                                    <div class="input-group-append"><button type="button" class="btn btn-secondary btn-sm" onclick="copyClipboard()"><i class="fas fa-clipboard"></i></button></div>
                                </div>
                            </li>
                            <li>Ketentuan Nilai Awal Investment Stacking sewaktu-waktu <kbd>dapat berubah</kbd> mengikuti perubahan harga pasar dari Tron (TRX)</li>
                        </ul>
                    </div>


                    <div class="form-group row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block font-weight-bold">Add New Stack</button>
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
                        <label for="id_bioner_stacking" class="font-weight-bold">Kode Bioner Stacking</label>
                        <input type="text" class="form-control" id="id_bioner_stacking" name="id_bioner_stacking" readonly required>
                    </div>
                    <div class="form-group">
                        <label for="total_transfer_in_rp" class="font-weight-bold">Total Transfer</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="total_transfer_in_rp" name="total_transfer_in_rp" readonly required>
                            <div class="form-group-append">
                                <div class="input-group-text bg-danger text-white">TRX</div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="bukti_transfer" class="font-weight-bold">Bukti Transfer</label>
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