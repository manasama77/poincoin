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
        $lq = $this->db->last_query();
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
            $row['stacking_invest'] = number_format($field->stacking_invest, 4);
            $row['stacking_profit'] = number_format($field->stacking_profit, 4);
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
        $id           = $this->input->post('id');
        $new_password = password_hash($this->input->post('new_password') . UYAH, PASSWORD_BCRYPT);
        $code         = 500;

        if ($id) {
            $data  = ['password' => $new_password, 'updated_at' => date('Y-m-d H:i:s')];
            $where = ['id' => $id];
            $exec  = $this->mcore->update('users', $data, $where);

            if ($exec) {
                $code = 200;
            }
        }

        echo json_encode(['code' => $code]);
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
                $code = 200;
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
                $code = 200;
            }
        }

        echo json_encode(['code' => $code]);
    }
}
        
    /* End of file  AdminsUserController.php */
