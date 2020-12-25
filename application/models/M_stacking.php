<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_stacking extends CI_Model
{

    public function count_today_stack()
    {
        $this->db->where_in('status', [
            'aktif',
            'menunggu_transfer',
            'menunggu_verifikasi',
        ]);
        $this->db->where('DATE(created_at)', date('Y-m-d'));
        return $this->db->get('bioner_stacking');
    }

    public function count_bioner_profit($id_user)
    {
        $this->db->select('SUM(current_profit) AS current_profit');
        $this->db->where('id_user', $id_user);
        $this->db->where('status', 'aktif');
        return $this->db->get('bioner_stacking');
    }

    public function count_total_investment($id_user)
    {
        $this->db->select('SUM(total_investment) AS total_investment');
        $this->db->where('id_user', $id_user);
        $this->db->where('status', 'aktif');
        return $this->db->get('bioner_stacking');
    }

    public function update_total_investment($id_user, $total_investment)
    {
        $this->db->set('total_investment', 'total_investment + ' . $total_investment);
        $this->db->where('id', $id_user);
        return $this->db->update('users');
    }

    public function update_bonus_balance($id_user, $total_bonus)
    {
        $this->db->set('bonus_balance', 'bonus_balance + ' . $total_bonus);
        $this->db->where('id', $id_user);
        return $this->db->update('users');
    }
}
                        
/* End of file M_stacking.php */
