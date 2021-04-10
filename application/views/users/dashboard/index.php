<h1 class="text-dark text-center pt-3 pb-2">Dashboard</h1>

<?php
if ($count_bank == 0) {
    echo '
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Kamu belum mendaftarkan No Rekening</strong>
        <br>
        <a href="' . site_url('profile') . '" class="btn btn-primary">
            Daftarkan No Rekening
        </a>
        <div class="pull-right">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>';
}

if ($count_wallet == 0) {
    echo '
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Kamu belum mendaftarkan No Wallet</strong>
        <br>
        <a href="' . site_url('profile') . '" class="btn btn-primary">
            Daftarkan No Wallet
        </a>
        <div class="pull-right">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>';
}
?>
<div class="row">
    <div class="col-sm-12 col-md-10 offset-md-1 mt-2">
        <div class="card text-white">
            <div class="card-header bg-dark font-weight-bold text-center p-0">
                <span style="font-size: 25px;">TRX / BNR Chart</span>
            </div>
            <div class="card-body bg-grey-1 text-dark p-0 w-100" style="min-height: 100px;">
                <div id="columnchart_material"></div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12 col-md-6 offset-md-3 mt-2">
        <div class="card text-white">
            <div class="card-header bg-dark font-weight-bold f-news text-center p-2" style="padding-top: 4px !important;">
                <span style="font-size: 25px;"><i class="fas fa-users"></i> Referral</span>
            </div>
            <div class="card-body bg-grey-1 text-dark p-0 w-100">
                <ul class="list-group list-group-flush">
                    <?php
                    if ($count_referal->num_rows() == 0) {
                    ?>
                        <li class="list-group-item d-flex bg-grey-1 text-dark justify-content-between align-items-center">Kamu belum memiliki referral</li>
                    <?php
                    } else {
                    ?>
                        <?php
                        foreach ($count_referal->result() as $key) {
                        ?>
                            <li class="list-group-item d-flex bg-grey-1 text-dark justify-content-between align-items-center">
                                <?= $key->nama; ?>
                                <span class="badge badge-primary badge-pill">
                                    <?php
                                    $date = new DateTime();
                                    $date->createFromFormat('Y-m-d H:i:s', $key->created_at);
                                    echo $date->format('d-M-Y H:i');
                                    ?>
                                </span>
                            </li>
                        <?php
                        }
                        ?>
                    <?php
                    }
                    ?>
                </ul>
            </div>
            <div class="card-footer bg-dark font-weight-bold f-news text-center p-2">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Referral Link:</span>
                    </div>
                    <input type="text" class="ml-2 form-control-plaintext text-white" id="link_referral" value="<?= site_url(); ?>member/signup/<?= $this->session->userdata(SESS . 'id'); ?>" readonly>
                    <div class="input-group-append">
                        <button type="button" class="btn btn-secondary" onclick="copyClipboard()">
                            <i class="fas fa-clipboard"></i> Copy
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12 col-md-6 offset-md-3 mt-2">
        <div class="card text-white">
            <div class="card-header bg-dark font-weight-bold f-news text-center p-0" style="padding-top: 4px !important;">
                <span style="font-size: 25px;">NEWS</span>
            </div>
            <div class="card-body bg-grey-1 text-dark p-0 w-100">
                <ul class="list-group p-0">
                    <?php
                    if ($arr_news->num_rows() > 0) {
                        foreach ($arr_news->result() as $key) {
                            $tgl_obj = new Datetime($key->created_at);
                            $tgl_obj->createFromFormat('Y-m-d H:i:s', $key->created_at);
                    ?>
                            <li class="list-group-item bg-grey-1 text-dark f-news pl-3 pt-0 pb-2 p-0">
                                <div class="text-left">
                                    <span class="badge badge-primary">
                                        <?= $tgl_obj->format('d M Y'); ?>
                                    </span>
                                </div>
                                <h4><?= $title; ?></h4>
                                <h5><small><?= $key->content; ?></small></h5>
                            </li>
                        <?php
                        }
                    } else {
                        ?>
                        <li class="list-group-item bg-grey-1 text-dark f-news pl-3 pt-0 pb-2 p-0">
                            <h4 class="pt-2 text-center">Tidak ada berita</h4>
                        </li>
                    <?php
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- <div class="row">
    <div class="col-sm-12 col-md-12 offset-md-12 mt-2">
        <div class="card text-white">
            <div class="card-header bg-dark font-weight-bold f-news text-center p-0" style="padding-top: 4px !important;">
                <span style="font-size: 20px;">IDR Markets <small id="update_timestamp"></small></span>
            </div>
            <div class="card-body bg-grey-1 text-dark p-2 w-100">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover" id="table_idr">
                        <thead class="bg-dark text-white">
                            <tr>
                                <th>#</th>
                                <th style="width: 100px;">Market</th>
                                <th>Asset Name</th>
                                <th>Last Price</th>
                                <th>Buy</th>
                                <th>Sell</th>
                                <th>High 24h</th>
                                <th>Low 24h</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div> -->

<div class="row">
    <div class="col-sm-12 col-md-10 offset-md-1 mt-2">
        <div class="card text-white">
            <div class="card-header bg-dark font-weight-bold f-news text-center p-0" style="padding-top: 4px !important;">
                <span style="font-size: 25px;">WHITE PAPER BIONER</span>
            </div>
            <div class="card-body bg-grey-1 text-dark p-0 w-100">
                <iframe src="https://docs.google.com/viewer?url=https://bioner.online/public/pdf/white_paper_bioner.pdf&embedded=true" style="width:100%; height:500px;" frameborder="0"></iframe>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="notificationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="exampleModalLabel">Notification</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa fa-times text-black"></i></span>
                </button>
            </div>
            <div class="modal-body">
                <ul class="list-group">
                    <li class="list-group-item list-group-item-action">
                        <i class="fa fa-exclamation-circle fa-fw"></i> Transfer Cash Poin Wallet ballance wallet
                        <br />
                        <small>1 Week ago</small>
                    </li>
                    <li class="list-group-item list-group-item-action">
                        <i class="fa fa-exclamation-circle fa-fw"></i> Transfer Cash Poin Wallet ballance wallet
                        <br />
                        <small>2 Week ago</small>
                    </li>
                    <li class="list-group-item list-group-item-action">
                        <i class="fa fa-exclamation-circle fa-fw"></i> Transfer Cash Poin Wallet ballance wallet
                        <br />
                        <small>3 Week ago</small>
                    </li>
                    <li class="list-group-item list-group-item-action">
                        <i class="fa fa-exclamation-circle fa-fw"></i> Transfer Cash Poin Wallet ballance wallet
                        <br />
                        <small>4 Week ago</small>
                    </li>
                    <li class="list-group-item list-group-item-action">
                        <i class="fa fa-exclamation-circle fa-fw"></i> Transfer Cash Poin Wallet ballance wallet
                        <br />
                        <small>5 Week ago</small>
                    </li>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>