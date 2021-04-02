<?php

defined('BASEPATH') or exit('No direct script access allowed');

class LandingController extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->library('user_agent');
    }


    public function index()
    {
        $data = [];
        $this->load->view('landing', $data, FALSE);
    }

    public function guestbook_add()
    {
        $code = 500;
        if ($this->agent->is_browser() || $this->agent->is_mobile()) {
            $nama       = trim($this->input->post('nama'));
            $email      = trim($this->input->post('email'));
            $phone      = trim($this->input->post('phone'));
            $subject    = trim($this->input->post('subject'));
            $pesan      = nl2br($this->input->post('pesan'));
            $created_at = date('Y-m-d H:i:s');
            $deleted_at = null;

            if ($this->agent->is_browser()) {
                $agent_browser = $this->agent->browser();
                $agent_version = $this->agent->version();
                $agent_mobile  = null;
            } else if ($this->agent->is_mobile()) {
                $agent_browser = null;
                $agent_version = null;
                $agent_mobile  = $this->agent->mobile();
            }

            $data = compact('nama', 'email', 'phone', 'subject', 'pesan', 'agent_browser', 'agent_version', 'agent_mobile', 'created_at');

            $exec = $this->mcore->store('guestbooks', $data);

            if ($exec) {
                $code = 200;
            }
        }

        echo json_encode(['code' => $code]);
    }
}
        
    /* End of file  LandingController.php */
