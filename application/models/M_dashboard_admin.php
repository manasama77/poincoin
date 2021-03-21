<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_dashboard_admin extends CI_Model
{

    public function get_stacking_idr()
    {
        $this->db->select('sum(bioner_stacking.total_investment) as stacking_idr');
        $this->db->where('status', 'aktif');
        $this->db->where('deleted_at', NULL);
        return $this->db->get('bioner_stacking');
    }

    public function get_trade_idr()
    {
        $this->db->select('count(id) as trade_count');
        $this->db->where('status', 'aktif');
        $this->db->where('deleted_at', NULL);
        return $this->db->get('bioner_trade');
    }
}
                        
/* End of file M_dashboard_admin.php */
