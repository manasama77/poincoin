<h1 class="text-dark text-center pt-3 pb-2"><?= $title; ?></h1>

<form id="form_change_password">
    <div class="row">
        <div class="col-sm-12 col-md-6 offset-md-3 mt-2">
            <div class="card text-white">
                <div class="card-header bg-dark font-weight-bold f-news text-center p-0" style="padding-top: 4px !important;">
                    <span style="font-size: 25px;"><i class="fas fa-table"></i> Form Change Password</span>
                </div>
                <div class="card-body bg-grey-1 text-dark p-2 w-100">
                    <div class="form-group">
                        <label for="current_password">Current Password</label>
                        <input type="password" class="form-control" id="current_password" name="current_password" autocomplete="new-password" required />
                    </div>
                    <div class="form-group">
                        <label for="new_password">New Password</label>
                        <input type="password" class="form-control" id="new_password" name="new_password" autocomplete="new-password" required />
                    </div>
                    <div class="form-group">
                        <label for="re_new_password">Re-Type New Password</label>
                        <input type="password" class="form-control" id="re_new_password" name="re_new_password" autocomplete="new-password" required />
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>