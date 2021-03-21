<h1 class="text-dark text-center pt-3 pb-2"><?= $title; ?></h1>

<div class="row">
    <div class="col-sm-12 col-md-6 offset-md-3 mt-2">
        <div class="card text-white">
            <div class="card-header bg-dark font-weight-bold f-news text-center p-0" style="padding-top: 4px !important;">
                <span style="font-size: 25px;"><i class="fas fa-table"></i> User Profile</span>
            </div>
            <div class="card-body bg-grey-1 text-dark p-2 w-100">
                <table class="table">
                    <tbody>
                        <tr>
                            <th style="width: 150px;">Nama</th>
                            <th class="text-center">:</th>
                            <td><?= $arr_users->row()->nama; ?></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <th class="text-center">:</th>
                            <td><?= $arr_users->row()->email; ?></td>
                        </tr>
                        <tr>
                            <th>No Handphone</th>
                            <th class="text-center">:</th>
                            <td><?= $arr_users->row()->no_hp; ?></td>
                        </tr>
                        <tr>
                            <th>Created At</th>
                            <th class="text-center">:</th>
                            <td><?= $arr_users->row()->created_at; ?></td>
                        </tr>
                        <tr>
                            <th>Last Login</th>
                            <th class="text-center">:</th>
                            <td><?= $arr_users->row()->updated_at; ?></td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3">
                                <a href="<?= site_url(); ?>change_password_user" class="btn btn-primary btn-block">
                                    <i class="fas fa-key"></i> Change Password
                                </a>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12 col-md-6 offset-md-3 mt-2">
        <div class="card text-white">
            <div class="card-header bg-dark font-weight-bold f-news text-center p-0" style="padding-top: 4px !important;">
                <span style="font-size: 25px;"><i class="fas fa-table"></i> Rekening Bank</span>
            </div>
            <div class="card-body bg-grey-1 text-dark p-2 w-100">
                <table class="table">
                    <thead>
                        <tr>
                            <!-- <th>#</th> -->
                            <th>Bank</th>
                            <th>No Rekening</th>
                            <th>Atas Nama</th>
                            <!-- <th><i class="fas fa-cogs"></i></th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($arr_user_banks->num_rows() == 0) {
                            echo '<tr><th class="text-center" colspan="3">- Kamu belum memiliki No Rekening Terdaftar -</th></tr>';
                        } else {
                            $no = 1;
                            foreach ($arr_user_banks->result() as $key) {
                        ?>
                                <tr>
                                    <!-- <td><?= $no; ?></td> -->
                                    <td><?= $key->nama_bank; ?></td>
                                    <td><?= $key->no_rekening; ?></td>
                                    <td><?= $key->atas_nama; ?></td>
                                    <!-- <td>
                                        <button type="button" class="btn btn-info btn-sm" onclick="editData('<?= $key->id; ?>', '<?= $key->id_bank; ?>', '<?= $key->no_rekening; ?>', '<?= $key->atas_nama; ?>');">
                                            <i class="fas fa-pencil-alt"></i>
                                        </button>
                                        <button type="button" class="btn btn-danger btn-sm" onclick="deleteData('<?= $key->id; ?>', '<?= $key->id_bank; ?>', '<?= $key->no_rekening; ?>', '<?= $key->atas_nama; ?>');">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td> -->
                                </tr>
                        <?php
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

<div class="row">
    <div class="col-sm-12 col-md-6 offset-md-3 mt-2">
        <div class="card text-white">
            <div class="card-header bg-dark font-weight-bold f-news text-center p-0" style="vertical-align: middle;">
                <span style="font-size: 25px;">
                    <img src="<?= base_url(); ?>public/img/tron logo.png" alt="TRON Logo" class="img-fluid" style="width: 30px;" /> Tronlink Wallet
                </span>
            </div>
            <div class="card-body bg-grey-1 text-dark p-2 w-100">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No Wallet</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($arr_user_wallets->num_rows() == 0) {
                            echo '<tr><th class="text-center" colspan="1">- Kamu belum memiliki Tronlink Wallet Terdaftar -</th></tr>';
                        } else {
                            $no = 1;
                            foreach ($arr_user_wallets->result() as $key) {
                        ?>
                                <tr>
                                    <td><?= $key->no_wallet; ?></td>
                                </tr>
                        <?php
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

<?php
if ($arr_user_banks->num_rows() == 0 || $arr_user_wallets->num_rows() == 0) {
?>
    <div class="row">
        <div class="col-sm-12 col-md-6 offset-md-3 mt-2">
            <div class="card text-white">
                <div class="card-header bg-dark font-weight-bold f-news text-center p-0" style="vertical-align: middle;">
                    <span style="font-size: 25px;">
                        <i class="fas fa-plus"></i> Tambah Rekening
                    </span>
                </div>
                <div class="card-body bg-grey-1 text-dark p-2 w-100">
                    <form id="form_tambah_rekening">
                        <div class="form-group">
                            <label for="id_jenis">Jenis Rekening</label>
                            <select class="form-control" id="id_jenis" name="id_jenis" onchange="readJenis()" required>
                                <option value=""></option>
                                <?php
                                if ($arr_user_banks->num_rows() == 0) {
                                ?>
                                    <option value="bank">Bank</option>
                                <?php
                                }
                                if ($arr_user_wallets->num_rows() == 0) {
                                ?>
                                    <option value="doge">Tronlink Wallet</option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <hr>
                        <div id="form_bank" style="display: none">
                            <div class="form-group">
                                <label for="id_bank">Bank</label>
                                <select class="form-control" id="id_bank" name="id_bank" required>
                                    <?php
                                    foreach ($arr_banks->result() as $key) {
                                        echo '<option value="' . $key->id . '">' . $key->nama_bank . ' (' . $key->kode_bank . ')</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="no_rekening">No Rekening</label>
                                <input type="number" class="form-control" id="no_rekening" name="no_rekening" placeholder="No Rekening" required />
                            </div>
                            <div class="form-group">
                                <label for="atas_nama">Atas Nama</label>
                                <input type="text" class="form-control" id="atas_nama" name="atas_nama" placeholder="Atas Nama" required />
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block">Tambah Rekening</button>
                            </div>
                        </div>
                        <div id="form_doge" style="display: none">
                            <div class="form-group">
                                <label for="no_wallet">Tronlink Wallet Address</label>
                                <input type="text" class="form-control" id="no_wallet" name="no_wallet" placeholder="Tronlink Wallet Address" required />
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block">Tambah Wallet</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php
}
?>

<form id="form_edit_rekening">
    <div class="modal fade" id="modal_edit_rekening" tabindex="-1" role="dialog" aria-labelledby="modal_edit_rekening_label" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Rekening</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="id_bank_edit">Bank</label>
                        <select class="form-control" id="id_bank_edit" name="id_bank_edit" required>
                            <?php
                            foreach ($arr_banks->result() as $key) {
                                echo '<option value="' . $key->id . '">' . $key->nama_bank . ' (' . $key->kode_bank . ')</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="no_rekening_edit">No Rekening</label>
                        <input type="number" class="form-control" id="no_rekening_edit" name="no_rekening_edit" placeholder="No Rekening" required />
                    </div>
                    <div class="form-group">
                        <label for="atas_nama_edit">Atas Nama</label>
                        <input type="text" class="form-control" id="atas_nama_edit" name="atas_nama_edit" placeholder="Atas Nama" required />
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" class="form-control" id="id_user_banks_edit" name="id_user_banks_edit">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</form>

<form id="form_edit_wallet">
    <div class="modal fade" id="modal_edit_wallet" tabindex="-1" role="dialog" aria-labelledby="modal_edit_wallet_label" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Doge Wallet</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="no_wallet_edit">No Wallet</label>
                        <input type="number" class="form-control" id="no_wallet_edit" name="no_wallet_edit" placeholder="No Wallet" required />
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" class="form-control" id="id_wallet_edit" name="id_wallet_edit">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</form>