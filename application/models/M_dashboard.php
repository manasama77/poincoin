<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_dashboard extends CI_Model
{

    public function count_referal()
    {
        $this->db->where('users.id_referal', $this->session->userdata(SESS . 'id'));
        return $this->db->get('users');
    }
}
                        
/* End of file M_dashboard.php */
