<h1 class="text-dark text-center pt-3 pb-2">Poincoin Network - Withdraw</h1>

<div class="row justify-content-center">

    <div class="col-sm-12 col-md-4 col-lg-4 mt-1 mb-1 text-center">
        <div class="card card-gradient-pc mt-2 mb-2">
            <div class="card-body p-2 text-center">
                <div class="d-flex justify-content-between">
                    <div class="p-1">
                        <i class="fas fa-hand-holding-usd fa-gradient fa-2x"></i><br />
                        <b class="title-special-card">Poincoin Profit</b>
                    </div>
                    <div class="p-1" style="margin-top: 10px;">
                        <p class="font-weight-bold value-special-card"><?= number_format($bioner_profit, 4); ?> <small>PC</small></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-12 col-md-4 col-lg-4 mt-1 mb-1 text-center">
        <div class="card card-gradient-pc mt-2 mb-2 pointer" onclick="window.open('<?= site_url(); ?>stacking', '_self')">
            <div class="card-body p-2 text-center">
                <div class="d-flex justify-content-center">
                    <div class="p-1">
                        <i class="fas fa-money-bill-wave-alt fa-gradient fa-2x"></i><br />
                        <b class="title-special-card">List Poincoin Network</b>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="row">
    <div class="col-sm-12 col-md-8 offset-md-2 mt-2">
        <div class="card text-white">
            <div class="card-header bg-poincoin1 font-weight-bold f-news text-center p-0" style="padding-top: 4px !important;">
                <span style="font-size: 25px;"><i class="fas fa-money-bill-wave-alt"></i> List Withdraw</span>
            </div>
            <div class="card-body bg-grey-1 text-dark p-2 w-100">
                <div class="table-responsive">
                    <table class="table table-bordered w-100 datatables">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-right" style="min-width: 120px;">
                                    Amount
                                    <small class="badge badge-info" data-toggle="tooltip" data-placement="top" title="Poincoin">PC</small>
                                </th>
                                <th class="text-center">Rekening / Wallet</th>
                                <th class="text-center" style="min-width: 120px;">Tanggal</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">
                                    <i class="fas fa-cog"></i>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($arr_withdraw->result() as $key) {
                                $btn = '';
                                if ($key->status == "pending") {
                                    $bg_color = "secondary";
                                    $btn = '
                                        <button type="button" class="btn btn-danger btn-sm" onclick="deleteData(\'' . $key->id . '\', \'' . $key->withdraw_b . '\')">
                                          <i class="fas fa-trash"></i>
                                        </button>';
                                } elseif ($key->status == "success") {
                                    $bg_color = "success";
                                } else {
                                    $bg_color = "danger";
                                }

                                $rekening = "";
                                if ($key->id_user_bank != NULL) {
                                    $rekening = $key->nama_bank . " " . $key->no_rekening . " " . $key->atas_nama;
                                } elseif ($key->id_user_wallet != NULL) {
                                    $rekening = $key->no_wallet;
                                } elseif ($key->kode_invest != NULL) {
                                    $rekening = 'Investment ' . $key->kode_invest;
                                }

                                echo '
                                    <tr>
                                    <td class="text-center">' . $no . '</td>
                                    <td class="text-right">' . number_format($key->withdraw_b, 4) . '</td>
                                    <td class="text-center"><small>' . $rekening . '</small></td>
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
                            ?>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>