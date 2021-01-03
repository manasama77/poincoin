<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_users extends CI_Model
{

    public function get_user_bank_data()
    {
        $id_user = $this->session->userdata(SESS . 'id');

        $this->db->select([
            'user_banks.id',
            'user_banks.id_user',
            'user_banks.no_rekening',
            'user_banks.id_bank',
            'user_banks.atas_nama',
            'param_banks.nama_bank',
            'param_banks.kode_bank',
        ]);
        $this->db->join('param_banks', 'param_banks.id = user_banks.id_bank', 'left');
        $this->db->where('user_banks.id_user', $id_user);
        $this->db->where('user_banks.deleted_at IS NULL', NULL, FALSE);
        $this->db->order_by('user_banks.id', 'asc');
        return $this->db->get('user_banks');
    }
}
                        
/* End of file M_users.php */
