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
        $data['title']   = 'Dashboard';
        $data['content'] = 'dashboard/index';
        $data['vitamin'] = 'dashboard/index_vitamin';

        $data['count_referal'] = $this->M_dashboard->count_referal();

        $this->template->template($data);
    }
}
        
    /* End of file  DashboardUserController.php */
