<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CustomersController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('TemplateAdmin', NULL, 'template');
        $this->load->model('M_customers_less', 'mless');
    }

    public function index()
    {
        $data['title']   = 'Customer Management';
        $data['content'] = 'customers/index';
        $data['vitamin'] = 'customers/index_vitamin';
        $this->template->template($data);
    }

    public function add()
    {
        $data['title']      = 'Add Customer';
        $data['content']    = 'customers/form';
        $data['vitamin']    = 'customers/form_vitamin';
        $data['pekerjaans'] = $this->mcore->get('pekerjaans', '*', ['deleted_at' => NULL]);
        $this->template->template($data);
    }

    public function store()
    {
        $no_ktp           = $this->input->post('no_ktp');
        $nama             = $this->input->post('nama');
        $alias            = $this->input->post('alias');
        $tgl_lahir        = $this->input->post('tgl_lahir');
        $alamat           = $this->input->post('alamat');
        $no_telp          = $this->input->post('no_telp');
        $email            = $this->input->post('email');
        $id_pekerjaan     = $this->input->post('id_pekerjaan');
        $hubungan         = $this->input->post('hubungan');
        $nama_penjamin    = $this->input->post('nama_penjamin');
        $no_telp_penjamin = $this->input->post('no_telp_penjamin');
        $created_by       = $this->session->userdata(SESS . 'id');
        $tgl_obj          = new DateTime('now');

        $check_ktp = $this->_check_duplikat('no_ktp', $no_ktp);
        if ($check_ktp === FALSE) {
            echo json_encode(['code' => 400, 'field' => 'no_ktp', 'msg' => 'No KTP Telah Terdaftar']);
            exit;
        }

        $gambar_name = NULL;
        if (!empty($_FILES['foto_ktp']['name'])) {
            $config['upload_path']      = './public/img/ktp/';
            $config['allowed_types']    = 'gif|jpg|png';
            $config['overwrite']        = TRUE;
            $config['file_ext_tolower'] = TRUE;
            $config['encrypt_name']     = TRUE;
            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('foto_ktp')) {
                echo json_encode(['code' => 500, 'msg' => $this->upload->display_errors()]);
                exit;
            } else {
                $gambar_name = $this->upload->data('file_name');
            }
        }

        $data = [
            'no_ktp'           => $no_ktp,
            'nama'             => $nama,
            'alias'            => $alias,
            'tgl_lahir'        => $tgl_lahir,
            'alamat'           => $alamat,
            'no_telp'          => $no_telp,
            'email'            => $email,
            'id_pekerjaan'     => $id_pekerjaan,
            'hubungan'         => $hubungan,
            'nama_penjamin'    => $nama_penjamin,
            'no_telp_penjamin' => $no_telp_penjamin,
            'foto_ktp'         => $gambar_name,
            'created_by'       => $created_by,
            'created_at'       => $tgl_obj->format('Y-m-d H:i:s'),
        ];
        $exec = $this->mcore->store('customers', $data);

        $ret = ['code' => 200];
        if (!$exec) {
            $ret = ['code' => 500];
        }

        echo json_encode($ret);
    }

    public function edit($id = NULL)
    {
        if ($id == NULL) {
            show_404();
            exit;
        }

        $data['title']      = 'Edit Customer';
        $data['content']    = 'customers/form_edit';
        $data['vitamin']    = 'customers/form_edit_vitamin';
        $data['pekerjaans'] = $this->mcore->get('pekerjaans', '*', ['deleted_at' => NULL]);

        $arrs = $this->mcore->get('customers', '*', ['id' => $id], NULL, NULL, '1');

        if ($arrs->num_rows() == 0) {
            show_404();
            exit;
        }

        $data['data']['id']               = $arrs->row()->id;
        $data['data']['no_ktp']           = $arrs->row()->no_ktp;
        $data['data']['nama']             = $arrs->row()->nama;
        $data['data']['alias']            = $arrs->row()->alias;
        $data['data']['tgl_lahir']        = $arrs->row()->tgl_lahir;
        $data['data']['alamat']           = $arrs->row()->alamat;
        $data['data']['no_telp']          = $arrs->row()->no_telp;
        $data['data']['email']            = $arrs->row()->email;
        $data['data']['id_pekerjaan']     = $arrs->row()->id_pekerjaan;
        $data['data']['hubungan']         = $arrs->row()->hubungan;
        $data['data']['nama_penjamin']    = $arrs->row()->nama_penjamin;
        $data['data']['no_telp_penjamin'] = $arrs->row()->no_telp_penjamin;
        $data['data']['foto_ktp']         = $arrs->row()->foto_ktp;

        $this->template->template($data);
    }

    public function update()
    {
        $no_ktp           = $this->input->post('no_ktp');
        $nama             = $this->input->post('nama');
        $alias            = $this->input->post('alias');
        $tgl_lahir        = $this->input->post('tgl_lahir');
        $alamat           = $this->input->post('alamat');
        $no_telp          = $this->input->post('no_telp');
        $email            = $this->input->post('email');
        $id_pekerjaan     = $this->input->post('id_pekerjaan');
        $hubungan         = $this->input->post('hubungan');
        $nama_penjamin    = $this->input->post('nama_penjamin');
        $no_telp_penjamin = $this->input->post('no_telp_penjamin');
        $id               = $this->input->post('id');
        $prev_no_ktp      = $this->input->post('prev_no_ktp');
        $prev_foto_ktp    = $this->input->post('prev_foto_ktp');
        $updated_by       = $this->session->userdata(SESS . 'id');
        $tgl_obj          = new DateTime('now');

        if ($no_ktp != $prev_no_ktp) {
            $check_ktp = $this->_check_duplikat('no_ktp', $no_ktp);
            if ($check_ktp === FALSE) {
                echo json_encode(['code' => 400, 'field' => 'no_ktp', 'msg' => 'No KTP Telah Terdaftar']);
                exit;
            }
        }

        $gambar_name = $prev_foto_ktp;
        if (!empty($_FILES['foto_ktp']['name'])) {
            $config['upload_path']      = './public/img/ktp/';
            $config['allowed_types']    = 'gif|jpg|png';
            $config['overwrite']        = TRUE;
            $config['file_ext_tolower'] = TRUE;
            $config['encrypt_name']     = TRUE;
            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('foto_ktp')) {
                echo json_encode(['code' => 500, 'msg' => $this->upload->display_errors()]);
                exit;
            } else {
                $gambar_name = $this->upload->data('file_name');
            }
        }

        $data = [
            'no_ktp'           => $no_ktp,
            'nama'             => $nama,
            'alias'            => $alias,
            'tgl_lahir'        => $tgl_lahir,
            'alamat'           => $alamat,
            'no_telp'          => $no_telp,
            'email'            => $email,
            'id_pekerjaan'     => $id_pekerjaan,
            'hubungan'         => $hubungan,
            'nama_penjamin'    => $nama_penjamin,
            'no_telp_penjamin' => $no_telp_penjamin,
            'foto_ktp'         => $gambar_name,
            'updated_by'       => $updated_by,
            'updated_at'       => $tgl_obj->format('Y-m-d H:i:s'),
        ];
        $exec = $this->mcore->update('customers', $data, ['id' => $id]);

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

        $object = [
            'deleted_at' => $cur_date->format('Y-m-d H:i:s'),
            'deleted_by' => $this->session->userdata(SESS . 'id')
        ];
        $where  = ['id' => $id];
        $exec   = $this->mcore->update('customers', $object, $where);

        if ($exec) {
            $ret = ['code' => 200];
        } else {
            $ret = ['code' => 500];
        }

        echo json_encode($ret);
    }

    public function datatables()
    {
        $list = $this->mless->get_datatables();
        $data = array();
        $no   = $_POST['start'];
        foreach ($list as $field) {
            $no++;
            $row = array();

            $row['id']               = $field->id;
            $row['no_ktp']           = $field->no_ktp;
            $row['nama']             = $field->nama;
            $row['alias']            = $field->alias;
            $row['tgl_lahir']        = $field->tgl_lahir;
            $row['alamat']           = $field->alamat;
            $row['no_telp']          = $field->no_telp;
            $row['email']            = $field->email;
            $row['nama_pekerjaan']   = $field->nama_pekerjaan;
            $row['hubungan']         = $field->hubungan;
            $row['nama_penjamin']    = $field->nama_penjamin;
            $row['no_telp_penjamin'] = $field->no_telp_penjamin;
            $row['foto_ktp_name']    = $field->foto_ktp;

            $foto_ktp = base_url() . 'public/img/ktp/avatar_default.png';
            if ($field->foto_ktp != NULL) {
                $foto_ktp = base_url() . 'public/img/ktp/' . $field->foto_ktp;
            }

            $row['foto_ktp']  = '<img src="' . $foto_ktp . '" class="img-thumbnail" />';

            $data[]       = $row;
        }

        $output = array(
            "draw"            => $_POST['draw'],
            "recordsTotal"    => $this->mless->count_all(),
            "recordsFiltered" => $this->mless->count_filtered(),
            "data"            => $data,
        );

        echo json_encode($output);
    }

    public function _check_duplikat($field, $str)
    {
        $check = $this->mcore->count('customers', [$field => $str, 'deleted_at' => NULL]);

        if ($check == 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}

/* End of file  CustomersController.php */
