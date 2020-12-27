<h1 class="text-dark text-center pt-3 pb-2">Bione Stacking - Withdraw</h1>

<div class="row justify-content-center">

    <div class="col-sm-12 col-md-4 col-lg-4 mt-1 mb-1 text-center">
        <div class="card card-gradient mt-2 mb-2 pointer" onclick="showModalListReferal(<?= $this->session->userdata(SESS . 'id'); ?>);">
            <div class="card-body p-2 text-center">
                <div class="d-flex justify-content-between">
                    <div class="p-1">
                        <i class="fas fa-hand-holding-usd fa-gradient fa-2x"></i><br />
                        <b class="title-special-card">Bioner Profit</b>
                    </div>
                    <div class="p-1" style="margin-top: 10px;">
                        <p class="font-weight-bold value-special-card"><?= number_format($bioner_profit, 2); ?> <small>B</small></p>
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
                        <p class="font-weight-bold value-special-card"><?= number_format($total_investment, 0); ?> <small>B</small></p>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="col-sm-12 col-md-4 col-lg-4 mt-1 mb-1 text-center">
        <div class="card card-gradient mt-2 mb-2">
            <div class="card-body p-2 text-center">
                <a href="<?= site_url(); ?>stacking">
                    <div class="d-flex justify-content-center">
                        <div class="p-1">
                            <i class="fas fa-money-bill-wave-alt fa-gradient fa-2x"></i><br />
                            <b class="title-special-card">List Bioner Stacking</b>
                        </div>
                    </div>
                </a>
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
                <div class="table-responsive">
                    <form id="form_withdraw">
                        <div class="form-group row justify-content-center">
                            <label for="withdraw_b" class="col-sm-12 col-md-12 col-lg-3 col-form-label font-weight-bold text-center">Withdraw Amount (B)</label>
                            <div class="col-sm-12 col-md-12 col-lg-6 input-group">
                                <input type="text" class="form-control text-right" id="withdraw_b" name="withdraw_b" placeholder="Total Investment" value="0" readonly required />
                                <div class="input-group-append">
                                    <span class="input-group-text">B</span>
                                </div>
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-info" id="upValue">
                                        <i class="fas fa-arrow-up"></i>
                                    </button>
                                    <button type="button" class="btn btn-info" id="downValue">
                                        <i class="fas fa-arrow-down"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row justify-content-center">
                            <label for="withdraw_rp" class="col-sm-12 col-md-12 col-lg-3 col-form-label font-weight-bold text-center">Withdraw Amount (Rp)</label>
                            <div class="col-sm-12 col-md-12 col-lg-6 input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon2">Rp.</span>
                                </div>
                                <input type="text" class="form-control" id="withdraw_rp" name="withdraw_rp" value="0" readonly required>
                            </div>
                        </div>
                        <div class="form-group row justify-content-center">
                            <label for="id_rekening" class="col-sm-12 col-md-12 col-lg-3 col-form-label font-weight-bold text-center">Rekening</label>
                            <div class="col-sm-12 col-md-12 col-lg-6 input-group">
                                <select class="form-control" id="id_rekening" name="id_rekening" required>
                                    <option></option>
                                    <?php
                                    foreach ($arr_rekening->result() as $key) {
                                        echo '<option value="' . $key->id . '">
                                        ' . $key->no_rekening . ' - 
                                        ' . $key->nama_bank . ' - 
                                        ' . $key->atas_nama . ' - 
                                        </option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12 col-md-8 offset-md-2 mt-2">
        <div class="card text-white">
            <div class="card-header bg-dark font-weight-bold f-news text-center p-0" style="padding-top: 4px !important;">
                <span style="font-size: 25px;"><i class="fas fa-plus"></i> Add New Pack</span>
            </div>
            <div class="card-body bg-grey-1 text-dark p-2 w-100">
                <form id="form_new_stack">

                    <div class="form-group row justify-content-center">
                        <label for="total_investment" class="col-sm-12 col-md-12 col-lg-3 col-form-label font-weight-bold text-center">Total Investment</label>
                        <div class="col-sm-12 col-md-12 col-lg-6 input-group">
                            <input type="text" class="form-control text-right" id="total_investment" name="total_investment" placeholder="Total Investment" value="0" readonly required />
                            <div class="input-group-append">
                                <span class="input-group-text">B</span>
                            </div>
                            <div class="input-group-append">
                                <button type="button" class="btn btn-info" id="upValue">
                                    <i class="fas fa-arrow-up"></i>
                                </button>
                                <button type="button" class="btn btn-info" id="downValue">
                                    <i class="fas fa-arrow-down"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row justify-content-center">
                        <label for="total_transfer" class="col-sm-12 col-md-12 col-lg-3 col-form-label font-weight-bold text-center">Total Transfer</label>
                        <div class="col-sm-12 col-md-12 col-lg-6 input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon2">Rp.</span>
                            </div>
                            <input type="text" class="form-control" id="total_transfer" name="total_transfer" placeholder="Total Transfer" value="0" readonly required />
                        </div>
                    </div>

                    <div class="form-group row justify-content-center">
                        <label for="profit_per_day" class="col-sm-12 col-md-12 col-lg-3 col-form-label font-weight-bold text-center">Profit Per Day</label>
                        <div class="col-sm-12 col-md-12 col-lg-6 input-group">
                            <input type="text" class="form-control text-right" id="profit_per_day" name="profit_per_day" placeholder="Profit Per Day" value="0" readonly required />
                            <div class="input-group-append">
                                <span class="input-group-text" id="basic-addon2">B</span>
                            </div>
                        </div>
                    </div>


                    <div class="alert alert-info" role="alert">
                        <ul>
                            <li>Jika kamu belum pernah melakukan pembukaan Bioner Stacking, maka akan dikenakan biaya awal pembukaan Bioner Stacking adalah sebesar <mark>Rp.100,000</mark></li>
                            <li>Minimal Investment adalah <mark>100 Bioner</mark> atau <mark>Rp.1,500,000</mark></li>
                            <li>Nilai Investment berlaku kelipatan <mark>100 Bioner</mark> atau <mark>Rp.1,500,000</mark></li>
                            <li>Setiap hari pada pukul <mark>00:00</mark> Setiap Stack akan di compund sebesar <mark>0.5%</mark></li>
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
                        <label for="id_bioner_stacking">Kode Bioner Stacking</label>
                        <input type="text" class="form-control" id="id_bioner_stacking" name="id_bioner_stacking" readonly required>
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