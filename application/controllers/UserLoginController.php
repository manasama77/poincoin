<?php

defined('BASEPATH') or exit('No direct script access allowed');

class UserLoginController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(['cookie', 'string']);
        $this->load->library('TemplateUser', NULL, 'template');
        $this->load->model('M_users');
        $this->load->model('M_stacking');
    }

    public function index()
    {
        // echo password_hash("adam" . UYAH, PASSWORD_BCRYPT);
        // exit;
        $cookies = get_cookie(COOK);

        if ($cookies != NULL) {
            $check_cookies = $this->mcore->get('users', '*', ['cookies' => $cookies]);

            if ($check_cookies->num_rows() == 1) {
                $id    = $check_cookies->row()->id;
                $nama  = $check_cookies->row()->nama;
                $no_hp = $check_cookies->row()->no_hp;
                $email = $check_cookies->row()->email;
                $pin   = $check_cookies->row()->pin;

                $this->_set_session($id, $nama, $no_hp, $email, $pin);
                $this->session->set_flashdata('first_login', 'Login Berhasil, pastikan kamu menjaga Password Kamu');
                redirect(site_url() . 'dashboard_user');
            } else {
                delete_cookie(COOK);
                $this->session->set_flashdata('expired', 'Sesi Berakhir');
                redirect(site_url('member/signin'));
            }
        } else {
            $this->form_validation->set_rules('email', 'Email', 'callback_email_check');
            $this->form_validation->set_rules('password', 'Password', 'callback_password_check');

            if ($this->form_validation->run() === FALSE) {
                $this->load->view('login_user');
            } else {
                $email = $this->input->post('email');

                $where = [
                    'email'      => $email,
                    'status'     => 'aktif',
                    'deleted_at' => NULL
                ];
                $arr = $this->mcore->get('users', '*', $where);

                if ($arr->num_rows() == 1) {

                    $id    = $arr->row()->id;
                    $nama  = $arr->row()->nama;
                    $no_hp = $arr->row()->no_hp;
                    $email = $arr->row()->email;
                    $pin   = $arr->row()->pin;
                    $this->_set_session($id, $nama, $no_hp, $email, $pin);

                    $remember = $this->input->post('remember');
                    if ($remember == 'on') {
                        $key_cookies = random_string('alnum', 64);
                        set_cookie(COOK, $key_cookies, 3600 * 24 * 30);
                        $this->mcore->update('users', [
                            'cookies'    => $key_cookies,
                            'remember'   => '1',
                            'updated_at' => date('Y-m-d H:i:s'),
                        ], ['id' => $id]);
                    } else {
                        $this->mcore->update('users', [
                            'remember'   => '0',
                            'updated_at' => date('Y-m-d H:i:s')
                        ], ['id' => $id]);
                    }

                    $this->session->set_flashdata('first_login', 'Login Berhasil, pastikan kamu menjaga Password Kamu');
                    redirect(site_url('dashboard_user'));
                } else {
                    delete_cookie(COOK);
                    $this->session->set_flashdata('unknown', 'Email tidak ditemukan');
                    redirect(site_url('member/signin'));
                }
            }
        }
    }

    public function email_precheck($str)
    {
        $email = strtolower(trim($str));

        $where = ['email' => $email, 'deleted_at' => NULL];
        $count = $this->mcore->count('users', $where);

        if ($count == 0) {
            return TRUE;
        } else {
            $this->form_validation->set_message('email_check', 'Email Salah atau telah terdaftar, silahkan cek kembali');
            return FALSE;
        }
    }

    public function email_check($str)
    {
        $email = strtolower(trim($str));

        $where = ['email' => $email, 'deleted_at' => NULL];
        $count = $this->mcore->count('users', $where);

        if ($count == 1) {
            return TRUE;
        } else {
            $this->form_validation->set_message('email_check', 'Email Salah atau tidak terdaftar, silahkan cek kembali');
            return FALSE;
        }
    }

    public function password_check($str)
    {
        $email    = $this->input->post('email');
        $password = $str . UYAH;

        $where = [
            'email'   => $email,
            'status'     => 'aktif',
            'deleted_at' => NULL
        ];
        $arr = $this->mcore->get('users', '*', $where);

        if ($arr->num_rows() == 1) {
            $db_pass  = $arr->row()->password;

            if (password_verify($password, $db_pass)) {
                return TRUE;
            }

            $this->form_validation->set_message('password_check', 'Password Salah, silahkan cek kembali');
            return FALSE;
        }

        $this->form_validation->set_message('password_check', 'Email tidak ditemukan, silahkan cek kembali');
        return FALSE;
    }

    public function _set_session($id, $nama, $no_hp, $email, $pin)
    {
        $this->session->set_userdata(SESS . 'id', $id);
        $this->session->set_userdata(SESS . 'nama', $nama);
        $this->session->set_userdata(SESS . 'email', $email);
        $this->session->set_userdata(SESS . 'no_hp', $no_hp);
        $this->session->set_userdata(SESS . 'pin', $pin);
    }

    public function logout()
    {
        delete_cookie(COOK);
        $this->session->unset_userdata(SESS . 'id');
        $this->session->unset_userdata(SESS . 'nama');
        $this->session->unset_userdata(SESS . 'email');
        $this->session->unset_userdata(SESS . 'no_hp');
        $this->session->unset_userdata(SESS . 'pin');
        $this->session->set_flashdata('logout', 'Logout Berhasil');
        redirect(site_url('member/signin'));
    }

    public function signup()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'callback_email_precheck');
        $this->form_validation->set_rules('no_hp', 'No Handphone', 'required|min_length[8]|max_length[20]|trim', [
            'requird'    => '{field} wajib diisi',
            'min_length' => '{field} minimal {param} karakter',
            'max_length' => '{field} maksimal {param} karakter',
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[6]|max_length[100]|trim', [
            'requird'    => '{field} wajib diisi',
            'min_length' => '{field} minimal {param} karakter',
            'max_length' => '{field} maksimal {param} karakter',
        ]);
        $this->form_validation->set_rules('re_password', 'Password Confirmation', 'required|matches[password]|min_length[6]|max_length[255]|trim', [
            'matches'    => 'Password & Password Confirmation tidak sama, silahkan cek kembali',
            'requird'    => '{field} wajib diisi',
            'min_length' => '{field} minimal {param} karakter',
            'max_length' => '{field} maksimal {param} karakter',
        ]);
        $this->form_validation->set_rules('pin', 'PIN Transaksi', 'required|trim|numeric|exact_length[6]', [
            'requird'      => '{field} wajib diisi',
            'exact_length' => '{field} harus {param} karakter',
            'numeric'      => '{field} hanya bisa diisi dengan angka',
        ]);
        $this->form_validation->set_rules('re_pin', 'PIN Transaksi Confirmation', 'required|matches[pin]|trim|numeric|exact_length[6]', [
            'matches'      => 'PIN & PIN Transaksi Confirmation tidak sama, silahkan cek kembali',
            'requird'      => '{field} wajib diisi',
            'exact_length' => '{field} harus {param} karakter',
            'numeric'      => '{field} hanya bisa diisi dengan angka',
        ]);
        $this->form_validation->set_rules('id_referal', 'Referal', 'callback_referal_reg_check');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('signup_user');
        } else {
            $nama           = trim($this->input->post('nama'));
            $email          = strtolower(trim($this->input->post('email')));
            $no_hp          = trim($this->input->post('no_hp'));
            $password_polos = trim($this->input->post('password'));
            $password       = password_hash(trim($this->input->post('password')) . UYAH, PASSWORD_BCRYPT);
            $id_referal     = $this->get_id_referal($this->input->post('id_referal'));
            $pin            = trim($this->input->post('pin'));

            $object = [
                'nama'            => $nama,
                'email'           => $email,
                'no_hp'           => $no_hp,
                'password'        => $password,
                'id_referal'      => ($id_referal != "") ? $id_referal : NULL,
                'status'          => 'aktif',
                'pin'             => $pin,
                'profit_stacking' => 'ya',
                'profit_trade'    => 'ya',
                'created_at'      => date('Y-m-d H:i:s'),
                'updated_at'      => date('Y-m-d H:i:s'),
                'deleted_at'      => NULL,
            ];
            $arr = $this->mcore->store('users', $object);
            $last_id = $this->db->insert_id();

            if (!$arr) {
                $this->session->set_flashdata('signup_error', 'Proses Sign Up Gagal, tidak terhubung dengan server silahkan cek koneksi kamu');
                redirect('member/signup');
            } else {
                $data = [
                    'id_user'          => $last_id,
                    'profit'           => 0,
                    'total_investment' => 0,
                    'created_at'       => date('Y-m-d H:i:s'),
                    'updated_at'       => date('Y-m-d H:i:s'),
                ];
                $this->mcore->store('users_bioner_stacking', $data);

                $data = [
                    'id_user'       => $last_id,
                    'balance_saldo' => 0,
                    'trigger_ask'   => 'tidak',
                    'created_at'    => date('Y-m-d H:i:s'),
                    'updated_at'    => date('Y-m-d H:i:s'),
                ];
                $this->mcore->store('users_bioner_trade', $data);
                $this->session->set_flashdata('signup_success', 'Proses Signup Berhasil, silahkan Login');
                $this->signup_email($last_id, urlencode($email), $password_polos);
                redirect('/member/signup');
            }
        }
    }

    public function referal_reg_check($str)
    {
        if ($str != '') {
            $where = [
                'id'   => strtolower(trim($str)),
                'status'     => 'aktif',
                'deleted_at' => NULL,
            ];
            $arr = $this->mcore->get('users', '*', $where);

            if ($arr->num_rows() == 0) {
                $this->form_validation->set_message('referal_reg_check', 'Referal tidak ditemukan, silahkan cek kembali');
                return FALSE;
            }
        }
        return TRUE;
    }

    public function get_id_referal($id)
    {
        $arr = $this->mcore->get('users', '*', ['id' => $id]);

        $id_referal = NULL;
        if ($arr->num_rows() == 1) {
            $id_referal = $arr->row()->id;
        }

        return $id_referal;
    }

    public function profile()
    {
        $id_user = $this->session->userdata(SESS . 'id');

        $data['title']   = 'Profile';
        $data['content'] = 'profile/index';
        $data['vitamin'] = 'profile/index_vitamin';

        $arr_users = $this->mcore->get('users', '*', ['id' => $id_user]);
        $arr_banks = $this->mcore->get('param_banks', '*', NULL, 'nama_bank', 'asc');
        $arr_user_banks = $this->M_users->get_user_bank_data();
        $arr_user_wallets = $this->mcore->get('user_wallets', '*', ['id_user' => $id_user, 'deleted_at' => NULL]);

        $data['arr_users']        = $arr_users;
        $data['arr_banks']        = $arr_banks;
        $data['arr_user_banks']   = $arr_user_banks;
        $data['arr_user_wallets'] = $arr_user_wallets;

        $this->template->template($data);
    }

    public function store_rekening()
    {
        $id_user = $this->session->userdata(SESS . 'id');
        $id_bank = $this->input->post('id_bank');
        $no_rekening = $this->input->post('no_rekening');
        $atas_nama = $this->input->post('atas_nama');

        $data = [
            'id_user' => $id_user,
            'no_rekening' => $no_rekening,
            'id_bank' => $id_bank,
            'atas_nama' => $atas_nama,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            'deleted_at' => NULL,
        ];

        $exec = $this->mcore->store('user_banks', $data);

        $code = 500;
        if ($exec) {
            $code = 200;
        }

        echo json_encode(['code' => $code]);
    }

    public function store_wallet()
    {
        $id_user = $this->session->userdata(SESS . 'id');
        $no_wallet = $this->input->post('no_wallet');

        $data = [
            'id_user' => $id_user,
            'no_wallet' => $no_wallet,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            'deleted_at' => NULL,
        ];

        $exec = $this->mcore->store('user_wallets', $data);

        $code = 500;
        if ($exec) {
            $code = 200;
        }

        echo json_encode(['code' => $code]);
    }

    public function update_rekening()
    {
        $id_user_banks = $this->input->post('id_user_banks_edit');
        $id_bank = $this->input->post('id_bank_edit');
        $no_rekening = $this->input->post('no_rekening_edit');
        $atas_nama = $this->input->post('atas_nama_edit');

        $data = [
            'no_rekening' => $no_rekening,
            'id_bank' => $id_bank,
            'atas_nama' => $atas_nama,
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        $where = ['id' => $id_user_banks];

        $exec = $this->mcore->update('user_banks', $data, $where);

        $code = 500;
        if ($exec) {
            $code = 200;
        }

        echo json_encode(['code' => $code]);
    }

    public function update_wallet()
    {
        $id_wallet_edit = $this->input->post('id_wallet_edit');
        $no_wallet = $this->input->post('no_wallet_edit');

        $data = [
            'no_wallet' => $no_wallet,
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        $where = ['id' => $id_wallet_edit];

        $exec = $this->mcore->update('user_wallets', $data, $where);

        $code = 500;
        if ($exec) {
            $code = 200;
        }

        echo json_encode(['code' => $code]);
    }

    public function destroy_rekening()
    {
        $id_user_banks = $this->input->post('id');

        $data = ['deleted_at' => date('Y-m-d H:i:s')];
        $where = ['id' => $id_user_banks];
        $exec = $this->mcore->update('user_banks', $data, $where);

        $code = 500;
        if ($exec) {
            $code = 200;
        }

        echo json_encode(['code' => $code]);
    }

    public function destroy_wallet()
    {
        $id = $this->input->post('id');

        $data = ['deleted_at' => date('Y-m-d H:i:s')];
        $where = ['id' => $id];
        $exec = $this->mcore->update('user_wallets', $data, $where);

        $code = 500;
        if ($exec) {
            $code = 200;
        }

        echo json_encode(['code' => $code]);
    }

    public function change_password()
    {
        $id_user = $this->session->userdata(SESS . 'id');

        $data['title']   = 'Change Password';
        $data['content'] = 'change_password/index';
        $data['vitamin'] = 'change_password/index_vitamin';

        $this->template->template($data);
    }

    public function signup_email($id, $email, $password_polos)
    {
        $email                  = urldecode($email);
        $data['arr']            = $this->mcore->get('users', '*', ['id' => $id]);
        $data['password_polos'] = $password_polos;
        $data['title']          = "BIONER SIGNUP INFORMATION";

        if ($data['arr']->num_rows() == 1) {
            $template_email = $this->load->view('email_signup', $data, TRUE);
            $this->email->from('system@bioner.online', 'System Bioner');
            $this->email->to($email);
            $this->email->subject('Bioner Signup Detail');
            $this->email->message($template_email);
            $this->email->set_mailtype('html');
            $this->email->send();
            $log_email = $this->email->print_debugger();

            $data_log_email = [
                'id_user'    => $id,
                'log'        => $log_email,
                'created_at' => date('Y-m-d H: i: s'),
            ];
            $this->mcore->store('log_email_signup', $data_log_email);
        }
    }

    public function no_js()
    {
        $this->load->view('no_js');
    }

    public function check_pin()
    {
        $id_user = trim($this->input->post('id_user'));
        $pin     = trim($this->input->post('pin'));
        $count   = $this->mcore->count('users', ['id' => $id_user, 'pin' => $pin]);

        if ($count == 0) {
            $code = 404;
        } else {
            $code = 200;
        }

        echo json_encode(['code' => $code, 'lq' => $this->db->last_query()]);
    }
}
        
    /* End of file  UserLoginController.php */
