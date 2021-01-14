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

        $arr_stacking = $this->mcore->get('bioner_stacking', '*', ['id_user' => $id_user, 'deleted_at' => NULL], 'id', 'desc');
        $arr_bioner_profit = $this->M_stacking->count_bioner_profit($id_user);
        $arr_total_investment = $this->M_stacking->count_total_investment($id_user);

        $data['arr_stacking']       = $arr_stacking;
        $data['count_arr_stacking'] = $arr_stacking->num_rows();

        if ($arr_bioner_profit->num_rows() > 0) {
            $bioner_profit = $arr_bioner_profit->row()->profit;
        } else {
            $bioner_profit = 0;
        }

        if ($arr_total_investment->num_rows() > 0) {
            $total_investment = $arr_total_investment->row()->total_investment;
        } else {
            $total_investment = 0;
        }

        $data['bioner_profit'] = $bioner_profit;
        $data['total_investment'] = $total_investment;
        $data['arr_logs'] = $this->mcore->get('bioner_stacking_logs', '*', ['id_user' => $id_user], 'id', 'DESC');

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
                'created_at'        => date('Y-m-d H:i:s'),
                'updated_at'        => date('Y-m-d H:i:s'),
                'deleted_at'        => NULL,
            ];
            $exec = $this->mcore->store('bioner_stacking', $data_stacking);

            $code = 200;
        }

        echo json_encode(['code' => $code]);
    }

    public function _generate_kode_bioner_stacking($id_user)
    {
        # format ID_USER.DDMMYY.##
        $arr_unik = $this->M_stacking->count_today_stack();
        $unik = $arr_unik->num_rows() + 1;
        $kode = "BS" . $id_user . "." . date('d') . "" . date("m") . "" . date("y") . "" . $unik;
        return $kode;
    }

    public function _generate_kode_bioner_stacking_withdraw($id_user)
    {
        # format W.ID_USER.DDMMYY.##
        $arr_unik = $this->M_stacking->count_today_stack_withdraw();
        $unik = $arr_unik->num_rows() + 1;
        $kode = "BSW" . $id_user . "." . date('d') . "" . date("m") . "" . date("y") . "" . $unik;
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

            $data_upload = ['status' => 'menunggu_verifikasi', 'bukti_transfer' => $gambar_name, 'updated_at' => date('Y-m-d H:i:s')];
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
        $pin = $this->session->userdata(SESS . 'pin');

        $data['title'] = 'Bioner Stacking Withdraw';
        $data['content'] = 'stacking_withdraw/index';
        $data['vitamin'] = 'stacking_withdraw/index_vitamin';

        $arr_withdraw = $this->M_stacking->get_user_withdraw($id_user);
        $arr_bioner_profit = $this->M_stacking->count_bioner_profit($id_user);
        $arr_total_investment = $this->M_stacking->count_total_investment($id_user);

        $data['arr_withdraw'] = $arr_withdraw;

        if ($arr_bioner_profit->num_rows() > 0) {
            $bioner_profit = $arr_bioner_profit->row()->profit;
        } else {
            $bioner_profit = 0;
        }

        if ($arr_total_investment->num_rows() > 0) {
            $total_investment = $arr_total_investment->row()->total_investment;
        } else {
            $total_investment = 0;
        }

        $data['bioner_profit'] = $bioner_profit;
        $data['total_investment'] = $total_investment;

        $data['arr_rekening'] = $this->M_stacking->get_user_rekeing();
        $data['arr_wallet'] = $this->mcore->get('user_wallets', '*', ['id_user' => $id_user, 'deleted_at' => NULL]);

        $this->template->template($data);
    }

    public function withdraw_process()
    {
        $this->db->trans_begin();
        $id_user = $this->session->userdata(SESS . 'id');
        $withdraw_b = $this->input->post('withdraw_b');
        $withdraw_rp = $this->input->post('withdraw_rp');
        $id_jenis = $this->input->post('id_jenis');
        $id_rekening = $this->input->post('id_rekening');
        $id_wallet = $this->input->post('id_wallet');
        $kode_withdraw = $this->_generate_kode_bioner_stacking_withdraw($id_user);
        $code = 500;

        if ($id_jenis == "invest") {
            //
            $total_investment = $withdraw_b;
            $total_transfer   = $withdraw_b * 15000;

            if ($total_investment > 0 && $total_transfer > 0) {
                $kode              = $this->_generate_kode_bioner_stacking($id_user);
                $profit_perhari_b  = ($total_investment * 0.5) / 100;
                $profit_perhari_rp = ($total_investment * 10000 * 0.5) / 100;
                $status            = 'aktif';

                $data_stacking = [
                    'kode'              => $kode,
                    'id_user'           => $id_user,
                    'total_investment'  => $total_investment,
                    'total_transfer'    => $total_transfer,
                    'profit_perhari_b'  => $profit_perhari_b,
                    'profit_perhari_rp' => $profit_perhari_rp,
                    'status'            => $status,
                    'bukti_transfer'    => NULL,
                    'created_at'        => date('Y-m-d H:i:s'),
                    'updated_at'        => date('Y-m-d H:i:s'),
                    'deleted_at'        => NULL,
                ];
                $exec = $this->mcore->store('bioner_stacking', $data_stacking);

                if ($exec) {
                    $id_bioner_stacking = $this->db->insert_id();
                    $data_logs = [
                        'id_user' => $id_user,
                        'id_bioner_stacking' => $id_bioner_stacking,
                        'type' => 'investment',
                        'nominal_b' => $total_investment,
                        'nominal_rp' => $total_investment * 15000,
                        'kode' => $kode,
                        'keterangan' => 'Investment sebesar ' . $total_investment . ' Bioner dari Profit',
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

    public function withdraw_delete()
    {
        $this->db->trans_begin();

        $id = $this->input->post('id');
        $id_user = $this->session->userdata(SESS . 'id');
        $code = 500;
        $arr_withdraw = $this->mcore->get('user_bioner_stacking_withdraw', '*', ['id' => $id, 'status' => 'pending', 'deleted_at' => NULL]);

        if ($arr_withdraw->num_rows() == 1) {
            $withdraw_b = $arr_withdraw->row()->withdraw_b;
            $withdraw_rp = $arr_withdraw->row()->withdraw_rp;
            $kode_withdraw = $arr_withdraw->row()->kode_withdraw;

            $data_withdraw = ['deleted_at' => date('Y-m-d H:i:s')];
            $where_withdraw = ['id' => $id];
            $exec_withdraw = $this->mcore->update('user_bioner_stacking_withdraw', $data_withdraw, $where_withdraw);

            if ($exec_withdraw) {
                $exec_reduce_profit = $this->M_stacking->update_profit($id_user, $withdraw_b);
                if ($exec_reduce_profit) {
                    $data_logs = [
                        'id_user' => $id_user,
                        'id_bioner_stacking' => NULL,
                        'type' => 'return withdraw',
                        'nominal_b' => $withdraw_b,
                        'nominal_rp' => $withdraw_rp,
                        'kode' => $kode_withdraw,
                        'keterangan' => 'Return Withdraw sebesar ' . $withdraw_b . ' Bioner to Profit',
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
}
        
    /* End of file  StackingController.php */
