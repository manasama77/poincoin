<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PekerjaansController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('TemplateAdmin', NULL, 'template');
    }

    public function index()
    {
        $data['title']   = 'Pekerjaan Management';
        $data['content'] = 'pekerjaans/index';
        $data['vitamin'] = 'pekerjaans/index_vitamin';
        $data['data']    = $this->mcore->get('pekerjaans', '*', ['deleted_at' => NULL]);
        $this->template->template($data);
    }

    public function store()
    {
        $nama = $this->input->post('nama');

        $check_nama_duplikat = $this->_check_duplikat_nama($nama);

        if ($check_nama_duplikat === FALSE) {
            echo json_encode(['code' => 400]);
            exit;
        }

        $exec = $this->mcore->store('pekerjaans', ['nama' => $nama]);

        if (!$exec) {
            echo json_encode(['code' => 500]);
            exit;
        }

        echo json_encode(['code' => 200]);
    }

    public function update()
    {
        $id   = $this->input->post('id_edit');
        $nama = $this->input->post('nama_edit');

        $check_nama_duplikat = $this->_check_duplikat_nama($nama);

        if ($check_nama_duplikat === FALSE) {
            echo json_encode(['code' => 400]);
            exit;
        }

        $exec = $this->mcore->update('pekerjaans', ['nama' => $nama], ['id' => $id]);

        $ret = ['code' => 200];
        if (!$exec) {
            $ret = ['code' => 500];
        }

        echo json_encode($ret);
    }

    public function destroy()
    {
        $cur_date = new DateTime('now');
        $id = $this->input->post('id');

        $object = ['deleted_by' => $this->session->userdata(SESS . 'id'), 'deleted_at' => $cur_date->format('Y-m-d H:i:s')];
        $where  = ['id' => $id];
        $exec   = $this->mcore->update('pekerjaans', $object, $where);

        if ($exec) {
            $ret = ['code' => 200];
        } else {
            $ret = ['code' => 500];
        }

        echo json_encode($ret);
    }

    public function _check_duplikat_nama($str)
    {
        $count = $this->mcore->count('pekerjaans', ['nama' => $str, 'deleted_at' => NULL]);

        if ($count == 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}

/* End of file  PekerjaansController.php */
