<div class="row justify-content-center">

    <div class="col-sm-12 col-md-4 col-lg-4 mt-1 mb-1 text-center">
        <div class="card card-gradient mt-2 mb-2 pointer" onclick="showModalListReferal(<?= $this->session->userdata(SESS . 'id'); ?>);">
            <div class="card-body p-2 text-center">
                <div class="d-flex justify-content-between">
                    <div class="p-2">
                        <i class="fas fa-users fa-gradient fa-2x"></i><br />
                        <b style="color: #000;">Total Refferal</b>
                    </div>
                    <div class="p-2" style="margin-top: 10px;">
                        <h3 class="font-weight-bold"><?= $count_referal->num_rows(); ?> <small>Member</small></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-12 col-md-4 col-lg-4 mt-1 mb-1 text-center">
        <div class="card card-gradient mt-2 mb-2">
            <div class="card-body p-2 text-center">
                <div class="d-flex justify-content-between">
                    <div class="p-2">
                        <i class="fas fa-chart-bar fa-gradient fa-2x"></i><br />
                        <b style="color: #000;">Profit Balance</b>
                    </div>
                    <div class="p-2" style="margin-top: 10px;">
                        <h3 class="font-weight-bold">0.14 <small>B</small></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-12 col-md-4 col-lg-4 mt-1 mb-1 text-center">
        <div class="card card-gradient mt-2 mb-2">
            <div class="card-body p-2 text-center">
                <div class="d-flex justify-content-between">
                    <div class="p-2">
                        <i class="fas fa-hand-holding-usd fa-gradient fa-2x"></i><br />
                        <b style="color: #000;">Bonus Balance</b>
                    </div>
                    <div class="p-2" style="margin-top: 10px;">
                        <h3 class="font-weight-bold">59.40 <small>B</small></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-12 col-md-4 col-lg-4 mt-1 mb-1 text-center">
        <div class="card card-gradient mt-2 mb-2">
            <div class="card-body p-2 text-center">
                <div class="d-flex justify-content-between">
                    <div class="p-2">
                        <i class="fas fa-wallet fa-gradient fa-2x"></i><br />
                        <b style="color: #000;">Cash Balance</b>
                    </div>
                    <div class="p-2" style="margin-top: 10px;">
                        <h3 class="font-weight-bold">59.40 <small>B</small></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-12 col-md-4 col-lg-4 mt-1 mb-1 text-center">
        <div class="card card-gradient mt-2 mb-2">
            <div class="card-body p-2 text-center">
                <div class="d-flex justify-content-between">
                    <div class="p-2">
                        <i class="fas fa-coins fa-gradient fa-2x"></i><br />
                        <b style="color: #000;">Total Investment</b>
                    </div>
                    <div class="p-2" style="margin-top: 10px;">
                        <h3 class="font-weight-bold">59.40 <small>B</small></h3>
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
                <span style="font-size: 25px;">NEWS</span>
            </div>
            <div class="card-body bg-dark-1 p-2 w-100">
                <ul class="list-group p-0">
                    <li class="list-group-item bg-dark-1 text-white f-news pl-3 pt-0 pb-2 p-0">
                        <div class="text-left">
                            <span class="badge badge-primary">
                                01 Dec 2020
                            </span>
                        </div>
                        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Aperiam, natus!
                    </li>
                    <li class="list-group-item bg-dark-1 text-white f-news pl-3 pt-2 pb-2 p-0">
                        <div class="text-left">
                            <span class="badge badge-primary">
                                01 Dec 2020
                            </span>
                        </div>
                        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Aperiam, natus!
                    </li>
                    <li class="list-group-item bg-dark-1 text-white f-news pl-3 pt-2 pb-2 p-0">
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

<div class="modal fade" id="menuModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="margin-top: 10vh;">
        <div class="modal-content modal-special text-white">
            <!-- <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">MENU</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div> -->
            <div class="modal-body text-center">
                <div class="row justify-content-center">
                    <div class="col-6">
                        <div class="text-center">
                            <button type="button" class="btn btn-danger btn-lg">
                                <i class="fas fa-home fa-2x fa-fw"></i>
                            </button>
                            <p>Dashboard</p>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="text-center">
                            <button type="button" class="btn btn-danger btn-lg">
                                <i class="fas fa-cog fa-2x fa-fw"></i>
                            </button>
                            <p>Setting</p>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="text-center">
                            <button type="button" class="btn btn-danger btn-lg">
                                <i class="fas fa-user-shield fa-2x fa-fw"></i>
                            </button>
                            <p>Secure</p>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="text-center">
                            <button type="button" class="btn btn-danger btn-lg">
                                <i class="fas fa-chart-pie fa-2x fa-fw"></i>
                            </button>
                            <p>Investment</p>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="text-center">
                            <button type="button" class="btn btn-danger btn-lg">
                                <i class="fas fa-wallet fa-2x fa-fw"></i>
                            </button>
                            <p>Cash Wallet</p>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="text-center">
                            <button type="button" class="btn btn-danger btn-lg">
                                <i class="fas fa-chart-bar fa-2x fa-fw"></i>
                            </button>
                            <p>Funds</p>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="text-center">
                            <button type="button" class="btn btn-danger btn-lg">
                                <i class="fas fa-users fa-2x fa-fw"></i>
                            </button>
                            <p>Network</p>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="text-center">
                            <button type="button" class="btn btn-danger btn-lg">
                                <i class="fas fa-user-plus fa-2x fa-fw"></i>
                            </button>
                            <p>Register</p>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="text-center">
                            <button type="button" class="btn btn-danger btn-lg">
                                <i class="fas fa-sign-out-alt fa-2x fa-fw"></i>
                            </button>
                            <p>Sign out</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalReferal" tabindex="-1" role="dialog" aria-labelledby="modalReferal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header text-dark">
                <h5 class="modal-title" id="exampleModalLongTitle">List Referal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-dark">
                <ul class="list-group list-group-flush">
                    <?php
                    foreach ($count_referal->result() as $key) {
                    ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
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
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>