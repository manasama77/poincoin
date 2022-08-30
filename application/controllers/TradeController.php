<?php

defined('BASEPATH') or exit('No direct script access allowed');

class TradeController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('TemplateUser', NULL, 'template');
        $this->load->model('M_trade');
        $this->load->model('M_users');
    }

    public function index()
    {
        $id_user = $this->session->userdata(SESS . 'id');

        $data['title']   = 'Poincoin Trade';
        $data['content'] = 'trade/index';
        $data['vitamin'] = 'trade/index_vitamin';

        $arr_bioner_trade         = $this->mcore->get('bioner_trade', '*', ['id_user' => $id_user, 'deleted_at' => NULL], 'id', 'DESC');
        $data['total_investment'] = $this->mcore->count('bioner_trade', ['id_user'    => $id_user, 'status'     => 'aktif', 'deleted_at' => NULL]);

        $arr_user_bioner_trade = $this->mcore->get('users_bioner_trade', '*', ['id_user' => $id_user, 'deleted_at' => NULL]);
        $data['balance_saldo'] = $arr_user_bioner_trade->row()->balance_saldo;
        $data['trigger_ask']   = $arr_user_bioner_trade->row()->trigger_ask;

        $data['arr_bioner_trade'] = $arr_bioner_trade;

        $this->template->template($data);
    }

    public function add()
    {
        $id_user        = $this->session->userdata(SESS . 'id');
        $code           = 500;
        $total_lot      = $this->input->post('total_lot');
        $total_transfer = $this->input->post('total_transfer');

        for ($i = 0; $i < $total_lot; $i++) {
            $kode = $this->_generate_kode_bioner_trade($id_user);
            $data_bioner_trade = [
                'kode'       => $kode,
                'id_user'    => $id_user,
                'status'     => 'pending',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'deleted_at' => NULL,
            ];
            $exec_bioner_trade = $this->mcore->store('bioner_trade', $data_bioner_trade);

            if ($exec_bioner_trade) {
                $code = 200;
                $this->email_add($kode);
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

            $data_upload  = ['status' => 'menunggu verifikasi', 'bukti_transfer' => $gambar_name, 'updated_at' => date('Y-m-d H:i:s')];
            $where_upload = ['kode'   => $id_bioner_trade];
            $exec         = $this->mcore->update('bioner_trade', $data_upload, $where_upload);

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
        $unik     = $arr_unik->num_rows() + 1;
        $kode     = "BT" . $id_user . "." . date('d') . "" . date("m") . "" . date("y") . "" . $unik;
        return $kode;
    }

    public function withdraw()
    {
        $id_user = $this->session->userdata(SESS . 'id');

        $data['title']   = 'Poincoin Trade Withdraw';
        $data['content'] = 'trade_withdraw/index';
        $data['vitamin'] = 'trade_withdraw/index_vitamin';

        $arr_withdraw         = $this->M_trade->get_user_withdraw($id_user);
        $arr_balance_saldo    = $this->M_trade->count_balance_saldo($id_user);
        $arr_total_investment = $this->mcore->count('bioner_trade', ['id_user' => $id_user, 'deleted_at' => NULL]);

        $data['arr_withdraw'] = $arr_withdraw;

        if ($arr_balance_saldo->num_rows() > 0) {
            $balance_saldo = $arr_balance_saldo->row()->balance_saldo;
        } else {
            $balance_saldo = 0;
        }

        $data['balance_saldo']    = $balance_saldo;
        $data['total_investment'] = $arr_total_investment;
        $arr_rekening     = $this->M_trade->get_user_rekeing();
        $data['arr_rekening']     = $this->M_trade->get_user_rekeing();

        $data['no_rekening'] = $arr_rekening->row()->no_rekening;
        $data['nama_bank']   = $arr_rekening->row()->nama_bank;
        $data['atas_nama']   = $arr_rekening->row()->atas_nama;

        $arr_user_bioner_trade = $this->mcore->get('users_bioner_trade', '*', ['id_user' => $id_user, 'deleted_at' => NULL]);
        $data['trigger_ask']   = $arr_user_bioner_trade->row()->trigger_ask;

        $this->template->template($data);
    }

    public function withdraw_process()
    {
        $this->db->trans_begin();
        $id_user       = $this->session->userdata(SESS . 'id');
        $id_jenis      = $this->input->post('id_jenis');
        $id_rekening   = $this->input->post('id_rekening');
        $withdraw_rp   = $this->input->post('withdraw_rp');
        $hi            = $this->input->post('hi');
        $code          = 500;

        if ($id_jenis == "invest") {
            //
            $withdraw_rp = 750000;
            $balance_saldo = $this->mcore->get('users_bioner_trade', 'balance_saldo', ['id_user' => $id_user, 'deleted_at' => NULL])->row()->balance_saldo;

            if ($balance_saldo >= ($hi * 750000) && $hi > 0) {
                for ($i = 0; $i < $hi; $i++) {
                    $kode          = $this->_generate_kode_bioner_trade($id_user);
                    $kode_withdraw = $this->_generate_kode_bioner_trade_withdraw($id_user);
                    $status        = 'aktif';

                    $data_trade = [
                        'kode'           => $kode,
                        'id_user'        => $id_user,
                        'status'         => $status,
                        'bukti_transfer' => NULL,
                        'created_at'     => date('Y-m-d H:i:s'),
                        'updated_at'     => date('Y-m-d H:i:s'),
                        'deleted_at'     => NULL,
                    ];
                    $exec = $this->mcore->store('bioner_trade', $data_trade);

                    if ($exec) {
                        $id_bioner_trade = $this->db->insert_id();

                        $data_logs = [
                            'id_user'         => $id_user,
                            'id_bioner_trade' => $id_bioner_trade,
                            'type'            => 'investment',
                            'kode'            => $kode,
                            'keterangan'      => 'Pembukaan Poincoin Trade ' . $kode . ' sebanyak 1 Lot dari Profit',
                            'created_at'      => date('Y-m-d H:i:s')
                        ];
                        $exec_logs = $this->mcore->store('bioner_trade_logs', $data_logs);

                        if ($exec_logs) {
                            $data_withdraw = [
                                'id_user'        => $id_user,
                                'id_user_bank'   => NULL,
                                'kode_withdraw'  => $kode_withdraw,
                                'kode_invest'    => $kode,
                                'withdraw_rp'    => $withdraw_rp,
                                'status'         => 'success',
                                'created_at'     => date('Y-m-d H:i:s'),
                                'updated_at'     => date('Y-m-d H:i:s'),
                                'deleted_at'     => NULL,
                            ];

                            $exec_withdraw = $this->mcore->store('user_bioner_trade_withdraw', $data_withdraw);

                            if ($exec_withdraw) {
                                $exec_reduce_balance_saldo = $this->M_trade->reduce_balance_saldo($id_user, $withdraw_rp);
                                if ($exec_reduce_balance_saldo) {
                                    $data_logs = [
                                        'id_user'         => $id_user,
                                        'id_bioner_trade' => $id_bioner_trade,
                                        'type'            => 'withdraw',
                                        'nominal_rp'      => $withdraw_rp,
                                        'kode'            => $kode_withdraw,
                                        'keterangan'      => 'Withdraw sebesar Rp.' . $withdraw_rp . ' Untuk Investment ' . $kode,
                                        'created_at'      => date('Y-m-d H: i: s'),
                                    ];
                                    $exec_logs = $this->mcore->store('bioner_trade_logs', $data_logs);

                                    if ($exec_logs) {
                                        $code = 200;
                                        $this->db->trans_commit();
                                        $this->email_withdraw_trade_2($kode);
                                    } else {
                                        $code = 500;
                                        $this->db->trans_rollback();
                                    }
                                } else {
                                    $code = 500;
                                    $this->db->trans_rollback();
                                }
                            } else {
                                $code = 500;
                                $this->db->trans_rollback();
                            }
                        } else {
                            $code = 500;
                            $this->db->trans_rollback();
                        }
                    } else {
                        $code = 500;
                        $this->db->trans_rollback();
                    }
                }
            } else {
                $code = 404;
            }
            //
        } else {
            $kode_withdraw = $this->_generate_kode_bioner_trade_withdraw($id_user);

            $data_withdraw = [
                'id_user'       => $id_user,
                'id_user_bank'  => $id_rekening,
                'kode_withdraw' => $kode_withdraw,
                'kode_invest'   => NULL,
                'withdraw_rp'   => $withdraw_rp,
                'status'        => 'pending',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
                'deleted_at'    => NULL,
            ];

            $exec_withdraw = $this->mcore->store('user_bioner_trade_withdraw', $data_withdraw);

            if ($exec_withdraw) {
                $exec_reduce_profit = $this->M_trade->reduce_balance_saldo($id_user, $withdraw_rp);

                if ($exec_reduce_profit) {
                    $data_logs = [
                        'id_user'         => $id_user,
                        'id_bioner_trade' => NULL,
                        'type'            => 'withdraw',
                        'kode'            => $kode_withdraw,
                        'nominal_rp'      => $withdraw_rp,
                        'keterangan'      => 'Withdraw sebesar Rp.' . $withdraw_rp,
                        'created_at'      => date('Y-m-d H:i:s'),
                    ];
                    $exec_logs = $this->mcore->store('bioner_trade_logs', $data_logs);

                    if ($exec_logs) {
                        $code = 200;
                        $this->db->trans_commit();
                        $this->email_withdraw_trade_1($kode_withdraw, $withdraw_rp);
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

        $id           = $this->input->post('id');
        $id_user      = $this->session->userdata(SESS . 'id');
        $code         = 500;
        $arr_withdraw = $this->mcore->get('user_bioner_trade_withdraw', '*', ['id' => $id, 'status' => 'pending', 'deleted_at' => NULL]);

        if ($arr_withdraw->num_rows() == 1) {
            $withdraw_rp   = $arr_withdraw->row()->withdraw_rp;
            $kode_withdraw = $arr_withdraw->row()->kode_withdraw;

            $data_withdraw  = ['deleted_at' => date('Y-m-d H: i: s')];
            $where_withdraw = ['id'         => $id];
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
                        'keterangan'      => 'Return Withdraw sebesar Rp.' . $withdraw_rp . ' to Balance Saldo',
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

    public function _generate_kode_bioner_trade_withdraw($id_user)
    {
        # format BTW.ID_USER.DDMMYY.##
        $arr_unik = $this->M_trade->count_today_trade_withdraw();
        $unik     = $arr_unik->num_rows() + 1;
        $kode     = "BTW" . $id_user . "." . date('d') . "" . date("m") . "" . date("y") . "" . $unik;
        return $kode;
    }

    public function test_email()
    {
        $data = [
            'kode'       => '123',
            'kode_withdraw'       => '123',
            'id_user'    => '8',
            'status'     => 'pending',
            'created_at' => date('Y-m-d H: i: s'),
            'updated_at' => date('Y-m-d H: i: s'),
            'deleted_at' => NULL,
            'title'      => 'trade',
        ];
        $this->load->view('email_trade_success_2', $data, FALSE);
    }

    public function email_add($kode)
    {
        $id            = $this->session->userdata(SESS . 'id');
        $email         = $this->session->userdata(SESS . 'email');
        $title         = "POINCOIN ADD NEW TRADE - " . $kode;
        $data['title'] = $title;
        $data['kode']  = $kode;

        $template_email = $this->load->view('email_trade_success', $data, TRUE);

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
        $this->mcore->store('log_email_trade', $data_log_email);
    }

    public function email_withdraw_trade_1($kode_withdraw, $withdraw_rp)
    {
        $id       = $this->session->userdata(SESS . 'id');
        $email    = $this->session->userdata(SESS . 'email');
        $arr_bank = $this->M_users->get_user_bank_data();

        $no_rekening = $arr_bank->row()->no_rekening;
        $nama_bank   = $arr_bank->row()->nama_bank;
        $atas_nama   = $arr_bank->row()->atas_nama;
        $title       = "POINCOIN WITHDRAW TRADE - " . $kode_withdraw;

        $data['title']         = $title;
        $data['kode_withdraw'] = $kode_withdraw;
        $data['withdraw_rp']   = $withdraw_rp;
        $data['no_rekening']   = $no_rekening;
        $data['nama_bank']     = $nama_bank;
        $data['atas_nama']     = $atas_nama;
        $template_email        = $this->load->view('email_withdraw_trade_1', $data, TRUE);


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
        $this->mcore->store('log_email_withdraw', $data_log_email);
    }

    public function email_withdraw_trade_2($kode)
    {
        $id            = $this->session->userdata(SESS . 'id');
        $email         = $this->session->userdata(SESS . 'email');
        $title         = "POINCOIN ADD NEW TRADE - " . $kode;
        $data['title'] = $title;
        $data['kode']  = $kode;

        $template_email = $this->load->view('email_trade_success_2', $data, TRUE);

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
        $this->mcore->store('log_email_trade', $data_log_email);
    }
}
        
    /* End of file  TradeController.php */
