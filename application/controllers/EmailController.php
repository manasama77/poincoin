<?php

defined('BASEPATH') or exit('No direct script access allowed');

class EmailController extends CI_Controller
{

    public function signup()
    {
        $data['arr'] = $this->mcore->get('users', '*', ['id' => '8']);
        $data['password_polos'] = "123";
        $this->load->view('email_signup', $data, FALSE);
    }
}
        
    /* End of file  EmailController.php */
