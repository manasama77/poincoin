<?php
defined('BASEPATH') or exit('No direct script access allowed');
##############################################################################################################
# RESERVED ROUTES
$route['default_controller']   = 'UserLoginController/index';
$route['404_override']         = 'My404';
$route['translate_uri_dashes'] = FALSE;
##############################################################################################################

##############################################################################################################
# LOGIN USER
##############################################################################################################
$route['login_user']        = 'UserLoginController/index';
$route['signup_user']        = 'UserLoginController/signup';
$route['signup_user/(:any)'] = 'UserLoginController/signup/$1';
$route['auth_user']          = 'UserLoginController/auth';
$route['register_user']      = 'UserLoginController/signup';
$route['logout_user']        = 'UserLoginController/logout';
$route['change_password_user']            = 'UserLoginController/change_password';
$route['profile']            = 'UserLoginController/profile';
$route['store_rekening']            = 'UserLoginController/store_rekening';
$route['update_rekening']            = 'UserLoginController/update_rekening';
$route['destroy_rekening']            = 'UserLoginController/destroy_rekening';
##############################################################################################################

##############################################################################################################
# DASHBOARD USER
##############################################################################################################
$route['dashboard_user']   = 'DashboardUserController/index';
##############################################################################################################

##############################################################################################################
# BIONER STACKING USER
##############################################################################################################
$route['stacking']                       = 'StackingController/index';
$route['stacking_add']                   = 'StackingController/add';
$route['stacking_upload_bukti_transfer'] = 'StackingController/stacking_upload_bukti_transfer';
$route['stacking_withdraw']              = 'StackingController/withdraw';
$route['stacking_withdraw_process']              = 'StackingController/withdraw_process';
$route['stacking_withdraw_delete']              = 'StackingController/withdraw_delete';
##############################################################################################################

##############################################################################################################
# GRAND LINE #################################################################################################
##############################################################################################################

##############################################################################################################
# ADMIN
$route['login']           = 'LoginController/index';
$route['logout']          = 'LoginController/logout';
$route['change_password'] = 'LoginController/change_password';
##############################################################################################################


##############################################################################################################
# DASHBOARD
$route['dashboard'] = 'DashboardController/index';
##############################################################################################################


##############################################################################################################
# BIONER STACKING ADMIN
$route['admin/bioner_stacking/index']               = 'StackingAdminController/index';
$route['admin/bioner_stacking/verifikasi_transfer'] = 'StackingAdminController/verifikasi_transfer';
$route['admin/bioner_stacking/delete_stacking'] = 'StackingAdminController/delete_stacking';
$route['admin/bioner_stacking_withdraw/pending']               = 'StackingAdminController/withdraw_pending';
$route['admin/bioner_stacking_withdraw/verifikasi']               = 'StackingAdminController/withdraw_verifikasi';
$route['admin/bioner_stacking_withdraw/delete']               = 'StackingAdminController/withdraw_delete';
$route['admin/bioner_stacking_withdraw/success']               = 'StackingAdminController/withdraw_success';
##############################################################################################################

##############################################################################################################
# ADMINS
$route['admins']            = 'AdminsController/index';
$route['admins/reset']      = 'AdminsController/reset';
$route['admins/destroy']    = 'AdminsController/destroy';
$route['datatables/admins'] = 'AdminsController/datatables';


# UTILITY
$route['init']                       = 'InitController/init_admins';
$route['distribusi_bioner_stacking'] = 'InitController/distribusi_bioner_stacking';
##############################################################################################################