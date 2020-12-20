<?php

defined('BASEPATH') or exit('No direct script access allowed');

class UserLoginController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(['cookie', 'string']);
    }

    public function index()
    {
        $cookies = get_cookie(COOK);

        if ($cookies != NULL) {
            $check_cookies = $this->mcore->get('users', '*', ['cookies' => $cookies]);

            if ($check_cookies->num_rows() == 1) {
                $id       = $check_cookies->row()->id;
                $nama     = $check_cookies->row()->nama;
                $email    = $check_cookies->row()->email;
                $username = $check_cookies->row()->username;

                $this->_set_session($id, $nama, $username, $email);
                $this->session->set_flashdata('first_login', 'Login Berhasil, pastikan kamu menjaga Password Kamu');
                redirect(site_url() . 'dashboard_user');
            } else {
                delete_cookie(COOK);
                $this->session->set_flashdata('expired', 'Sesi Berakhir');
                redirect(site_url());
            }
        } else {
            $this->form_validation->set_rules('username', 'Username', 'callback_username_check');
            $this->form_validation->set_rules('password', 'Password', 'callback_password_check');

            if ($this->form_validation->run() === FALSE) {
                $this->load->view('login_user');
            } else {
                $username = $this->input->post('username');

                $where = [
                    'username'   => $username,
                    'status'     => 'aktif',
                    'deleted_at' => NULL
                ];
                $arr = $this->mcore->get('users', '*', $where);

                if ($arr->num_rows() == 1) {

                    $id       = $arr->row()->id;
                    $nama     = $arr->row()->nama;
                    $email    = $arr->row()->email;
                    $username = $arr->row()->username;
                    $this->_set_session($id, $nama, $username, $email);

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
                    $this->session->set_flashdata('unknown', 'Username tidak ditemukan');
                    redirect(site_url());
                }
            }
        }
    }

    public function username_check($str)
    {
        $where = [
            'username'   => $str,
            'status'     => 'aktif',
            'deleted_at' => NULL,
        ];
        $arr = $this->mcore->get('users', '*', $where);

        if ($arr->num_rows() == 1) {
            return TRUE;
        }

        $this->form_validation->set_message('username_check', 'Username tidak ditemukan, silahkan cek kembali');
        return FALSE;
    }

    public function password_check($str)
    {
        $username    = $this->input->post('username');
        $password = $str . UYAH;

        $where = [
            'username'   => $username,
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

        $this->form_validation->set_message('password_check', 'Username tidak ditemukan, silahkan cek kembali');
        return FALSE;
    }

    public function _set_session($id, $nama, $username, $email)
    {
        $this->session->set_userdata(SESS . 'id', $id);
        $this->session->set_userdata(SESS . 'nama', $nama);
        $this->session->set_userdata(SESS . 'email', $email);
        $this->session->set_userdata(SESS . 'username', $username);
    }

    public function logout()
    {
        delete_cookie(COOK);
        $this->session->unset_userdata(SESS . 'id');
        $this->session->unset_userdata(SESS . 'nama');
        $this->session->unset_userdata(SESS . 'email');
        $this->session->unset_userdata(SESS . 'username');
        $this->session->set_flashdata('logout', 'Logout Berhasil');
        redirect(site_url());
    }

    public function signup()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('email', 'Email', 'callback_email_reg_check');
        $this->form_validation->set_rules('username', 'Username', 'callback_username_reg_check');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('re_password', 'Password Confirmation', 'required|matches[password]', [
            'matches' => 'Password & Password Confirmation tidak sama, silahkan cek kembali'
        ]);
        $this->form_validation->set_rules('id_referal', 'Referal', 'callback_referal_reg_check');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('signup_user');
        } else {
            $nama       = $this->input->post('nama');
            $email      = $this->input->post('email');
            $username   = $this->input->post('username');
            $password   = password_hash($this->input->post('password') . UYAH, PASSWORD_BCRYPT);
            $id_referal = $this->get_id_referal($this->input->post('id_referal'));

            $object = [
                'nama'             => $nama,
                'email'            => $email,
                'username'         => $username,
                'password'         => $password,
                'id_referal'       => ($id_referal != "") ? $id_referal : NULL,
                'status'           => 'aktif',
                'cash_balance'     => 0,
                'profit_balance'   => 0,
                'bonus_balance'    => 0,
                'total_investment' => 0,
                'created_at'       => date('Y-m-d H:i:s'),
                'updated_at'       => date('Y-m-d H:i:s'),
                'deleted_at'       => NULL,
            ];
            $arr = $this->mcore->store('users', $object);

            if (!$arr) {
                $this->session->set_flashdata('signup_error', 'Proses Sign Up Gagal, tidak terhubung dengan server silahkan coba kembali');
                redirect('signup');
            } else {
                $this->session->set_flashdata('signup_success', 'Proses Signup Berhasil, silahkan Login');
                redirect('/');
            }
        }
    }

    public function email_reg_check($str)
    {
        $where = [
            'email'      => $str,
            'status'     => 'aktif',
            'deleted_at' => NULL,
        ];
        $arr = $this->mcore->get('users', '*', $where);

        if ($arr->num_rows() > 0) {
            $this->form_validation->set_message('email_reg_check', 'Email telah terdaftar, silahkan gunakan email lain');
            return FALSE;
        }

        return TRUE;
    }

    public function username_reg_check($str)
    {
        $where = [
            'username'   => $str,
            'status'     => 'aktif',
            'deleted_at' => NULL,
        ];
        $arr = $this->mcore->get('users', '*', $where);

        if ($arr->num_rows() > 0) {
            $this->form_validation->set_message('username_reg_check', 'Username telah terdaftar, silahkan gunakan username lain');
            return FALSE;
        }

        return TRUE;
    }

    public function referal_reg_check($str)
    {
        if ($str != '') {
            $where = [
                'username'   => $str,
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

    public function get_id_referal($username)
    {
        $arr = $this->mcore->get('users', 'id', ['username' => $username]);

        $id_referal = NULL;
        if ($arr) {
            $id_referal = $arr->row()->id;
        }

        return $id_referal;
    }
}
        
    /* End of file  UserLoginController.php */
