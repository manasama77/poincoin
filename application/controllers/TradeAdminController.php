<?php

defined('BASEPATH') or exit('No direct script access allowed');

class TradeAdminController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('TemplateAdmin', NULL, 'template');
        $this->load->model('M_trade');
    }

    public function index()
    {
        $data['title']   = 'List Bioner Trade';
        $data['content'] = 'trade/index';
        $data['vitamin'] = 'trade/index_vitamin';

        $data['arr_trade'] = $this->M_trade->list_bioner_trade();

        $this->template->template($data);
    }

    public function verifikasi_transfer()
    {
        $id    = $this->input->post('id');
        $arr_cek = $this->mcore->get('bioner_trade', '*', ['id' => $id]);

        if (in_array($arr_cek->row()->status, ['pending', 'menunggu verifikasi'])) {

            $data  = ['status' => 'aktif', 'updated_at' => date('Y-m-d H:i:s')];
            $where = ['id' => $id];
            $exec  = $this->mcore->update('bioner_trade', $data, $where);
            $code  = 500;

            if ($exec) {
                $where_x                    = ['id' => $id];
                $arr                        = $this->mcore->get('bioner_trade', 'id_user, kode', $where_x);

                $id_user                    = $arr->row()->id_user;
                $kode                    = $arr->row()->kode;

                $data_logs = [
                    'id_user' => $id_user,
                    'id_bioner_trade' => $id,
                    'type' => 'investment',
                    'kode' => $kode,
                    'keterangan' => 'Pembukaan Bioner Trade ' . $kode . ' sebanyak 1 Lot',
                    'created_at' => date('Y-m-d H:i:s'),
                ];
                $exec_logs = $this->mcore->store('bioner_trade_logs', $data_logs);

                if ($exec_logs) {
                    $code = 200;
                } else {
                    $code = 500;
                }
            }
        } else {
            $code = 200;
        }

        echo json_encode(['code' => $code]);
    }

    public function delete_trade()
    {
        $id = $this->input->post('id');
        $code = 500;

        $arr_bioner_trade = $this->mcore->get('bioner_trade', 'id_user, kode', ['id' => $id]);

        if ($arr_bioner_trade->num_rows() == 1) {
            $id_user = $arr_bioner_trade->row()->id_user;
            $kode    = $arr_bioner_trade->row()->kode;

            $data_bioner_trade  = ['deleted_at' => date('Y-m-d H:i:s')];
            $where_bioner_trade = ['id' => $id];
            $exec_bioner_trade  = $this->mcore->update('bioner_trade', $data_bioner_trade, $where_bioner_trade);

            if ($exec_bioner_trade) {

                $data_logs = [
                    'id_user' => $id_user,
                    'id_bioner_trade' => $id,
                    'type' => 'delete investment',
                    'kode' => $kode,
                    'keterangan' => 'Investment ' . $kode . ' Dibatalkan',
                    'created_at' => date('Y-m-d H:i:s'),
                ];

                $exec_logs = $this->mcore->store('bioner_trade_logs', $data_logs);

                if ($exec_logs) {
                    $code = 200;
                }
            }
        }

        echo json_encode(['code' => $code]);
    }

    public function withdraw_pending()
    {
        $data['title']   = 'List Bioner Trade Withdraw - Pending';
        $data['content'] = 'trade_withdraw_pending/index';
        $data['vitamin'] = 'trade_withdraw_pending/index_vitamin';

        $data['arr_trade'] = $this->M_trade->list_bioner_trade_withdraw('pending');

        $this->template->template($data);
    }

    public function withdraw_verifikasi()
    {
        $this->db->trans_begin();

        $id = $this->input->post('id');
        $code = 500;

        $data_withdraw = [
            'status'     => 'success',
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        $where_withdraw = ['id' => $id];

        $exec = $this->mcore->update('user_bioner_trade_withdraw', $data_withdraw, $where_withdraw);

        if ($exec) {
            $code = 200;
            $this->db->trans_commit();
        } else {
            $this->db->trans_rollback();
        }

        echo json_encode(['code' => $code]);
    }

    public function withdraw_delete()
    {
        $this->db->trans_begin();

        $id           = $this->input->post('id');
        $code         = 500;
        $arr_withdraw = $this->mcore->get('user_bioner_trade_withdraw', '*', ['id' => $id, 'status' => 'pending', 'deleted_at' => NULL]);

        if ($arr_withdraw->num_rows() == 1) {
            $id_user       = $arr_withdraw->row()->id_user;
            $withdraw_rp   = $arr_withdraw->row()->withdraw_rp;
            $kode_withdraw = $arr_withdraw->row()->kode_withdraw;

            $data_withdraw  = ['deleted_at' => date('Y-m-d H:i:s')];
            $where_withdraw = ['id' => $id];
            $exec_withdraw  = $this->mcore->update('user_bioner_trade_withdraw', $data_withdraw, $where_withdraw);

            if ($exec_withdraw) {
                $exec_reduce_balance_saldo = $this->M_trade->update_balance_saldo($id_user, $withdraw_rp);
                if ($exec_reduce_balance_saldo) {
                    $data_logs = [
                        'id_user'         => $id_user,
                        'id_bioner_trade' => NULL,
                        'type'            => 'return withdraw',
                        'nominal_rp'      => $withdraw_rp,
                        'kode'            => $kode_withdraw,
                        'keterangan'      => 'Return Withdraw sebesar Rp.' . $withdraw_rp . ' to Balance Saldo - By Admin',
                        'created_at'      => date('Y-m-d H: i: s'),
                    ];
                    $exec_logs = $this->mcore->store('bioner_trade_logs', $data_logs);

                    if ($exec_logs) {
                        $code = 200;
                        $this->db->trans_commit();
                    } else {
                        $this->db->trans_rollback();
                    }
                } else {
                    $this->db->trans_rollback();
                }
            } else {
                $this->db->trans_rollback();
            }
        }

        echo json_encode(['code' => $code]);
    }

    public function withdraw_success()
    {
        $data['title']   = 'List Bioner Trade Withdraw - Success';
        $data['content'] = 'trade_withdraw_success/index';
        $data['vitamin'] = 'trade_withdraw_success/index_vitamin';

        $data['arr_trade'] = $this->M_trade->list_bioner_trade_withdraw('success');

        $this->template->template($data);
    }
}
        
    /* End of file  TradeAdminController.php */
