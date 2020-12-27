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
$route['signup_user']        = 'UserLoginController/signup';
$route['signup_user/(:any)'] = 'UserLoginController/signup/$1';
$route['auth_user']          = 'UserLoginController/auth';
$route['register_user']      = 'UserLoginController/signup';
$route['logout_user']        = 'UserLoginController/logout';
$route['profile']            = 'UserLoginController/profile';
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
##############################################################################################################

##############################################################################################################
# GRAND LINE
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