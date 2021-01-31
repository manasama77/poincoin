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

    public function count()
    {
        $id_user = $this->input->get('id_user');
        $arr_stacking = $this->mcore->get('bioner_stacking', '*', ['id_user' => $id_user, 'deleted_at' => NULL], 'id', 'desc');
        $count_arr_stacking = $arr_stacking->num_rows();

        echo json_encode(['count' => $count_arr_stacking]);
    }

    public function add()
    {
        $data['title']   = 'Add Bioner Stacking';
        $data['content'] = 'stacking/form';
        $data['vitamin'] = 'stacking/form_vitamin';

        $arr_user = $this->mcore->get('users', '*', ['deleted_at' => NULL], 'id', 'desc');
        $data['arr_user'] = $arr_user;

        $this->template->template($data);
    }

    public function store()
    {
        $id_user          = $this->input->post('id_user');
        $total_investment = str_replace(',', '', $this->input->post('total_investment'));
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

    public function verifikasi_transfer()
    {
        $this->db->trans_begin();
        $id      = $this->input->post('id');
        $arr_cek = $this->mcore->get('bioner_stacking', '*', ['id' => $id]);

        if (in_array($arr_cek->row()->status, ['menunggu_transfer', 'menunggu_verifikasi'])) {

            $data  = ['status' => 'aktif', 'updated_at' => date('Y-m-d H:i:s')];
            $where = ['id' => $id];
            $exec  = $this->mcore->update('bioner_stacking', $data, $where);
            $code  = 500;

            if ($exec) {
                $where_x                    = ['id' => $id];
                $arr                        = $this->mcore->get('bioner_stacking', 'id_user, kode, total_investment', $where_x);
                $id_user                    = $arr->row()->id_user;
                $kode                       = $arr->row()->kode;
                $total_investment           = $arr->row()->total_investment;
                $exec_users_bioner_stacking = $this->M_stacking->update_total_investment($id_user, $total_investment);

                if ($exec_users_bioner_stacking) {
                    $arr_user = $this->mcore->get('users', '*', ['id' => $id_user, 'deleted_at' => NULL]);
                    if ($arr_user->num_rows() == 1) {
                        $nama       = $arr_user->row()->nama;
                        $id_referal = $arr_user->row()->id_referal;

                        if ($id_referal != NULL) {
                            $where_stack = "id_user = '" . $id_user . "' AND deleted_at IS NULL AND status = 'aktif'";
                            $count_stack = $this->mcore->count('bioner_stacking', $where_stack);

                            if ($count_stack == 1) {
                                $nominal_b_bonus  = ($total_investment * 10) / 100;
                                $nominal_rp_bonus = $nominal_b_bonus * 10000;
                                $data_referral = [
                                    'id_user'            => $id_referal,
                                    'id_bioner_stacking' => NULL,
                                    'type'               => 'bonus',
                                    'nominal_b'          => $nominal_b_bonus,
                                    'nominal_rp'         => $nominal_rp_bonus,
                                    'kode'               => $kode,
                                    'keterangan'         => 'Bonus Referral sebesar ' . $nominal_b_bonus . ' Bioner dari user ' . $nama,
                                    'created_at'         => date('Y-m-d H:i:s'),
                                ];
                                $exec_referral = $this->mcore->store('bioner_stacking_logs', $data_referral);

                                if ($exec_referral) {
                                    $exec_referral_bioner_stacking = $this->M_stacking->update_profit($id_referal, $nominal_b_bonus);

                                    if (!$exec_referral_bioner_stacking) {
                                        $code = 500;
                                        $this->db->trans_rollback();
                                    }
                                } else {
                                    $code = 500;
                                    $this->db->trans_rollback();
                                }
                            }
                        }
                    }

                    $data_logs = [
                        'id_user'            => $id_user,
                        'id_bioner_stacking' => $id,
                        'type'               => 'investment',
                        'nominal_b'          => $total_investment,
                        'nominal_rp'         => $total_investment * 10000,
                        'kode'               => $kode,
                        'keterangan'         => 'Investment sebesar ' . $total_investment . ' Bioner',
                        'created_at'         => date('Y-m-d H:i:s'),
                    ];
                    $exec_logs = $this->mcore->store('bioner_stacking_logs', $data_logs);

                    if ($exec_logs) {
                        $code = 200;
                        $this->db->trans_commit();
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

        echo json_encode(['code' => $code]);
    }

    public function delete_stacking()
    {
        $this->db->trans_begin();
        $id   = $this->input->post('id');
        $code = 500;

        $arr_bioner_stacking = $this->mcore->get('bioner_stacking', 'id_user, kode, total_investment, status', ['id' => $id]);

        if ($arr_bioner_stacking->num_rows() == 1) {
            $id_user          = $arr_bioner_stacking->row()->id_user;
            $kode             = $arr_bioner_stacking->row()->kode;
            $total_investment = $arr_bioner_stacking->row()->total_investment;
            $status           = $arr_bioner_stacking->row()->status;

            $data_bioner_stacking  = ['deleted_at' => date('Y-m-d H:i:s')];
            $where_bioner_stacking = ['id' => $id];
            $exec_bioner_stacking  = $this->mcore->update('bioner_stacking', $data_bioner_stacking, $where_bioner_stacking);

            if ($exec_bioner_stacking) {
                if ($status != "menunggu_transfer") {
                    $exec_reduce_total_investment = $this->M_stacking->reduce_total_investment($id_user, $total_investment);

                    if ($exec_reduce_total_investment) {
                        $data_logs = [
                            'id_user'            => $id_user,
                            'id_bioner_stacking' => $id,
                            'type'               => 'delete investment',
                            'nominal_b'          => $total_investment,
                            'nominal_rp'         => $total_investment * 10000,
                            'kode'               => $kode,
                            'keterangan'         => 'Investment Dibatalkan',
                            'created_at'         => date('Y-m-d H:i:s'),
                        ];
                        $exec_logs = $this->mcore->store('bioner_stacking_logs', $data_logs);

                        if ($exec_logs) {
                            $code = 200;
                            $this->db->trans_commit();
                        } else {
                            $code = 500;
                            $this->db->trans_rollback();
                        }
                    } else {
                        $code = 500;
                        $this->db->trans_rollback();
                    }
                } else {
                    $data_logs = [
                        'id_user'            => $id_user,
                        'id_bioner_stacking' => $id,
                        'type'               => 'delete investment',
                        'nominal_b'          => $total_investment,
                        'nominal_rp'         => $total_investment * 10000,
                        'kode'               => $kode,
                        'keterangan'         => 'Investment Dibatalkan',
                        'created_at'         => date('Y-m-d H:i:s'),
                    ];
                    $exec_logs = $this->mcore->store('bioner_stacking_logs', $data_logs);

                    if ($exec_logs) {
                        $code = 200;
                        $this->db->trans_commit();
                    } else {
                        $code = 500;
                        $this->db->trans_rollback();
                    }
                }
            } else {
                $code = 500;
                $this->db->trans_rollback();
            }
        }

        echo json_encode(['code' => $code]);
    }

    public function withdraw_pending()
    {
        $data['title']   = 'List Bioner Stacking Withdraw - Pending';
        $data['content'] = 'stacking_withdraw_pending/index';
        $data['vitamin'] = 'stacking_withdraw_pending/index_vitamin';

        $data['arr_stacking'] = $this->M_stacking->list_bioner_stacking_withdraw('pending');

        $this->template->template($data);
    }

    public function withdraw_verifikasi()
    {
        $this->db->trans_begin();

        $id = $this->input->post('id');
        $code = 500;

        $data_withdraw = [
            'status' => 'success',
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        $where_withdraw = ['id' => $id];

        $exec = $this->mcore->update('user_bioner_stacking_withdraw', $data_withdraw, $where_withdraw);

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

        $id = $this->input->post('id');
        $code = 500;
        $arr_withdraw = $this->mcore->get('user_bioner_stacking_withdraw', '*', ['id' => $id, 'status' => 'pending', 'deleted_at' => NULL]);

        if ($arr_withdraw->num_rows() == 1) {
            $id_user = $arr_withdraw->row()->id_user;
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
                        'keterangan' => 'Return Withdraw sebesar ' . $withdraw_b . ' Bioner to Profit - By Admin',
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

    public function withdraw_success()
    {
        $data['title']   = 'List Bioner Stacking Withdraw - Success';
        $data['content'] = 'stacking_withdraw_success/index';
        $data['vitamin'] = 'stacking_withdraw_success/index_vitamin';

        $data['arr_stacking'] = $this->M_stacking->list_bioner_stacking_withdraw('success');

        $this->template->template($data);
    }

    public function _generate_kode_bioner_stacking($id_user)
    {
        # format ID_USER.DDMMYY.##
        $arr_unik = $this->M_stacking->count_today_stack_from_admin($id_user);
        $unik = $arr_unik->num_rows() + 1;
        $kode = "BS" . $id_user . "." . date('d') . "" . date("m") . "" . date("y") . "" . $unik;
        return $kode;
    }
}
        
    /* End of file  StackingAdminController.php */
