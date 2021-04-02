<section class="content-header">
    <h1><?= $title; ?></h1>
    <ol class="breadcrumb">
        <li><a href="<?= site_url(); ?>dashboard"><i class="fa fa-home"></i> Home</a></li>
        <li class="active"><i class="fa fa-table"></i> <?= $title; ?></a></li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <div class="box box-info">
                <div class="box-body">
                    <form id="form_new_stack" class="form-horizontal">

                        <div class="form-group">
                            <label for="id_user" class="col-sm-12 col-md-12 col-lg-2 control-label text-center">
                                User
                            </label>
                            <div class="col-sm-12 col-md-12 col-lg-10">
                                <select class="form-control select2" id="id_user" name="id_user" data-placeholder="Pilih User" required>
                                    <option value=""></option>
                                    <?php
                                    foreach ($arr_user->result() as $key) {
                                        echo '<option value="' . $key->id . '">' . $key->nama . ' - ' . $key->email . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="tipe_stack" class="col-sm-12 col-md-12 col-lg-2 control-label text-center">
                                Tipe Stack
                            </label>
                            <div class="col-sm-12 col-md-12 col-lg-2">
                                <select class="form-control" id="tipe_stack" name="tipe_stack" data-placeholder="Tipe Stack" required>
                                    <option value="new">New</option>
                                    <option value="special">Special</option>
                                </select>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group">
                            <label for="total_investment" class="col-sm-12 col-md-12 col-lg-2 control-label text-center">
                                Total Investment
                            </label>
                            <div class="col-sm-12 col-md-12 col-lg-2">
                                <div class="input-group">
                                    <input type="number" class="form-control" id="total_investment" name="total_investment" placeholder="Total Investment" value="0" min="100" max="100000" step="100" required />
                                    <span class="input-group-addon bg-blue text-white">BNR</span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="total_transfer" class="col-sm-12 col-md-12 col-lg-2 control-label text-center">
                                Total Transfer
                            </label>
                            <div class="col-sm-12 col-md-12 col-lg-2">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="total_transfer" name="total_transfer" placeholder="Total Transfer" value="0" readonly required />
                                    <span class="input-group-addon bg-red text-white">TRX</span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="profit_per_day" class="col-sm-12 col-md-12 col-lg-2 control-label text-center">
                                Profit Per Day
                            </label>
                            <div class="col-sm-12 col-md-12 col-lg-2">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="profit_per_day" name="profit_per_day" placeholder="Profit Per Day" value="0" readonly required />
                                    <span class="input-group-addon bg-blue text-white">BNR</span>
                                </div>
                            </div>
                        </div>


                        <button type="submit" class="btn btn-primary btn-block font-weight-bold">Add New Stack</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</section>