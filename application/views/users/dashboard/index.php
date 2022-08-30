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
    <div class="col-sm-12 col-md-6 offset-md-3 mt-2">
        <div class="card text-white">
            <div class="card-header bg-poincoin1 text-dark font-weight-bold f-news text-center p-2" style="padding-top: 4px !important;">
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
            <div class="card-footer bg-poincoin1 font-weight-bold f-news text-center p-2">
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
            <div class="card-header bg-poincoin1 font-weight-bold f-news text-center p-0" style="padding-top: 4px !important;">
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