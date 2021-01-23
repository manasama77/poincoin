<?php

defined('BASEPATH') or exit('No direct script access allowed');

class DashboardUserController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('TemplateUser', NULL, 'template');
        $this->load->model('M_dashboard');
    }

    public function index()
    {
        $data['title']         = 'Dashboard';
        $data['content']       = 'dashboard/index';
        $data['vitamin']       = 'dashboard/index_vitamin';
        $data['arr_news']      = $this->mcore->get('news', '*', ['deleted_at' => NULL, 'status' => 'show'], 'id', 'DESC');
        $data['count_referal'] = $this->M_dashboard->count_referal();
        $data['count_bank']    = $this->mcore->count('user_banks', ['id_user' => $this->session->userdata(SESS . 'id')]);
        $data['count_wallet']  = $this->mcore->count('user_wallets', ['id_user' => $this->session->userdata(SESS . 'id')]);

        $this->template->template($data);
    }
}
        
    /* End of file  DashboardUserController.php */
