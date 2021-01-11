<?php

defined('BASEPATH') or exit('No direct script access allowed');

class TradeController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('TemplateUser', NULL, 'template');
        $this->load->model('M_trade');
    }

    public function index()
    {
        $id_user = $this->session->userdata(SESS . 'id');

        $data['title']   = 'Bioner Trade';
        $data['content'] = 'trade/index';
        $data['vitamin'] = 'trade/index_vitamin';

        $arr_bioner_trade = $this->mcore->get('bioner_trade', '*', ['id_user' => $id_user, 'deleted_at' => NULL]);
        $data['total_investment'] = $this->mcore->count('bioner_trade', ['id_user' => $id_user, 'status' => 'aktif', 'deleted_at' => NULL]);

        $arr_user_bioner_trade = $this->mcore->get('users_bioner_trade', '*', ['id_user' => $id_user, 'deleted_at' => NULL]);
        $data['balance_saldo'] = $arr_user_bioner_trade->row()->balance_saldo;
        $data['trigger_ask'] = $arr_user_bioner_trade->row()->trigger_ask;

        $data['arr_bioner_trade'] = $arr_bioner_trade;

        $this->template->template($data);
    }

    public function add()
    {
        $id_user = $this->session->userdata(SESS . 'id');
        $code = 500;
        $total_lot = $this->input->post('total_lot');
        $total_transfer = $this->input->post('total_transfer');

        for ($i = 0; $i < $total_lot; $i++) {
            $kode = $this->_generate_kode_bioner_trade($id_user);
            $data_bioner_trade = [
                'kode' => $kode,
                'id_user' => $id_user,
                'status' => 'pending',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'deleted_at' => NULL,
            ];
            $exec_bioner_trade = $this->mcore->store('bioner_trade', $data_bioner_trade);

            if ($exec_bioner_trade) {
                $code = 200;
            }
        }


        echo json_encode(['code' => $code]);
    }

    public function trade_upload_bukti_transfer()
    {
        $id_bioner_trade   = $this->input->post('id_bioner_trade');

        $config['upload_path']      = './public/img/bukti_transfer_trade/';
        $config['allowed_types']    = 'gif|jpg|png|jpeg';
        $config['overwrite']        = FALSE;
        $config['file_ext_tolower'] = TRUE;
        $config['file_name']        = date('Y-m-d_H_i_s');

        $this->load->library('upload', $config);

        $code = 500;
        $msg = '';
        if ($this->upload->do_upload('bukti_transfer')) {
            $gambar_name = $this->upload->data('file_name');

            $data_upload = ['status' => 'menunggu verifikasi', 'bukti_transfer' => $gambar_name, 'updated_at' => date('Y-m-d H:i:s')];
            $where_upload = ['kode' => $id_bioner_trade];
            $exec = $this->mcore->update('bioner_trade', $data_upload, $where_upload);

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

    public function _generate_kode_bioner_trade($id_user)
    {
        # format ID_USER.DDMMYY.##
        $arr_unik = $this->M_trade->count_today_stack();
        $unik = $arr_unik->num_rows() + 1;
        $kode = "BT" . $id_user . "." . date('d') . "" . date("m") . "" . date("y") . "" . $unik;
        return $kode;
    }

    public function withdraw()
    {
        $id_user = $this->session->userdata(SESS . 'id');

        $data['title'] = 'Bioner Trade Withdraw';
        $data['content'] = 'trade_withdraw/index';
        $data['vitamin'] = 'trade_withdraw/index_vitamin';

        $arr_withdraw = $this->M_trade->get_user_withdraw($id_user);
        $arr_balance_saldo = $this->M_trade->count_balance_saldo($id_user);
        $arr_total_investment = $this->mcore->count('bioner_trade', ['id_user' => $id_user, 'deleted_at' => NULL]);

        $data['arr_withdraw'] = $arr_withdraw;

        if ($arr_balance_saldo->num_rows() > 0) {
            $balance_saldo = $arr_balance_saldo->row()->balance_saldo;
        } else {
            $balance_saldo = 0;
        }

        $data['balance_saldo'] = $balance_saldo;
        $data['total_investment'] = $arr_total_investment;

        $data['arr_rekening'] = $this->M_trade->get_user_rekeing();

        $arr_user_bioner_trade = $this->mcore->get('users_bioner_trade', '*', ['id_user' => $id_user, 'deleted_at' => NULL]);
        $data['trigger_ask'] = $arr_user_bioner_trade->row()->trigger_ask;

        $this->template->template($data);
    }

    public function withdraw_process()
    {
        $this->db->trans_begin();
        $id_user = $this->session->userdata(SESS . 'id');
        $id_jenis = $this->input->post('id_jenis');
        $id_rekening = $this->input->post('id_rekening');
        $withdraw_rp = $this->input->post('withdraw_rp');
        $hi = $this->input->post('hi');
        $kode_withdraw = $this->_generate_kode_bioner_trade_withdraw($id_user);
        $code = 500;

        if ($id_jenis == "invest") {
            //
            $balance_saldo = $this->mcore->get('users_bioner_trade', 'balance_saldo', ['id_user' => $id_user, 'deleted_at' => NULL])->row()->balance_saldo;

            if ($balance_saldo >= ($hi * 750000) && $hi > 0) {
                for ($i = 0; $i <= $hi; $i++) {
                    $kode              = $this->_generate_kode_bioner_trade($id_user);
                    $status            = 'aktif';

                    $data_trade = [
                        'kode'              => $kode,
                        'id_user'           => $id_user,
                        'status'            => $status,
                        'bukti_transfer'            => NULL,
                        'created_at'        => date('Y-m-d H:i:s'),
                        'updated_at'        => date('Y-m-d H:i:s'),
                        'deleted_at'        => NULL,
                    ];
                    $exec = $this->mcore->store('bioner_trade', $data_trade);

                    if ($exec) {
                        $id_bioner_trade = $this->db->insert_id();
                        $data_logs = [
                            'id_user' => $id_user,
                            'id_bioner_trade' => $id_bioner_trade,
                            'type' => 'investment',
                            'kode' => $kode,
                            'keterangan' => 'Pembukaan Bioner Trade ' . $kode . ' sebanyak 1 Lot dari Profit',
                            'created_at' => date('Y-m-d H:i:s')
                        ];
                        $exec_logs = $this->mcore->store('bioner_stacking_logs', $data_logs);

                        if ($exec_logs) {
                            $exec_users_bioner_stacking = $this->M_stacking->update_total_investment($id_user, $total_investment);

                            if ($exec_users_bioner_stacking) {
                                $data_withdraw = [
                                    'id_user' => $id_user,
                                    'id_user_bank' => NULL,
                                    'id_user_wallet' => NULL,
                                    'kode_withdraw' => $kode_withdraw,
                                    'kode_invest' => $kode,
                                    'withdraw_b' => $withdraw_b,
                                    'withdraw_rp' => $withdraw_rp,
                                    'status' => 'success',
                                    'created_at' => date('Y-m-d H:i:s'),
                                    'updated_at' => date('Y-m-d H:i:s'),
                                    'deleted_at' => NULL,
                                ];

                                $exec_withdraw = $this->mcore->store('user_bioner_stacking_withdraw', $data_withdraw);

                                if ($exec_withdraw) {
                                    $exec_reduce_profit = $this->M_stacking->reduce_profit($id_user, $withdraw_b);
                                    if ($exec_reduce_profit) {
                                        $data_logs = [
                                            'id_user' => $id_user,
                                            'id_bioner_stacking' => $id_bioner_stacking,
                                            'type' => 'withdraw',
                                            'nominal_b' => $withdraw_b,
                                            'nominal_rp' => $withdraw_rp,
                                            'kode' => $kode_withdraw,
                                            'keterangan' => 'Withdraw sebesar ' . $withdraw_b . ' Bioner Untuk Investment ' . $kode,
                                            'created_at' => date('Y-m-d H:i:s'),
                                        ];
                                        $exec_logs = $this->mcore->store('bioner_stacking_logs', $data_logs);

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
            } else {
                $code = 404;
            }
            //
        } else {
            if ($id_jenis == "bank") {
                $id_wallet = NULL;
            } elseif ($id_jenis == "doge") {
                $id_rekening = NULL;
            }

            $data_withdraw = [
                'id_user' => $id_user,
                'id_user_bank' => $id_rekening,
                'id_user_wallet' => $id_wallet,
                'kode_withdraw' => $kode_withdraw,
                'withdraw_b' => $withdraw_b,
                'withdraw_rp' => $withdraw_rp,
                'status' => 'pending',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'deleted_at' => NULL,
            ];

            $exec_withdraw = $this->mcore->store('user_bioner_stacking_withdraw', $data_withdraw);

            if ($exec_withdraw) {
                $exec_reduce_profit = $this->M_stacking->reduce_profit($id_user, $withdraw_b);

                if ($exec_reduce_profit) {
                    $data_logs = [
                        'id_user' => $id_user,
                        'id_bioner_stacking' => NULL,
                        'type' => 'withdraw',
                        'nominal_b' => $withdraw_b,
                        'nominal_rp' => $withdraw_rp,
                        'kode' => $kode_withdraw,
                        'keterangan' => 'Withdraw sebesar ' . $withdraw_b . ' Bioner',
                        'created_at' => date('Y-m-d H:i:s'),
                    ];
                    $exec_logs = $this->mcore->store('bioner_stacking_logs', $data_logs);

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

    public function _generate_kode_bioner_trade_withdraw($id_user)
    {
        # format BTW.ID_USER.DDMMYY.##
        $arr_unik = $this->M_trade->count_today_trade_withdraw();
        $unik = $arr_unik->num_rows() + 1;
        $kode = "BTW" . $id_user . "." . date('d') . "" . date("m") . "" . date("y") . "" . $unik;
        return $kode;
    }
}
        
    /* End of file  TradeController.php */