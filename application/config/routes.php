<?php
defined('BASEPATH') or exit('No direct script access allowed');
##############################################################################################################
# RESERVED ROUTES
$route['default_controller']   = 'UserLoginController/index';
$route['404_override']         = 'My404';
$route['translate_uri_dashes'] = FALSE;
##############################################################################################################


##############################################################################################################
# AUTH
$route['login']           = 'LoginController/index';
$route['logout']          = 'LoginController/logout';
$route['change_password'] = 'LoginController/change_password';
##############################################################################################################


##############################################################################################################
# DASHBOARD
$route['dashboard'] = 'DashboardController/index';
##############################################################################################################


##############################################################################################################
# PENGAJUAN
$route['pengajuan']             = 'PengajuanController/index';
$route['pengajuan/create']      = 'PengajuanController/create';
$route['pengajuan/store']       = 'PengajuanController/store';
$route['pengajuan/edit/(:num)'] = 'PengajuanController/edit/$1';
$route['pengajuan/update']      = 'PengajuanController/update';
$route['pengajuan/destroy']     = 'PengajuanController/destroy';
$route['pengajuan/show_barang'] = 'PengajuanController/show_barang';
$route['datatables/pengajuan']  = 'PengajuanController/datatables';

# VERIFIKASI PENGAJUAN
$route['verifikasi_pengajuan']            = 'VerifikasiPengajuanController/index';
$route['datatables/verifikasi_pengajuan'] = 'VerifikasiPengajuanController/datatables';
##############################################################################################################

##############################################################################################################
# BARANG
$route['barang']                                    = 'BarangController/index';
$route['barang/show']                               = 'BarangController/show';
$route['barang/store']                              = 'BarangController/store';
$route['barang/update']                             = 'BarangController/update';
$route['barang/destroy']                            = 'BarangController/destroy';
$route['barang/get_list_barang_by_id_jenis_barang'] = 'BarangController/get_list_barang_by_id_jenis_barang';
$route['datatables/barang']                         = 'BarangController/datatables';

# VENDOR
$route['vendors']         = 'VendorController/index';
$route['vendors/show']    = 'VendorController/show';
$route['vendors/store']   = 'VendorController/store';
$route['vendors/update']  = 'VendorController/update';
$route['vendors/destroy'] = 'VendorController/destroy';

# JENIS BARANG
$route['jenis_barang']         = 'JenisBarangController/index';
$route['jenis_barang/show']    = 'JenisBarangController/show';
$route['jenis_barang/store']   = 'JenisBarangController/store';
$route['jenis_barang/update']  = 'JenisBarangController/update';
$route['jenis_barang/destroy'] = 'JenisBarangController/destroy';
##############################################################################################################

##############################################################################################################
# CUSTOMERS
$route['customers']             = 'CustomersController/index';
$route['customers/add']         = 'CustomersController/add';
$route['customers/store']       = 'CustomersController/store';
$route['customers/edit/(:num)'] = 'CustomersController/edit/$1';
$route['customers/update']      = 'CustomersController/update';
$route['customers/destroy']     = 'CustomersController/destroy';
$route['datatables/customers']  = 'CustomersController/datatables';

# PEKERJAANS
$route['pekerjaans']         = 'PekerjaansController/index';
$route['pekerjaans/store']   = 'PekerjaansController/store';
$route['pekerjaans/update']  = 'PekerjaansController/update';
$route['pekerjaans/destroy'] = 'PekerjaansController/destroy';
##############################################################################################################

##############################################################################################################
# ADMINS
$route['admins']            = 'AdminsController/index';
$route['admins/reset']      = 'AdminsController/reset';
$route['admins/destroy']    = 'AdminsController/destroy';
$route['datatables/admins'] = 'AdminsController/datatables';


# UTILITY
$route['init']   = 'InitController/init_admins';
##############################################################################################################