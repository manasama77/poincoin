<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_trade extends CI_Model
{

    public function list_bioner_trade()
    {
        $this->db->select([
            'bioner_trade.id',
            'bioner_trade.kode',
            'bioner_trade.id_user',
            'users.nama',
            'bioner_trade.status',
            'bioner_trade.bukti_transfer',
            'bioner_trade.created_at',
            'bioner_trade.updated_at'
        ]);
        $this->db->join('users', 'users.id = bioner_trade.id_user', 'left');
        $this->db->where('bioner_trade.deleted_at', NULL);
        $this->db->where('users.deleted_at', NULL);
        $this->db->order_by('bioner_trade.id', 'DESC');
        return $this->db->get('bioner_trade');
    }

    public function list_bioner_trade_withdraw($tipe = 'pending')
    {
        $this->db->select([
            'user_bioner_trade_withdraw.id',
            'user_bioner_trade_withdraw.id_user',
            'user_bioner_trade_withdraw.id_user_bank',
            'user_bioner_trade_withdraw.kode_withdraw',
            'user_bioner_trade_withdraw.withdraw_rp',
            'user_bioner_trade_withdraw.status',
            'user_bioner_trade_withdraw.created_at',
            'user_bioner_trade_withdraw.updated_at',
            'user_banks.no_rekening',
            'user_banks.atas_nama',
            'param_banks.nama_bank',
            'users.nama',
        ]);
        $this->db->join('user_banks', 'user_banks.id = user_bioner_trade_withdraw.id_user_bank', 'left');
        $this->db->join('param_banks', 'param_banks.id = user_banks.id_bank', 'left');
        $this->db->join('users', 'users.id = user_bioner_trade_withdraw.id_user', 'left');
        $this->db->where('user_bioner_trade_withdraw.deleted_at', NULL);
        $this->db->where('users.deleted_at', NULL);
        $this->db->where('user_bioner_trade_withdraw.status', $tipe);
        $this->db->order_by('user_bioner_trade_withdraw.id', 'ASC');
        return $this->db->get('user_bioner_trade_withdraw');
    }

    public function count_today_stack()
    {
        $this->db->where_in('status', [
            'aktif',
            'pending',
            'menunggu_verifikasi',
        ]);
        $this->db->where('id_user', $this->session->userdata(SESS . 'id'));
        $this->db->where('DATE(created_at)', date('Y-m-d'));
        return $this->db->get('bioner_trade');
    }

    public function count_today_trade_withdraw()
    {
        $this->db->where_in('status', [
            'pending',
            'success'
        ]);
        $this->db->where('id_user', $this->session->userdata(SESS . 'id'));
        $this->db->where('DATE(created_at)', date('Y-m-d'));
        return $this->db->get('user_bioner_trade_withdraw');
    }

    public function count_balance_saldo($id_user)
    {
        $this->db->select('balance_saldo');
        $this->db->where('id_user', $id_user);
        $this->db->where('deleted_at', NULL);
        return $this->db->get('users_bioner_trade');
    }

    public function update_balance_saldo($id_user, $nilai)
    {
        $this->db->set('balance_saldo', 'balance_saldo + ' . $nilai, FALSE);
        $this->db->set('updated_at', date('Y-m-d H:i:s'));
        $this->db->where('id_user', $id_user);
        return $this->db->update('users_bioner_trade');
    }

    public function reduce_balance_saldo($id_user, $nilai)
    {
        $this->db->set('balance_saldo', 'balance_saldo - ' . $nilai, FALSE);
        $this->db->set('updated_at', date('Y-m-d H:i:s'));
        $this->db->where('id_user', $id_user);
        return $this->db->update('users_bioner_trade');
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

    public function get_user_withdraw($id_user)
    {
        $this->db->select([
            'user_bioner_trade_withdraw.id',
            'user_bioner_trade_withdraw.id_user',
            'user_bioner_trade_withdraw.id_user_bank',
            'user_bioner_trade_withdraw.kode_withdraw',
            'user_bioner_trade_withdraw.kode_invest',
            'user_bioner_trade_withdraw.withdraw_rp',
            'user_bioner_trade_withdraw.status',
            'user_bioner_trade_withdraw.created_at',
            'param_banks.nama_bank',
            'user_banks.no_rekening',
            'user_banks.atas_nama',
        ]);
        $this->db->join('user_banks', 'user_banks.id = user_bioner_trade_withdraw.id_user_bank', 'left');
        $this->db->join('param_banks', 'param_banks.id = user_banks.id_bank', 'left');
        $this->db->where('user_bioner_trade_withdraw.id_user', $id_user);
        $this->db->where('user_bioner_trade_withdraw.deleted_at', NULL);
        $this->db->order_by('user_bioner_trade_withdraw.id', 'DESC');
        return $this->db->get('user_bioner_trade_withdraw');
    }

    public function distribusi_bioner_trade()
    {
        $this->db->where('status', 'aktif');
        $this->db->where('deleted_at', NULL);
        $arr_bioner_trade = $this->db->get('bioner_trade');

        if ($arr_bioner_trade->num_rows() > 0) {
            foreach ($arr_bioner_trade->result() as $key) {
                $id               = $key->id;
                $id_user          = $key->id_user;
                $kode          = $key->kode;
                $profit_perhari_b = PROFIT_PER_DAY_TRADE;

                $this->db->set('balance_saldo', 'balance_saldo + ' . $profit_perhari_b, FALSE);
                $this->db->set('updated_at', date('Y-m-d H:i:s'));
                $this->db->where('id_user', $id_user);
                $exec_users_bioner_trade = $this->db->update('users_bioner_trade');

                $this->db->set('updated_at', date('Y-m-d H:i:s'));
                $this->db->where('id', $id);
                $exec_bioner_trade = $this->db->update('bioner_trade');

                $this->db->set([
                    'id_user'            => $id_user,
                    'id_bioner_trade' => $id,
                    'type'               => 'profit',
                    'kode'         => $kode,
                    'keterangan'         => 'Distribusi Profit Sebesar Rp.' . $profit_perhari_b,
                    'created_at'         => date('Y-m-d H:i:s'),
                ]);
                $exec_bioner_trade_logs = $this->db->insert('bioner_trade_logs');

                $this->db->set('updated_at', date('Y-m-d H:i:s'));
                $this->db->where('id', $id_user);
                $exec_users = $this->db->update('users');
            }

            $this->trigger_ask_bioner_trade();
        }
    }

    public function trigger_ask_bioner_trade()
    {
        $this->db->where('balance_saldo >', 0, FALSE);
        $this->db->where('deleted_at', NULL);
        $arr_bioner_trade = $this->db->get('users_bioner_trade');

        if ($arr_bioner_trade->num_rows() > 0) {
            foreach ($arr_bioner_trade->result() as $key) {
                $id               = $key->id;
                $id_user          = $key->id_user;
                $balance_saldo          = $key->balance_saldo;
                $trigger_ask = 'tidak';

                if (($balance_saldo % 750000) == 0) {
                    $trigger_ask = 'ya';
                }

                $this->db->set('trigger_ask', $trigger_ask);
                $this->db->set('updated_at', date('Y-m-d H:i:s'));
                $this->db->where('id_user', $id_user);
                $exec_users_bioner_trade = $this->db->update('users_bioner_trade');
            }
        }
    }
}
                        
/* End of file M_trade.php */
