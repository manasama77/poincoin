<?php

defined('BASEPATH') or exit('No direct script access allowed');

class StackingAdminController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('TemplateAdmin', NULL, 'template');
        $this->load->model('M_stacking');
    }

    public function index()
    {
        $data['title']   = 'List Bioner Stacking';
        $data['content'] = 'stacking/index';
        $data['vitamin'] = 'stacking/index_vitamin';

        $data['arr_stacking'] = $this->M_stacking->list_bioner_stacking();

        $this->template->template($data);
    }

    public function verifikasi_transfer()
    {
        $id    = $this->input->post('id');
        $data  = ['status' => 'aktif', 'updated_at' => date('Y-m-d H:i:s')];
        $where = ['id' => $id];
        $exec  = $this->mcore->update('bioner_stacking', $data, $where);
        $code  = 500;

        if ($exec) {
            $where_x                    = ['id' => $id];
            $arr                        = $this->mcore->get('bioner_stacking', 'id_user, total_investment', $where_x);

            $id_user                    = $arr->row()->id_user;
            $total_investment           = $arr->row()->total_investment;
            $exec_users_bioner_stacking = $this->M_stacking->update_total_investment($id_user, $total_investment);

            if ($exec_users_bioner_stacking) {
                $data_logs = [
                    'id_user' => $id_user,
                    'id_bioner_stacking' => $id,
                    'type' => 'investment',
                    'nominal_b' => $total_investment,
                    'nominal_rp' => $total_investment * 15000,
                    'created_at' => date('Y-m-d H:i:s'),
                ];
                $exec_logs = $this->mcore->store('bioner_stacking_logs', $data_logs);

                if ($exec_logs) {
                    $code = 200;
                } else {
                    $code = 500;
                }
            } else {
                $code = 500;
            }
        }

        echo json_encode(['code' => $code]);
    }
}
        
    /* End of file  StackingAdminController.php */
