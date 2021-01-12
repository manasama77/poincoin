<h1 class="text-dark text-center pt-3 pb-2">Bioner Trade - Withdraw</h1>

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
        <div class="card card-gradient mt-2 mb-2 pointer" onclick="window.open('<?= site_url(); ?>trade', '_self')">
            <div class="card-body p-2 text-center">
                <div class="d-flex justify-content-center">
                    <div class="p-1">
                        <i class="fas fa-money-bill-wave-alt fa-gradient fa-2x"></i><br />
                        <b class="title-special-card">List Bioner Trade</b>
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
                <span style="font-size: 25px;"><i class="fas fa-money-bill-wave-alt"></i> List Withdraw</span>
            </div>
            <div class="card-body bg-grey-1 text-dark p-2 w-100">
                <div class="table-responsive">
                    <table class="table table-bordered w-100">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-right" style="min-width: 120px;">
                                    Amount
                                    <small class="badge badge-info" data-toggle="tooltip" data-placement="top" title="Bioner">Rp</small>
                                </th>
                                <th class="text-center">Rekening</th>
                                <th class="text-center" style="min-width: 120px;">Tanggal</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">
                                    <i class="fas fa-cog"></i>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($arr_withdraw->num_rows() == 0) {
                                echo '<tr><td colspan="6" class="text-center">Kamu belum memiliki history withdraw</td></tr>';
                            } else {
                                $no = 1;
                                foreach ($arr_withdraw->result() as $key) {
                                    $btn = '';
                                    if ($key->status == "pending") {
                                        $bg_color = "secondary";
                                        $btn = '
                                        <button type="button" class="btn btn-danger btn-sm" onclick="deleteData(\'' . $key->id . '\', \'' . $key->withdraw_rp . '\')">
                                          <i class="fas fa-trash"></i>
                                        </button>';
                                    } elseif ($key->status == "success") {
                                        $bg_color = "success";
                                    } else {
                                        $bg_color = "danger";
                                    }

                                    $rekening = "";
                                    if ($key->id_user_bank != NULL) {
                                    } elseif ($key->kode_invest != NULL) {
                                        $rekening = 'Investment ' . $key->kode_invest;
                                    }

                                    echo '
                                    <tr>
                                    <td class="text-center">' . $no . '</td>
                                    <td class="text-right">' . number_format($key->withdraw_rp, 0) . '</td>
                                    <td class="text-center">' . $rekening . '</td>
                                    <td class="text-center">' . $key->created_at . '</td>
                                    <td class="text-center">
                                    <span class="badge badge-' . $bg_color . '">
                                    ' . $key->status . '
                                    </span>
                                    </td>
                                    <td class="text-center">
                                    ' . $btn . '
                                    </td>
                                    </tr>
                                    ';
                                    $no++;
                                }
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
                <span style="font-size: 25px;"><i class="fas fa-money-bill-wave-alt"></i> Withdraw</span>
            </div>
            <div class="card-body bg-grey-1 text-dark p-2 w-100">
                <form id="form_withdraw" class="form-horizontal">
                    <div class="form-group row justify-content-center">
                        <label for="id_jenis" class="col-sm-12 col-md-12 col-lg-3 col-form-label font-weight-bold text-center">Jenis Withdraw</label>
                        <div class="col-sm-12 col-md-12 col-lg-6">
                            <select class="form-control" id="id_jenis" name="id_jenis" onchange="cekJenis();" required>
                                <option value=""></option>
                                <option value="bank">Bank</option>
                                <option value="invest">Investment Trade</option>
                            </select>
                        </div>
                    </div>

                    <div id="form_bank" style="display: none;">
                        <div class="form-group row justify-content-center">
                            <label for="id_rekening" class="col-sm-12 col-md-12 col-lg-3 col-form-label font-weight-bold text-center">Rekening</label>
                            <div class="col-sm-12 col-md-12 col-lg-6">
                                <select class="form-control" id="id_rekening" name="id_rekening">
                                    <option></option>
                                    <?php
                                    foreach ($arr_rekening->result() as $key) {
                                        echo '<option value="' . $key->id . '">
                                        ' . $key->no_rekening . ' - 
                                        ' . $key->nama_bank . ' - 
                                        ' . $key->atas_nama . '
                                        </option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row justify-content-center">
                            <label for="withdraw_b" class="col-sm-12 col-md-12 col-lg-3 col-form-label font-weight-bold text-center">Withdraw Amount (Rp)</label>
                            <div class="col-sm-12 col-md-12 col-lg-6 input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp</span>
                                </div>
                                <input type="number" class="form-control" id="withdraw_rp" name="withdraw_rp" placeholder="Withdraw Amount (Rp)" min="10000" max="<?= $balance_saldo; ?>" step="10000" pattern="[0-9]" inputmode="tel" required />
                            </div>
                            <div class="col-12">
                                <small class="form-text text-muted">Minimal Rp.750,000 untuk dapat diinvestkan kembali</small>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Withdraw</button>
                    </div>
                    <div id="form_invest" style="display: none;">
                        <div class="form-group row justify-content-center">
                            <label for="withdraw_b" class="col-sm-12 col-md-12 col-lg-3 col-form-label font-weight-bold text-center">Hak Investment</label>
                            <div class="col-sm-12 col-md-12 col-lg-6 input-group">
                                <input type="number" class="form-control" id="hi" name="hi" placeholder="Hak Investment" min="0" max="<?= floor($balance_saldo / 750000); ?>" step="1" pattern="[0-9]" inputmode="tel" required />
                                <div class="input-group-append">
                                    <span class="input-group-text">HI</span>
                                </div>
                            </div>
                            <div class="col-12">
                                <small class="form-text text-muted">1 HI setara dengan Rp.750,000</small>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Invest</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>