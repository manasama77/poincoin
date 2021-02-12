<?php

defined('BASEPATH') or exit('No direct script access allowed');

class IndodaxController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('TemplateUser', NULL, 'template');
    }

    public function setup()
    {
        $id_user = $this->session->userdata(SESS . 'id');

        $data['title']   = 'Indodax Setup';
        $data['content'] = 'indodax_setup/index';
        $data['vitamin'] = 'indodax_setup/index_vitamin';

        $where = ['id' => $id_user];
        $arr = $this->mcore->get('users', 'api_indodax, secret_indodax', $where);

        $data['api_indodax']    = $arr->row()->api_indodax;
        $data['secret_indodax'] = $arr->row()->secret_indodax;

        if ($arr->row()->api_indodax != "") {
            $data['api_disabled'] = true;
        }

        if ($arr->row()->api_indodax != "") {
            $data['api_disabled'] = true;
        }

        $this->template->template($data);
    }
}
        
    /* End of file  IndodaxController.php */
