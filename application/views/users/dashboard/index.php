<h1 class="text-dark text-center pt-3 pb-2">Dashboard</h1>

<div class="row">
    <div class="col-sm-12 col-md-6 offset-md-3 mt-2">
        <div class="card text-white">
            <div class="card-header bg-dark font-weight-bold f-news text-center p-2" style="padding-top: 4px !important;">
                <span style="font-size: 25px;"><i class="fas fa-users"></i> Referal</span>
            </div>
            <div class="card-body bg-grey-1 text-dark p-0 w-100">
                <ul class="list-group list-group-flush">
                    <?php
                    if ($count_referal->num_rows() == 0) {
                    ?>
                        <li class="list-group-item d-flex bg-grey-1 text-dark justify-content-between align-items-center">Kamu belum memiliki referal</li>
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
                    <li class="list-group-item bg-grey-1 text-dark f-news pl-3 pt-0 pb-2 p-0">
                        <div class="text-left">
                            <span class="badge badge-primary">
                                01 Dec 2020
                            </span>
                        </div>
                        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Aperiam, natus!
                    </li>
                    <li class="list-group-item bg-grey-1 text-dark f-news pl-3 pt-0 pb-2 p-0">
                        <div class="text-left">
                            <span class="badge badge-primary">
                                01 Dec 2020
                            </span>
                        </div>
                        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Aperiam, natus!
                    </li>
                    <li class="list-group-item bg-grey-1 text-dark f-news pl-3 pt-0 pb-2 p-0">
                        <div class="text-left">
                            <span class="badge badge-primary">
                                01 Dec 2020
                            </span>
                        </div>
                        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Aperiam, natus!
                    </li>
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