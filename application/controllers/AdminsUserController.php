<?php

defined('BASEPATH') or exit('No direct script access allowed');

class AdminsUserController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('TemplateAdmin', NULL, 'template');
        $this->load->model('M_users_less', 'mless');
    }

    public function index()
    {
        $data['title']    = 'User Management';
        $data['content']  = 'users/index';
        $data['vitamin']  = 'users/index_vitamin';
        $data['arr_bank'] = $this->mcore->get('param_banks', '*', null);
        $this->template->template($data);
    }

    public function datatables()
    {
        $list = $this->mless->get_datatables();
        $lq   = $this->db->last_query();
        $data = array();
        $no   = $_POST['start'];
        foreach ($list as $field) {
            $no++;
            $row = array();

            $row['id']              = $field->id;
            $row['nama']            = $field->nama;
            $row['email']           = $field->email;
            $row['no_hp']           = $field->no_hp;
            $row['no_rekening']     = $field->no_rekening;
            $row['no_wallet']       = $field->no_wallet;
            $row['profit_stacking'] = $field->profit_stacking;
            $row['profit_trade']    = $field->profit_trade;
            $row['stacking_invest'] = number_format($field->stacking_invest, 4, '.', ',');
            $row['stacking_profit'] = number_format($field->stacking_profit, 4, '.', ',');
            $row['trade_saldo']     = number_format($field->trade_saldo, 0);
            $row['trade_hi']        = number_format($field->trade_hi, 0);
            $data[]                 = $row;
        }

        $output = array(
            "draw"            => $_POST['draw'],
            "recordsTotal"    => $this->mless->count_all(),
            "recordsFiltered" => $this->mless->count_filtered(),
            "data"            => $data,
            "lq"            => $lq,
        );

        echo json_encode($output);
    }

    public function user_reset_email()
    {
        $id        = $this->input->post('id');
        $new_email = $this->input->post('new_email');
        $count     = $this->mcore->count('users', ['email' => $new_email]);
        $code      = 500;

        if ($id) {
            if ($count > 0) {
                $code = 404;
            } elseif ($count == 0) {
                $data  = ['email' => $new_email, 'updated_at' => date('Y-m-d H:i:s')];
                $where = ['id' => $id];
                $exec  = $this->mcore->update('users', $data, $where);

                if ($exec) {
                    $code = 200;
                }
            }
        }

        echo json_encode(['code' => $code, 'count' => $count]);
    }

    public function user_reset_password()
    {
        $id             = $this->input->post('id');
        $where          = ['id' => $id];
        $password_polos = $this->input->post('new_password');
        $new_password   = password_hash($this->input->post('new_password') . UYAH, PASSWORD_BCRYPT);
        $code           = 500;
        $email          = "";

        if ($id) {
            $data  = ['password' => $new_password, 'updated_at' => date('Y-m-d H:i:s')];
            $exec  = $this->mcore->update('users', $data, $where);

            if ($exec) {
                $code  = 200;
                $email = $this->mcore->get('users', '*', $where)->row()->email;
                $this->email_reset_pass($id, $email, $password_polos);
            }
        }

        echo json_encode(['code' => $code, 'email' => $email]);
    }

    public function user_reset_pin()
    {
        $id      = $this->input->post('id');
        $new_pin = $this->input->post('new_pin');
        $code    = 500;

        if ($id) {
            $data  = ['pin' => $new_pin, 'updated_at' => date('Y-m-d H:i:s')];
            $where = ['id' => $id];
            $exec  = $this->mcore->update('users', $data, $where);

            if ($exec) {
                $code = 200;
                $email = $this->mcore->get('users', '*', $where)->row()->email;
                $this->email_reset_pin($id, $email, $new_pin);
            }
        }

        echo json_encode(['code' => $code]);
    }

    public function user_reset_rekening()
    {
        $id_user_rekening_edit = $this->input->post('id_user_rekening_edit');
        $id_bank_edit          = $this->input->post('id_bank_edit');
        $no_rekening_edit      = $this->input->post('no_rekening_edit');
        $atas_nama_edit        = $this->input->post('atas_nama_edit');
        $code    = 500;

        if ($id_user_rekening_edit) {
            $data  = ['id_bank' => $id_bank_edit, 'no_rekening' => $no_rekening_edit, 'atas_nama' => $atas_nama_edit, 'updated_at' => date('Y-m-d H:i:s')];
            $where = ['id_user' => $id_user_rekening_edit];
            $exec  = $this->mcore->update('user_banks', $data, $where);

            if ($exec) {
                $code         = 200;
                $where        = ['id' => $id_user_rekening_edit];
                $email        = $this->mcore->get('users', '*', $where)->row()->email;
                $arr_rekening = $this->mless->get_user_bank_data($id_user_rekening_edit);
                $no_rekening  = $arr_rekening->row()->no_rekening;
                $nama_bank    = $arr_rekening->row()->nama_bank;
                $atas_nama    = $arr_rekening->row()->atas_nama;
                $this->email_reset_rekening($id_user_rekening_edit, $email, $no_rekening, $nama_bank, $atas_nama);
            }
        }

        echo json_encode(['code' => $code]);
    }

    public function user_reset_wallet()
    {
        $id_user_wallet_edit = $this->input->post('id_user_wallet_edit');
        $no_wallet_edit      = $this->input->post('no_wallet_edit');
        $code    = 500;

        if ($id_user_wallet_edit) {

            $count_user = $this->mcore->count('user_wallets', ['id_user' => $id_user_wallet_edit]);

            if ($count_user > 0) {
                $data  = ['no_wallet' => $no_wallet_edit, 'updated_at' => date('Y-m-d H:i:s')];
                $where = ['id_user' => $id_user_wallet_edit];
                $exec  = $this->mcore->update('user_wallets', $data, $where);
            } else {
                $data  = ['id_user' => $id_user_wallet_edit, 'no_wallet' => $no_wallet_edit, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')];
                $exec  = $this->mcore->store('user_wallets', $data);
            }

            if ($exec) {
                $code       = 200;
                $where      = ['id' => $id_user_wallet_edit];
                $email      = $this->mcore->get('users', '*', $where)->row()->email;
                $no_wallet  = $no_wallet_edit;
                $this->email_reset_wallet($id_user_wallet_edit, $email, $no_wallet);
            }
        }

        echo json_encode(['code' => $code]);
    }

    public function user_delete()
    {
        $id_user = $this->input->post('id_user');
        $code    = 500;

        if ($id_user) {
            $data  = ['deleted_at' => date('Y-m-d H:i:s')];
            $where = ['id' => $id_user];
            $exec  = $this->mcore->update('users', $data, $where);

            if ($exec) {
                $code  = 200;
                $email = $this->mcore->get('users', '*', $where)->row()->email;
                $this->email_delete_user($id_user, $email);
            }
        }

        echo json_encode(['code' => $code, 'email' => $email]);
    }

    public function email_reset_pass($id, $email, $password)
    {
        $title            = "POINCOIN ACCOUNT - RESET PASSWORD";
        $data['title']    = $title;
        $data['password'] = $password;
        $template_email   = $this->load->view('email_reset_password', $data, TRUE);

        $this->email->from('system@bioner.online', 'System Poincoin');
        $this->email->to($email);
        $this->email->subject($title);
        $this->email->message($template_email);
        $this->email->set_mailtype('html');
        $this->email->send();
        $log_email = $this->email->print_debugger();

        $data_log_email = [
            'id_user'    => $id,
            'log'        => $log_email,
            'created_at' => date('Y-m-d H:i:s'),
        ];
        $this->mcore->store('log_email_signup', $data_log_email);
    }

    public function email_reset_pin($id, $email, $pin)
    {
        $title          = "POINCOIN ACCOUNT - RESET PIN TRANSACTION";
        $data['title']  = $title;
        $data['pin']    = $pin;
        $template_email = $this->load->view('email_reset_pin', $data, TRUE);

        $this->email->from('system@bioner.online', 'System Poincoin');
        $this->email->to($email);
        $this->email->subject($title);
        $this->email->message($template_email);
        $this->email->set_mailtype('html');
        $this->email->send();
        $log_email = $this->email->print_debugger();

        $data_log_email = [
            'id_user'    => $id,
            'log'        => $log_email,
            'created_at' => date('Y-m-d H:i:s'),
        ];
        $this->mcore->store('log_email_signup', $data_log_email);
    }

    public function email_reset_rekening($id, $email, $no_rekening, $nama_bank, $atas_nama)
    {
        $title               = "POINCOIN ACCOUNT - ACCOUNT NUMBER";
        $data['title']       = $title;
        $data['no_rekening'] = $no_rekening;
        $data['nama_bank']   = $nama_bank;
        $data['atas_nama']   = $atas_nama;
        $template_email      = $this->load->view('email_reset_rekening', $data, TRUE);

        $this->email->from('system@bioner.online', 'System Poincoin');
        $this->email->to($email);
        $this->email->subject($title);
        $this->email->message($template_email);
        $this->email->set_mailtype('html');
        $this->email->send();
        $log_email = $this->email->print_debugger();

        $data_log_email = [
            'id_user'    => $id,
            'log'        => $log_email,
            'created_at' => date('Y-m-d H:i:s'),
        ];
        $this->mcore->store('log_email_signup', $data_log_email);
    }

    public function email_reset_wallet($id, $email, $no_wallet)
    {
        $title             = "POINCOIN ACCOUNT - TRONLINK ADDRESS";
        $data['title']     = $title;
        $data['no_wallet'] = $no_wallet;
        $template_email    = $this->load->view('email_reset_wallet', $data, TRUE);

        $this->email->from('system@bioner.online', 'System Poincoin');
        $this->email->to($email);
        $this->email->subject($title);
        $this->email->message($template_email);
        $this->email->set_mailtype('html');
        $this->email->send();
        $log_email = $this->email->print_debugger();

        $data_log_email = [
            'id_user'    => $id,
            'log'        => $log_email,
            'created_at' => date('Y-m-d H:i:s'),
        ];
        $this->mcore->store('log_email_signup', $data_log_email);
    }

    public function email_delete_user($id, $email)
    {
        $title               = "POINCOIN ACCOUNT - ACCOUNT DELETED";
        $data['title']       = $title;
        $template_email      = $this->load->view('email_delete_user', $data, TRUE);

        $this->email->from('system@bioner.online', 'System Poincoin');
        $this->email->to($email);
        $this->email->subject($title);
        $this->email->message($template_email);
        $this->email->set_mailtype('html');
        $this->email->send();
        $log_email = $this->email->print_debugger();

        $data_log_email = [
            'id_user'    => $id,
            'log'        => $log_email,
            'created_at' => date('Y-m-d H:i:s'),
        ];
        $this->mcore->store('log_email_signup', $data_log_email);
    }

    public function user_profit_stacking_update()
    {
        $id_user = $this->input->post('id_user');
        $status  = $this->input->post('status');

        $table  = 'users';
        $object = ['profit_stacking' => $status];
        $where  = ['id' => $id_user];
        $exec   = $this->mcore->update($table, $object, $where);

        $code = 500;
        if ($exec) {
            $code = 200;
        }

        echo json_encode(['code' => $code]);
    }

    public function user_profit_trade_update()
    {
        $id_user = $this->input->post('id_user');
        $status  = $this->input->post('status');

        $table  = 'users';
        $object = ['profit_trade' => $status];
        $where  = ['id' => $id_user];
        $exec   = $this->mcore->update($table, $object, $where);

        $code = 500;
        if ($exec) {
            $code = 200;
        }

        echo json_encode(['code' => $code]);
    }
}
        
    /* End of file  AdminsUserController.php */
