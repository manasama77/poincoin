<?php
defined('BASEPATH') or exit('No direct script access allowed');

class JenisBarangController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('TemplateAdmin', NULL, 'template');
    }

    public function index()
    {
        $data['title']   = 'Jenis Barang';
        $data['content'] = 'jenis_barang/index';
        $data['vitamin'] = 'jenis_barang/index_vitamin';

        $arr_jenis_barang = $this->mcore->get('jenis_barang', '*', ['deleted_at' => NULL]);
        if (!$arr_jenis_barang) {
            show_error("Failed to get Array Jenis Barang", 500, 'An Error Was Encountered');
            exit;
        }

        $arr               = [];
        $id_vendor         = "";
        $id_jenis_barang   = "";
        $nama_jenis_barang = "";

        if ($arr_jenis_barang->num_rows() > 0) {
            foreach ($arr_jenis_barang->result() as $k) {
                $id_vendor         = $k->id_vendor;
                $id_jenis_barang   = $k->id;
                $nama_jenis_barang = $k->nama;

                $nama_vendor = "";
                if ($id_vendor != NULL) {
                    $arr_vendor = $this->mcore->get('vendor', '*', ['deleted_at' => NULL, 'id' => $id_vendor]);
                    if (!$arr_vendor) {
                        show_error("Failed to get Array Vendor", 500, 'An Error Was Encountered');
                        exit;
                    }

                    if ($arr_vendor->num_rows() == 1) {
                        $nama_vendor = $arr_vendor->row()->nama;
                        $id_kategori = $arr_vendor->row()->id_kategori;

                        $nama_kategori = "";
                        if ($id_kategori != NULL) {
                            $arr_kategori = $this->mcore->get('kategori', '*', ['deleted_at' => NULL, 'id' => $id_kategori]);

                            if (!$arr_kategori) {
                                show_error("Failed to get Array Kategori", 500, 'An Error Was Encountered');
                                exit;
                            }

                            if ($arr_kategori->num_rows() == 1) {
                                $nama_kategori = $arr_kategori->row()->nama;
                            }
                        }
                    }
                }

                $nested = [
                    'id_kategori'       => $id_kategori,
                    'nama_kategori'     => $nama_kategori,
                    'id_vendor'         => $id_vendor,
                    'nama_vendor'       => $nama_vendor,
                    'id_jenis_barang'   => $id_jenis_barang,
                    'nama_jenis_barang' => $nama_jenis_barang,
                ];

                array_push($arr, $nested);
            }
        }

        $data['datas'] = $arr;

        $data['kategoris'] = $this->mcore->get('kategori', '*', ['deleted_at' => NULL]);

        $this->template->template($data);
    }

    public function show()
    {
        $id        = $this->input->get('id');
        $id_vendor = $this->input->get('id_vendor');

        $where = ['deleted_at' => NULL];

        if ($id != NULL) {
            $where['id'] = $id;
        }

        if ($id_vendor != NULL) {
            $where['id_vendor'] = $id_vendor;
        }


        $arr = $this->mcore->get('jenis_barang', '*', $where, 'nama', 'asc');

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
        $id_vendor   = $this->input->post('id_vendor');
        $nama        = $this->input->post('nama');

        $check_nama_duplikat = $this->_check_duplikat_nama($nama, $id_vendor);

        if ($check_nama_duplikat === FALSE) {
            echo json_encode(['code' => 400]);
            exit;
        }

        $data = [
            'id_vendor'  => $id_vendor,
            'nama'       => $nama,
            'created_by' => $this->session->userdata(SESS . 'id'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_by' => $this->session->userdata(SESS . 'id'),
            'updated_at' => date('Y-m-d H:i:s'),
            'deleted_by' => NULL,
            'deleted_at' => NULL,
        ];

        $exec = $this->mcore->store('jenis_barang', $data);

        if (!$exec) {
            echo json_encode(['code' => 500]);
            exit;
        }

        echo json_encode(['code' => 200]);
    }

    public function update()
    {
        $id        = $this->input->post('id_edit');
        $nama      = $this->input->post('nama_edit');
        $id_vendor = $this->input->post('id_vendor_edit');

        $check_nama_duplikat = $this->_check_duplikat_nama($nama, $id_vendor);

        if ($check_nama_duplikat === FALSE) {
            echo json_encode(['code' => 400]);
            exit;
        }

        $exec = $this->mcore->update('jenis_barang', ['id_vendor' => $id_vendor, 'nama' => $nama], ['id' => $id]);

        $ret = ['code' => 200];
        if (!$exec) {
            $ret = ['code' => 500];
        }

        echo json_encode($ret);
    }

    public function destroy()
    {
        $cur_date = new DateTime('now');
        $id       = $this->input->post('id');

        $object = ['deleted_by' => $this->session->userdata(SESS . 'id'), 'deleted_at' => $cur_date->format('Y-m-d H:i:s')];
        $where  = ['id' => $id];
        $exec   = $this->mcore->update('jenis_barang', $object, $where);

        if ($exec) {
            $ret = ['code' => 200];
        } else {
            $ret = ['code' => 500];
        }

        echo json_encode($ret);
    }

    public function _check_duplikat_nama($str, $id_vendor)
    {
        $count = $this->mcore->count('jenis_barang', ['id_vendor' => $id_vendor, 'nama' => $str, 'deleted_at' => NULL]);

        if ($count == 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}

/* End of file  JenisBarangController.php */
