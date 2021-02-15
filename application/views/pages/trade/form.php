<section class="content-header">
    <h1><?= $title; ?></h1>
    <ol class="breadcrumb">
        <li><a href="<?= site_url(); ?>dashboard"><i class="fa fa-home"></i> Home</a></li>
        <li class="active"><i class="fa fa-table"></i> <?= $title; ?></a></li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-sm-12 col-md-6 col-lg-6">
            <div class="box box-info">
                <div class="box-body">
                    <form id="form_new_trade" class="form-horizontal">

                        <div class="form-group">
                            <label for="id_user" class="col-sm-12 col-md-12 col-lg-4 control-label text-center">
                                User
                            </label>
                            <div class="col-sm-12 col-md-12 col-lg-8">
                                <select class="form-control select2" id="id_user" name="id_user" data-placeholder="User" required>
                                    <option value=""></option>
                                    <?php
                                    foreach ($arr_user->result() as $key) {
                                        echo '<option value="' . $key->id . '">' . $key->nama . ' - ' . $key->email . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <hr>

                        <div class="form-group">
                            <label for="total_lot" class="col-sm-12 col-md-12 col-lg-4 control-label text-center">
                                Total Hak Investment
                            </label>
                            <div class="col-sm-12 col-md-12 col-lg-8">
                                <div class="input-group">
                                    <input type="text" class="form-control text-right" id="total_lot" name="total_lot" placeholder="Total Hak Investment" value="0" readonly required />
                                    <span class="input-group-addon">Lot</span>
                                    <div class="input-group-btn">
                                        <button type="button" class="btn btn-info" id="upValue" disabled>
                                            <i class="fa fa-arrow-up"></i>
                                        </button>
                                        <button type="button" class="btn btn-info" id="downValue" disabled>
                                            <i class="fa fa-arrow-down"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="nilai_investment" class="col-sm-12 col-md-12 col-lg-4 control-label text-center">
                                Nilai Investment
                            </label>
                            <div class="col-sm-12 col-md-12 col-lg-8">
                                <div class="input-group">
                                    <span class="input-group-addon">Rp.</span>
                                    <input type="text" class="form-control" id="nilai_investment" name="nilai_investment" placeholder="Nilai Investment" value="0" readonly required />
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="biaya_sewa" class="col-sm-12 col-md-12 col-lg-4 control-label text-center">
                                Biaya Sewa
                            </label>
                            <div class="col-sm-12 col-md-12 col-lg-8">
                                <div class="input-group">
                                    <span class="input-group-addon">Rp.</span>
                                    <input type="text" class="form-control" id="biaya_sewa" name="biaya_sewa" placeholder="Biaya Sewa" value="0" readonly required />
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="total_transfer" class="col-sm-12 col-md-12 col-lg-4 control-label text-center">
                                Total Transfer
                            </label>
                            <div class="col-sm-12 col-md-12 col-lg-8">
                                <div class="input-group">
                                    <span class="input-group-addon">Rp.</span>
                                    <input type="text" class="form-control" id="total_transfer" name="total_transfer" placeholder="Total Transfer" value="0" readonly required />
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="form-group">
                            <label for="profit_per_day" class="col-sm-12 col-md-12 col-lg-4 control-label text-center">
                                Profit Per Day
                            </label>
                            <div class="col-sm-12 col-md-12 col-lg-8">
                                <div class="input-group">
                                    <span class="input-group-addon">Rp.</span>
                                    <input type="text" class="form-control text-right" id="profit_per_day" name="profit_per_day" placeholder="Profit Per Day" value="0" readonly required />
                                </div>
                            </div>
                        </div>


                        <button type="submit" class="btn btn-primary btn-block font-weight-bold">Add New Trade</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</section>