<?php

defined('BASEPATH') or exit('No direct script access allowed');

class UserLoginController extends CI_Controller
{

    public function index()
    {
        $this->load->view('login_user');
    }
}
        
    /* End of file  UserLoginController.php */
