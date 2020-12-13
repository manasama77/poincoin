<?php
defined('BASEPATH') or exit('No direct script access allowed');

class VendorController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('TemplateAdmin', NULL, 'template');
    }

    public function index()
    {
        $data['title']     = 'Vendor Management';
        $data['content']   = 'vendor/index';
        $data['vitamin']   = 'vendor/index_vitamin';
        $data['kategoris'] = $this->mcore->get('kategori', '*', ['deleted_at' => NULL]);

        $arr_vendor = $this->mcore->get('vendor', '*', ['deleted_at' => NULL]);

        $data['datas'] = array();
        if ($arr_vendor) {
            if ($arr_vendor->num_rows() > 0) {
                foreach ($arr_vendor->result() as $key) {
                    $id            = $key->id;
                    $id_kategori   = $key->id_kategori;
                    $nama          = $key->nama;
                    $nama_kategori = '';

                    $arr_kategori = $this->mcore->get('kategori', '*', ['id' => $id_kategori]);

                    if ($arr_kategori) {
                        if ($arr_kategori->num_rows() == 1) {
                            $nama_kategori = $arr_kategori->row()->nama;
                        }
                    }

                    $nested = [
                        'id'            => $id,
                        'id_kategori'   => $id_kategori,
                        'nama_kategori' => $nama_kategori,
                        'nama'          => $nama,
                    ];
                    array_push($data['datas'], $nested);
                }
            }
        }

        $this->template->template($data);
    }

    public function show()
    {
        $id = $this->input->get('id');
        $id_kategori = $this->input->get('id_kategori');

        $where = ['deleted_at' => NULL];

        if ($id != NULL) {
            $where['id'] = $id;
        }

        if ($id_kategori != NULL) {
            $where['id_kategori'] = $id_kategori;
        }


        $arr = $this->mcore->get('vendor', '*', $where, 'nama', 'asc');

        if (!$arr) {
            echo json_encode(['code' => 500]);
            exit;
        }

        if ($arr->num_rows() == 0) {
            echo json_encode(['code' => 404]);
            exit;
        }

        echo json_encode(['code' => 200, 'data' => $arr->result()]);
    }

    public function store()
    {
        $id_kategori = $this->input->post('id_kategori');
        $nama        = $this->input->post('nama');

        $check_nama_duplikat = $this->_check_duplikat_nama($nama, $id_kategori);

        if ($check_nama_duplikat === FALSE) {
            echo json_encode(['code' => 409]);
            exit;
        }

        $exec = $this->mcore->store('vendor', ['id_kategori' => $id_kategori, 'nama' => $nama]);

        if (!$exec) {
            echo json_encode(['code' => 500]);
            exit;
        }

        echo json_encode(['code' => 201]);
    }

    public function update()
    {
        $id          = $this->input->post('id_edit');
        $id_kategori = $this->input->post('id_kategori_edit');
        $nama        = $this->input->post('nama_edit');

        $check_nama_duplikat = $this->_check_duplikat_nama($nama, $id_kategori);

        if ($check_nama_duplikat === FALSE) {
            echo json_encode(['code' => 400]);
            exit;
        }

        $exec = $this->mcore->update('vendor', ['nama' => $nama, 'id_kategori' => $id_kategori], ['id' => $id]);

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
        $exec   = $this->mcore->update('vendor', $object, $where);

        if ($exec) {
            $ret = ['code' => 204];
        } else {
            $ret = ['code' => 500];
        }

        echo json_encode($ret);
    }

    public function _check_duplikat_nama($str, $id_kategori)
    {
        $count = $this->mcore->count('vendor', ['nama' => $str, 'id_kategori' => $id_kategori, 'deleted_at' => NULL]);

        if ($count == 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}

/* End of file  VendorController.php */
