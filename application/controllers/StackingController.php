<?php

defined('BASEPATH') or exit('No direct script access allowed');

class StackingController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('TemplateUser', NULL, 'template');
        $this->load->model('M_stacking');
    }

    public function index()
    {
        $id_user = $this->session->userdata(SESS . 'id');

        $data['title']   = 'Bioner Stacking';
        $data['content'] = 'stacking/index';
        $data['vitamin'] = 'stacking/index_vitamin';

        $arr_stacking = $this->mcore->get('bioner_stacking', '*', ['id_user' => $id_user], 'id', 'desc');

        $data['arr_stacking']       = $arr_stacking;
        $data['count_arr_stacking'] = $arr_stacking->num_rows();
        $data['bioner_profit']      = $this->M_stacking->count_bioner_profit($id_user)->row()->profit;
        $data['total_investment']   = $this->M_stacking->count_total_investment($id_user)->row()->total_investment;

        $this->template->template($data);
    }

    public function add()
    {
        $id_user          = $this->session->userdata(SESS . 'id');
        $total_investment = $this->input->post('total_investment');
        $total_transfer   = str_replace(',', '', $this->input->post('total_transfer'));
        $code             = 500;

        if ($total_investment > 0 && $total_transfer > 0) {
            $kode              = $this->_generate_kode_bioner_stacking($id_user);
            $profit_perhari_b  = ($total_investment * 0.5) / 100;
            $profit_perhari_rp = ($total_investment * 10000 * 0.5) / 100;
            $status            = 'menunggu_transfer';

            $data_stacking = [
                'kode'              => $kode,
                'id_user'           => $id_user,
                'total_investment'  => $total_investment,
                'total_transfer'    => $total_transfer,
                'profit_perhari_b'  => $profit_perhari_b,
                'profit_perhari_rp' => $profit_perhari_rp,
                'status'            => $status,
                'bukti_transfer'    => NULL,
                'created_at'        => date('Y-m-d'),
                'updated_at'        => date('Y-m-d'),
                'deleted_at'        => NULL,
            ];
            $exec = $this->mcore->store('bioner_stacking', $data_stacking);
            // $last_id = $this->db->insert_id();

            // $data_stacking_logs = [
            //     'id_user'            => $id_user,
            //     'id_bioner_stacking' => $last_id,
            //     'type'               => 'investment',
            //     'nominal_b'          => $total_investment,
            //     'nominal_rp'         => $total_transfer,
            //     'created_at'         => date('Y-m-d'),
            // ];
            // $exec_logs = $this->mcore->store('bioner_stacking_logs', $data_stacking_logs);

            // $exec_total_investment  = $this->M_stacking->update_total_investment($id_user, $total_investment);

            // $arr_user = $this->mcore->get('users', 'id_referal', ['id', $id_user]);

            // if ($jumlah_stack == 0) {
            //     if ($arr_user->row()->id_referal != NULL) {
            //         $total_profit_b_parent  = $total_investment * 10 / 100;
            //         $total_profit_rp_parent = $total_transfer * 10 / 100;
            //         $data_bonus_balance_logs = [
            //             'id_parent'                 => $arr_user->row()->id_referal,
            //             'id_child'                  => $id_user,
            //             'total_investment_b_child'  => $total_investment,
            //             'total_profit_b_parent'     => $total_profit_b_parent,
            //             'total_investment_rp_child' => $total_transfer,
            //             'total_profit_rp_parent'    => $total_profit_rp_parent,
            //             'created_at'                => date('Y-m-d'),
            //         ];
            //         $exec_bonus_balance_logs = $this->mcore->store('bonus_balance_logs', $data_bonus_balance_logs);

            //         $exec_bonus_balance  = $this->M_stacking->update_bonus_balance($arr_user->row()->id_referal, $total_profit_b_parent);
            //     }
            // }

            $code = 200;
        }

        echo json_encode(['code' => $code]);
    }

    public function _generate_kode_bioner_stacking($id_user)
    {
        # format ID.DDMMYY.##
        $arr_unik = $this->M_stacking->count_today_stack();
        $unik = $arr_unik->num_rows() + 1;
        $kode = $id_user . "." . date('d') . "" . date("m") . "" . date("y") . "" . $unik;
        return $kode;
    }

    public function stacking_upload_bukti_transfer()
    {
        $id_bioner_stacking   = $this->input->post('id_bioner_stacking');

        $config['upload_path']      = './public/img/bukti_transfer/';
        $config['allowed_types']    = 'gif|jpg|png|jpeg';
        $config['overwrite']        = FALSE;
        $config['file_ext_tolower'] = TRUE;
        $config['file_name']        = date('Y-m-d_H_i_s');

        $this->load->library('upload', $config);

        $code = 500;
        $msg = '';
        if ($this->upload->do_upload('bukti_transfer')) {
            $gambar_name = $this->upload->data('file_name');

            $data_upload = ['status' => 'menunggu_verifikasi', 'bukti_transfer' => $gambar_name];
            $where_upload = ['kode' => $id_bioner_stacking];
            $exec = $this->mcore->update('bioner_stacking', $data_upload, $where_upload);

            if ($exec) {
                $code = 200;
                $msg = 'Upload Berhasil';
            } else {
                $code = 501;
                $msg = 'Upload Gagal';
            }
        } else {
            $msg = $this->upload->display_errors();
        }

        echo json_encode(['code' => $code, 'msg' => $msg]);
    }

    public function withdraw()
    {
        $id_user = $this->session->userdata(SESS . 'id');

        $data['title']   = 'Bioner Stacking';
        $data['content'] = 'stacking_withdraw/index';
        $data['vitamin'] = 'stacking_withdraw/index_vitamin';

        $arr_stacking = $this->mcore->get('bioner_stacking', '*', ['id_user' => $id_user], 'id', 'desc');

        $data['arr_stacking']       = $arr_stacking;
        $data['count_arr_stacking'] = $arr_stacking->num_rows();
        $data['bioner_profit']      = $this->M_stacking->count_bioner_profit($id_user)->row()->profit;
        $data['total_investment']   = $this->M_stacking->count_total_investment($id_user)->row()->total_investment;
        $data['arr_rekening']       = $this->M_stacking->get_user_rekeing();

        $this->template->template($data);
    }
}
        
    /* End of file  StackingController.php */
