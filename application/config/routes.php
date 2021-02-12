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
$route['login_user']           = 'UserLoginController/index';
$route['signup_user']          = 'UserLoginController/signup';
$route['signup_user/(:any)']   = 'UserLoginController/signup/$1';
$route['auth_user']            = 'UserLoginController/auth';
$route['register_user']        = 'UserLoginController/signup';
$route['logout_user']          = 'UserLoginController/logout';
$route['change_password_user'] = 'UserLoginController/change_password';
$route['profile']              = 'UserLoginController/profile';
$route['store_rekening']       = 'UserLoginController/store_rekening';
$route['store_wallet']         = 'UserLoginController/store_wallet';
$route['update_rekening']      = 'UserLoginController/update_rekening';
$route['update_wallet']        = 'UserLoginController/update_wallet';
$route['destroy_rekening']     = 'UserLoginController/destroy_rekening';
$route['destroy_wallet']       = 'UserLoginController/destroy_wallet';

$route['signup_email/(:num)/(:any)'] = 'UserLoginController/signup_email/$1/$2';
##############################################################################################################

##############################################################################################################
# INDODAX USER
##############################################################################################################
$route['indodax_setup'] = 'IndodaxController/setup';
##############################################################################################################


##############################################################################################################
# DASHBOARD USER
##############################################################################################################
$route['dashboard_user'] = 'DashboardUserController/index';
$route['get_market_idr'] = 'DashboardUserController/get_market_idr';
##############################################################################################################

##############################################################################################################
# BIONER STACKING USER
##############################################################################################################
$route['stacking']                       = 'StackingController/index';
$route['stacking_add']                   = 'StackingController/add';
$route['stacking_upload_bukti_transfer'] = 'StackingController/stacking_upload_bukti_transfer';
$route['stacking_withdraw']              = 'StackingController/withdraw';
$route['stacking_withdraw_process']      = 'StackingController/withdraw_process';
$route['stacking_withdraw_delete']       = 'StackingController/withdraw_delete';
##############################################################################################################

##############################################################################################################
# BIONER TRADE USER
##############################################################################################################
$route['trade']                       = 'TradeController/index';
$route['trade_add']                   = 'TradeController/add';
$route['trade_upload_bukti_transfer'] = 'TradeController/trade_upload_bukti_transfer';
$route['trade_withdraw']              = 'TradeController/withdraw';
$route['trade_withdraw_process']      = 'TradeController/withdraw_process';
$route['trade_withdraw_delete']       = 'TradeController/withdraw_delete';
##############################################################################################################

##############################################################################################################
# BIONER EXCHANGE USER
##############################################################################################################
$route['exchange'] = 'ExchangeController/index';
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
$route['admin/bioner_stacking/add']                 = 'StackingAdminController/add';
$route['admin/bioner_stacking/count']               = 'StackingAdminController/count';
$route['admin/bioner_stacking/store']               = 'StackingAdminController/store';
$route['admin/bioner_stacking/verifikasi_transfer'] = 'StackingAdminController/verifikasi_transfer';
$route['admin/bioner_stacking/delete_stacking']     = 'StackingAdminController/delete_stacking';
$route['admin/bioner_stacking_withdraw/pending']    = 'StackingAdminController/withdraw_pending';
$route['admin/bioner_stacking_withdraw/verifikasi'] = 'StackingAdminController/withdraw_verifikasi';
$route['admin/bioner_stacking_withdraw/delete']     = 'StackingAdminController/withdraw_delete';
$route['admin/bioner_stacking_withdraw/success']    = 'StackingAdminController/withdraw_success';
##############################################################################################################

##############################################################################################################
# BIONER TRADE ADMIN
$route['admin/bioner_trade/index']               = 'TradeAdminController/index';
$route['admin/bioner_trade/verifikasi_transfer'] = 'TradeAdminController/verifikasi_transfer';
$route['admin/bioner_trade/delete_trade']        = 'TradeAdminController/delete_trade';
$route['admin/bioner_trade_withdraw/pending']    = 'TradeAdminController/withdraw_pending';
$route['admin/bioner_trade_withdraw/verifikasi'] = 'TradeAdminController/withdraw_verifikasi';
$route['admin/bioner_trade_withdraw/delete']     = 'TradeAdminController/withdraw_delete';
$route['admin/bioner_trade_withdraw/success']    = 'TradeAdminController/withdraw_success';
##############################################################################################################


##############################################################################################################
# ADMINS
$route['admins']            = 'AdminsController/index';
$route['admins/reset']      = 'AdminsController/reset';
$route['admins/destroy']    = 'AdminsController/destroy';
$route['datatables/admins'] = 'AdminsController/datatables';

# NEWS
$route['admins/news']               = 'AdminsNewsController/index';
$route['admins/news/update']        = 'AdminsNewsController/update';
$route['admins/news/destroy']       = 'AdminsNewsController/destroy';
$route['admins/news/change_status'] = 'AdminsNewsController/change_status';
$route['datatables/news']           = 'AdminsNewsController/datatables';

# USERS
$route['admins/user_management']     = 'AdminsUserController/index';
$route['admins/user_datatables']     = 'AdminsUserController/datatables';
$route['admins/user_reset_email']    = 'AdminsUserController/user_reset_email';
$route['admins/user_reset_password'] = 'AdminsUserController/user_reset_password';
$route['admins/user_reset_pin']      = 'AdminsUserController/user_reset_pin';
$route['admins/user_reset_rekening'] = 'AdminsUserController/user_reset_rekening';
$route['admins/user_delete']         = 'AdminsUserController/user_delete';

# UTILITY
$route['init']               = 'InitController/init_admins';
$route['api/get_idr_market'] = 'InitController/get_idr_market';

$route['distribusi_bioner_stacking/(:any)/(:any)'] = 'InitController/distribusi_bioner_stacking/$1/$2';
$route['distribusi_bioner_trade/(:any)/(:any)']    = 'InitController/distribusi_bioner_trade/$1/$2';

// $route['test/(:any)/(:any)'] = 'InitController/test/$1/$2';
$route['test'] = 'InitController/test';
##############################################################################################################