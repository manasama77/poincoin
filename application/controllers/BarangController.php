<?php
defined('BASEPATH') or exit('No direct script access allowed');

class BarangController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('TemplateAdmin', NULL, 'template');
        $this->load->model('M_barang_less', 'mless');
    }

    public function index()
    {
        $data['title']     = 'Barang Management';
        $data['content']   = 'barang/index';
        $data['vitamin']   = 'barang/index_vitamin';
        $data['kategoris'] = $this->mcore->get('kategori', '*', ['deleted_by' => NULL], 'nama', 'ASC');

        $barangs = $this->mcore->get('barang', '*', ['deleted_by' => NULL], 'nama', 'ASC');

        $arr = [];

        if (!$barangs) {
            show_error("Failed to get Array Barang", 500, 'An Error Was Encountered');
            exit;
        }

        if ($barangs->num_rows() > 0) {
            foreach ($barangs->result() as $barang) {
                $id              = $barang->id;
                $nama            = $barang->nama;
                $id_kategori     = $barang->id_kategori;
                $id_vendor       = $barang->id_vendor;
                $id_jenis_barang = $barang->id_jenis_barang;
                $spesifikasi     = $barang->spesifikasi;
                $hpp             = number_format($barang->hpp, 0);

                $nama_kategori = "";
                if ($id_kategori != NULL) {
                    $arr_kategori = $this->mcore->get('kategori', '*', ['id' => $id_kategori]);

                    if (!$arr_kategori) {
                        show_error("Failed to get Array Kategori", 500, 'An Error Was Encountered');
                        exit;
                    }

                    if ($arr_kategori->num_rows() > 0) {
                        $nama_kategori = $arr_kategori->row()->nama;
                    }
                }

                $nama_vendor = "";
                if ($id_vendor != NULL) {
                    $arr_vendor = $this->mcore->get('vendor', '*', ['id' => $id_vendor]);

                    if (!$arr_vendor) {
                        show_error("Failed to get Array Vendor", 500, 'An Error Was Encountered');
                        exit;
                    }

                    if ($arr_vendor->num_rows() > 0) {
                        $nama_vendor = $arr_vendor->row()->nama;
                    }
                }

                $nama_jenis_barang = "";
                if ($id_jenis_barang != NULL) {
                    $arr_jenis_barang = $this->mcore->get('jenis_barang', '*', ['id' => $id_jenis_barang]);

                    if (!$arr_jenis_barang) {
                        show_error("Failed to get Array Jenis Barang", 500, 'An Error Was Encountered');
                        exit;
                    }

                    if ($arr_jenis_barang->num_rows() > 0) {
                        $nama_jenis_barang = $arr_jenis_barang->row()->nama;
                    }
                }

                $nested = [
                    'id'                => $id,
                    'nama'              => $nama,
                    'id_kategori'       => $id_kategori,
                    'id_vendor'         => $id_vendor,
                    'id_jenis_barang'   => $id_jenis_barang,
                    'spesifikasi'       => $spesifikasi,
                    'hpp'               => $hpp,
                    'nama_kategori'     => $nama_kategori,
                    'nama_vendor'       => $nama_vendor,
                    'nama_jenis_barang' => $nama_jenis_barang,
                ];

                array_push($arr, $nested);
            }

            $data['barangs'] = $arr;
        }


        $this->template->template($data);
    }

    public function show()
    {
        $id              = $this->input->get('id');
        $id_jenis_barang = $this->input->get('id_jenis_barang');

        $where = ['deleted_at' => NULL];

        if ($id != NULL) {
            $where['id'] = $id;
        }

        if ($id_jenis_barang != NULL) {
            $where['id_jenis_barang'] = $id_jenis_barang;
        }


        $arr = $this->mcore->get('barang', '*', $where, 'nama', 'asc');

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
        $nama            = $this->input->post('nama');
        $id_kategori     = $this->input->post('id_kategori');
        $id_vendor       = $this->input->post('id_vendor');
        $id_jenis_barang = $this->input->post('id_jenis_barang');
        $spesifikasi     = trim($this->input->post('spesifikasi'), TRUE);
        $hpp             = str_replace(',', '', $this->input->post('hpp'));
        $tgl_obj_now     = new DateTime('now');

        $data = [
            'nama'            => $nama,
            'id_kategori'     => $id_kategori,
            'id_vendor'       => $id_vendor,
            'id_jenis_barang' => $id_jenis_barang,
            'spesifikasi'     => $spesifikasi,
            'hpp'             => $hpp,
            'created_at'      => $tgl_obj_now->format('Y-m-d H:i:s'),
            'created_by'      => $this->session->userdata(SESS . 'id'),
            'updated_at'      => $tgl_obj_now->format('Y-m-d H:i:s'),
            'updated_by'      => $this->session->userdata(SESS . 'id'),
            'deleted_at'      => NULL,
            'deleted_by'      => NULL,
        ];

        $exec = $this->mcore->store('barang', $data);

        $ret = ['code' => 500];
        if ($exec) {
            $ret = ['code' => 200];
        }

        echo json_encode($ret);
    }

    public function update()
    {
        $id                   = $this->input->post('id_edit');
        $id_kategori          = $this->input->post('id_kategori_edit');
        $id_vendor            = $this->input->post('id_vendor_edit');
        $id_jenis_barang      = $this->input->post('id_jenis_barang_edit');
        $nama                 = $this->input->post('nama_edit');
        $spesifikasi          = trim($this->input->post('spesifikasi_edit'));
        $hpp                  = str_replace(',', '', $this->input->post('hpp_edit'));
        $tgl_obj_now          = new DateTime('now');
        $prev_nama            = $this->input->post('prev_nama');
        $prev_id_jenis_barang = $this->input->post('prev_id_jenis_barang');

        $check = TRUE;
        if ($nama != $prev_nama && $id_jenis_barang != $prev_id_jenis_barang) {
            $check = $this->_check_duplikat_nama($nama, $id_jenis_barang);
        }

        if ($check == FALSE) {
            echo json_encode(['code' => 400]);
            exit;
        }

        $data = [
            'id_kategori'     => $id_kategori,
            'id_vendor'       => $id_vendor,
            'id_jenis_barang' => $id_jenis_barang,
            'nama'            => $nama,
            'spesifikasi'     => $spesifikasi,
            'hpp'             => $hpp,
            'updated_at'      => $tgl_obj_now->format('Y-m-d H:i:s'),
            'updated_by'      => $this->session->userdata(SESS . 'id'),
        ];

        $exec = $this->mcore->update('barang', $data, ['id' => $id]);

        if (!$exec) {
            echo json_encode(['code' => 500]);
            exit;
        }

        echo json_encode(['code' => 200]);
    }

    public function destroy()
    {
        $cur_date = new DateTime('now');
        $id = $this->input->post('id');

        $object = ['deleted_at' => $cur_date->format('Y-m-d H:i:s'), 'deleted_by' => $this->session->userdata(SESS . 'id')];
        $where  = ['id' => $id];
        $exec   = $this->mcore->update('barang', $object, $where);

        if ($exec) {
            $ret = ['code' => 200];
        } else {
            $ret = ['code' => 500];
        }

        echo json_encode($ret);
    }

    public function get_list_barang_by_id_jenis_barang()
    {
        $id_jenis_barang = $this->input->get('id_jenis_barang');

        if ($id_jenis_barang == NULL) {
            echo json_encode(['code' => 404]);
            exit;
        }

        $exec = $this->mcore->get('barang', '*', ['id_jenis_barang' => $id_jenis_barang, 'deleted_at' => NULL]);

        if ($exec->num_rows() == 0) {
            echo json_encode(['code' => 404]);
            exit;
        }

        $ret = [
            'code' => 200,
            'data' => $exec->result()
        ];
        echo json_encode($ret);
    }

    public function _check_duplikat_nama($str, $id_jenis_barang)
    {
        $count = $this->mcore->count('barang', ['id_jenis_barang' => $id_jenis_barang, 'nama' => $str, 'deleted_at' => NULL]);

        if ($count == 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}

/* End of file  BarangController.php */
