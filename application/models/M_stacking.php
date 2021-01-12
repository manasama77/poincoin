<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_stacking extends CI_Model
{

    public function list_bioner_stacking()
    {
        $this->db->select([
            'bioner_stacking.id',
            'bioner_stacking.kode',
            'bioner_stacking.id_user',
            'users.nama',
            'bioner_stacking.total_investment',
            'bioner_stacking.total_transfer',
            'bioner_stacking.profit_perhari_b',
            'bioner_stacking.profit_perhari_rp',
            'bioner_stacking.status',
            'bioner_stacking.bukti_transfer',
            'bioner_stacking.created_at',
            'bioner_stacking.updated_at'
        ]);
        $this->db->join('users', 'users.id = bioner_stacking.id_user', 'left');
        $this->db->where('bioner_stacking.deleted_at', NULL);
        $this->db->where('users.deleted_at', NULL);
        $this->db->order_by('bioner_stacking.id', 'ASC');
        return $this->db->get('bioner_stacking');
    }

    public function list_bioner_stacking_withdraw($tipe = 'pending')
    {
        $this->db->select([
            'user_bioner_stacking_withdraw.id',
            'user_bioner_stacking_withdraw.id_user',
            'user_bioner_stacking_withdraw.id_user_bank',
            'user_bioner_stacking_withdraw.id_user_wallet',
            'user_bioner_stacking_withdraw.kode_withdraw',
            'user_bioner_stacking_withdraw.kode_invest',
            'user_bioner_stacking_withdraw.withdraw_b',
            'user_bioner_stacking_withdraw.withdraw_rp',
            'user_bioner_stacking_withdraw.status',
            'user_bioner_stacking_withdraw.created_at',
            'user_bioner_stacking_withdraw.updated_at',
            'user_banks.no_rekening',
            'user_banks.atas_nama',
            'param_banks.nama_bank',
            'user_wallets.no_wallet',
            'users.nama',
        ]);
        $this->db->join('user_banks', 'user_banks.id = user_bioner_stacking_withdraw.id_user_bank', 'left');
        $this->db->join('param_banks', 'param_banks.id = user_banks.id_bank', 'left');
        $this->db->join('user_wallets', 'user_wallets.id = user_bioner_stacking_withdraw.id_user_wallet', 'left');
        $this->db->join('users', 'users.id = user_bioner_stacking_withdraw.id_user', 'left');
        $this->db->where('user_bioner_stacking_withdraw.deleted_at', NULL);
        $this->db->where('users.deleted_at', NULL);
        $this->db->where('user_bioner_stacking_withdraw.status', $tipe);
        $this->db->order_by('user_bioner_stacking_withdraw.id', 'ASC');
        return $this->db->get('user_bioner_stacking_withdraw');
    }

    public function count_today_stack()
    {
        $this->db->where_in('status', [
            'aktif',
            'menunggu_transfer',
            'menunggu_verifikasi',
        ]);
        $this->db->where('id_user', $this->session->userdata(SESS . 'id'));
        $this->db->where('DATE(created_at)', date('Y-m-d'));
        return $this->db->get('bioner_stacking');
    }

    public function count_today_stack_withdraw()
    {
        $this->db->where_in('status', [
            'pending',
            'success'
        ]);
        $this->db->where('id_user', $this->session->userdata(SESS . 'id'));
        $this->db->where('DATE(created_at)', date('Y-m-d'));
        return $this->db->get('user_bioner_stacking_withdraw');
    }

    public function count_bioner_profit($id_user)
    {
        $this->db->select('profit');
        $this->db->where('id_user', $id_user);
        return $this->db->get('users_bioner_stacking');
    }

    public function count_total_investment($id_user)
    {
        $this->db->select('total_investment');
        $this->db->where('id_user', $id_user);
        return $this->db->get('users_bioner_stacking');
    }

    public function update_total_investment($id_user, $total_investment)
    {
        $this->db->set('total_investment', 'total_investment + ' . $total_investment, FALSE);
        $this->db->set('updated_at', date('Y-m-d H:i:s'));
        $this->db->where('id_user', $id_user);
        return $this->db->update('users_bioner_stacking');
    }

    public function reduce_total_investment($id_user, $total_investment)
    {
        $this->db->set('total_investment', 'total_investment - ' . $total_investment, FALSE);
        $this->db->set('updated_at', date('Y-m-d H:i:s'));
        $this->db->where('id_user', $id_user);
        return $this->db->update('users_bioner_stacking');
    }

    public function update_profit($id_user, $total_bonus)
    {
        $this->db->set('profit', 'profit + ' . $total_bonus, FALSE);
        $this->db->set('updated_at', date('Y-m-d H:i:s'));
        $this->db->where('id_user', $id_user);
        return $this->db->update('users_bioner_stacking');
    }

    public function reduce_profit($id_user, $total_bonus)
    {
        $this->db->set('profit', 'profit - ' . $total_bonus, FALSE);
        $this->db->set('updated_at', date('Y-m-d H:i:s'));
        $this->db->where('id_user', $id_user);
        return $this->db->update('users_bioner_stacking');
    }

    public function get_user_rekeing()
    {
        $id_user = $this->session->userdata(SESS . 'id');

        $this->db->select([
            'user_banks.id',
            'user_banks.no_rekening',
            'param_banks.nama_bank',
            'user_banks.atas_nama',
        ]);
        $this->db->join('param_banks', 'param_banks.id = user_banks.id_bank', 'left');
        $this->db->where('user_banks.id_user', $id_user);
        $this->db->where('user_banks.deleted_at', NULL);
        return $this->db->get('user_banks');
    }

    public function distribusi_bioner_stacking()
    {
        $this->db->where('status', 'aktif');
        $this->db->where('deleted_at', NULL);
        $arr_bioner_stacking = $this->db->get('bioner_stacking');

        if ($arr_bioner_stacking->num_rows() > 0) {
            foreach ($arr_bioner_stacking->result() as $key) {
                $id               = $key->id;
                $id_user          = $key->id_user;
                $kode             = $key->kode;
                $profit_perhari_b = $key->profit_perhari_b;

                $this->db->set('profit', 'profit + ' . $profit_perhari_b, FALSE);
                $this->db->set('updated_at', date('Y-m-d H:i:s'));
                $this->db->where('id_user', $id_user);
                $exec_users_bioner_stacking = $this->db->update('users_bioner_stacking');

                $this->db->set('updated_at', date('Y-m-d H:i:s'));
                $this->db->where('id', $id);
                $exec_bioner_stacking = $this->db->update('bioner_stacking');

                $this->db->set([
                    'id_user'            => $id_user,
                    'id_bioner_stacking' => $id,
                    'type'               => 'profit',
                    'nominal_b'          => $profit_perhari_b,
                    'nominal_rp'         => $profit_perhari_b * 10000,
                    'kode'               => $kode,
                    'keterangan'         => 'Distribusi Profit Sebesar ' . $profit_perhari_b . ' Bioner',
                    'created_at'         => date('Y-m-d H:i:s'),
                ]);
                $exec_bioner_stacking_logs = $this->db->insert('bioner_stacking_logs');

                $this->db->set('updated_at', date('Y-m-d H:i:s'));
                $this->db->where('id', $id_user);
                $exec_users = $this->db->update('users');
            }
        }
    }

    public function get_user_withdraw($id_user)
    {
        $this->db->select([
            'user_bioner_stacking_withdraw.id',
            'user_bioner_stacking_withdraw.id_user',
            'user_bioner_stacking_withdraw.id_user_bank',
            'user_bioner_stacking_withdraw.id_user_wallet',
            'user_bioner_stacking_withdraw.kode_withdraw',
            'user_bioner_stacking_withdraw.kode_invest',
            'user_bioner_stacking_withdraw.withdraw_b',
            'user_bioner_stacking_withdraw.withdraw_rp',
            'user_bioner_stacking_withdraw.status',
            'user_bioner_stacking_withdraw.created_at',
            'param_banks.nama_bank',
            'user_banks.no_rekening',
            'user_banks.atas_nama',
            'user_wallets.no_wallet',
        ]);
        $this->db->join('user_banks', 'user_banks.id = user_bioner_stacking_withdraw.id_user_bank', 'left');
        $this->db->join('param_banks', 'param_banks.id = user_banks.id_bank', 'left');
        $this->db->join('user_wallets', 'user_wallets.id = user_bioner_stacking_withdraw.id_user_wallet', 'left');
        $this->db->where('user_bioner_stacking_withdraw.id_user', $id_user);
        $this->db->where('user_bioner_stacking_withdraw.deleted_at', NULL);
        $this->db->order_by('user_bioner_stacking_withdraw.id', 'DESC');
        return $this->db->get('user_bioner_stacking_withdraw');
    }
}
                        
/* End of file M_stacking.php */
