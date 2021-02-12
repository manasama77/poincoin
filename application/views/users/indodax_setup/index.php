<h1 class="text-dark text-center pt-3 pb-2"><?= $title; ?></h1>

<div class="row">
    <div class="col-sm-12 col-md-6 offset-md-3 mt-2">
        <div class="card text-white">
            <div class="card-header bg-dark font-weight-bold f-news text-center p-0" style="vertical-align: middle;">
                <span style="font-size: 25px;">
                    <i class="fas fa-key"></i> API & Secret Key
                </span>
            </div>
            <div class="card-body bg-grey-1 text-dark p-2 w-100">
                <form id="form_input">
                    <div class="form-group">
                        <label for="id_jenis">API Key</label>
                        <textarea class="form-control" id="api_indodax" name="api_indodax" placeholder="API Key"><?= $api_indodax; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="id_jenis">Secret Key</label>
                        <textarea class="form-control" id="secret_indodax" name="secret_indodax" placeholder="Secret Key Indodax"><?= $secret_indodax; ?></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>