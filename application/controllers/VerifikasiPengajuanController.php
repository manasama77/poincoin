<?php
defined('BASEPATH') or exit('No direct script access allowed');

class VerifikasiPengajuanController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('TemplateAdmin', NULL, 'template');
        $this->load->model('M_verifikasi_pengajuan_less', 'mless');
    }

    public function index()
    {
        $data['title']         = 'Verifikasi Pengajuan Management';
        $data['content']       = 'verifikasi_pengajuan/index';
        $data['vitamin']       = 'verifikasi_pengajuan/index_vitamin';
        $data['arr_pengajuan'] = $this->mless->get_list_pengajuan();

        $data['marketings'] = $this->mcore->get('admins', '*', ['role' => 'marketing', 'deleted_at' => NULL]);
        $data['customers']  = $this->mcore->get('customers', '*', ['deleted_at' => NULL]);
        $data['pekerjaans'] = $this->mcore->get('pekerjaans', '*', ['deleted_at' => NULL]);
        $data['kategoris']  = $this->mcore->get('kategori', '*', ['deleted_at' => NULL], 'nama', 'ASC');
        $this->template->template($data);
    }

    public function create()
    {
        $data['title']      = 'Add Pengajuan';
        $data['content']    = 'pengajuan/form';
        $data['vitamin']    = 'pengajuan/form_vitamin';
        $data['marketings'] = $this->mcore->get('admins', '*', ['role' => 'marketing', 'deleted_at' => NULL]);
        $data['customers']  = $this->mcore->get('customers', '*', ['deleted_at' => NULL]);
        $data['pekerjaans'] = $this->mcore->get('pekerjaans', '*', ['deleted_at' => NULL]);
        $data['kategoris']  = $this->mcore->get('kategori', '*', ['deleted_at' => NULL], 'nama', 'ASC');
        $this->template->template($data);
    }

    public function store()
    {
        $this->db->trans_begin();
        $id_customer  = $this->input->post('id_customer');
        $alamat       = trim($this->input->post('alamat'));
        $no_telp      = $this->input->post('no_telp');
        $email        = strtolower($this->input->post('email'));
        $id_pekerjaan = $this->input->post('id_pekerjaan');

        $tanggal_pengajuan    = $this->input->post('tanggal_pengajuan');
        $id_marketing         = $this->input->post('id_marketing');
        $hubungan             = $this->input->post('hubungan');
        $nama_penjamin        = $this->input->post('nama_penjamin');
        $no_telp_penjamin     = $this->input->post('no_telp_penjamin');
        $sumber_pendapatan    = $this->input->post('sumber_pendapatan');
        $penghasilan_perbulan = str_replace(',', '', $this->input->post('penghasilan_perbulan'));

        $id_kategori     = $this->input->post('id_kategori');
        $id_vendor       = $this->input->post('id_vendor');
        $id_jenis_barang = $this->input->post('id_jenis_barang');
        $id_barang       = $this->input->post('id_barang');
        $spesifikasi     = $this->input->post('spesifikasi');
        $hpp             = str_replace(',', '', $this->input->post('hpp'));
        $tenor           = $this->input->post('tenor');
        $pokok           = str_replace(',', '', $this->input->post('pokok'));
        $margin_rp       = str_replace(',', '', $this->input->post('margin'));
        $total_angsuran  = str_replace(',', '', $this->input->post('total_angsuran'));
        $angsuran        = str_replace(',', '', $this->input->post('angsuran'));
        $cur_date        = date('Y-m-d H:i:s');
        $id_by           = $this->session->userdata(SESS . 'id');

        $arr_barang = $this->mcore->get('barang', 'nama', ['id' => $id_barang]);
        $nama_barang = '';
        if ($arr_barang->num_rows() > 0) {
            $nama_barang = $arr_barang->row()->nama;
        }

        if ($tenor == 6) {
            $margin_persen = 25;
        } elseif ($tenor == 8) {
            $margin_persen = 30;
        } elseif ($tenor == 10) {
            $margin_persen = 35;
        }

        $harga_jual = $pokok + $margin_rp;

        // $tgl_obj_pengajuan = new DateTime($tanggal_pengajuan);
        // $tgl_obj_pengajuan->modify('+' . $tenor . ' month');
        // $tanggal_jatuh_tempo = $tgl_obj_pengajuan->format('Y-m-d');

        $where_sequence = [
            'deleted_at'               => NULL,
            'YEAR(tanggal_pengajuan)'  => date('Y'),
            'MONTH(tanggal_pengajuan)' => date('m'),
            'DAY(tanggal_pengajuan)'   => date('d'),
        ];
        $arr_seq = $this->mcore->get('pengajuan', 'sequence', $where_sequence, 'sequence', 'desc', '1');

        $seq = 1;
        $seq2 = '01';
        if ($arr_seq->num_rows() == 1) {
            $seq = $arr_seq->row()->sequence + 1;

            $seq2 = $seq + 1;
            if ($seq < 10) {
                $seq2 = '0' . $seq;
            }
        }

        $no_kredit = date('my') . $seq2;

        $data = [
            'no_kredit'           => $no_kredit,
            'id_marketing'        => $id_marketing,
            'id_customer'         => $id_customer,
            'alamat'              => $alamat,
            'no_telp'             => $no_telp,
            'email'               => $email,
            'id_pekerjaan'        => $id_pekerjaan,
            'hubungan'            => $hubungan,
            'nama_penjamin'       => $nama_penjamin,
            'no_telp_penjamin'    => $no_telp_penjamin,
            'total_angsuran'      => $harga_jual,
            'terbayarkan'         => 0,
            'status'              => 'pengajuan',
            'tanggal_pengajuan'   => $tanggal_pengajuan,
            'tanggal_aktif'       => NULL,
            'tanggal_jatuh_tempo' => NULL,
            'angsuran_ke'         => 0,
            'tanggal_lunas'       => NULL,
            'tanggal_ditolak'     => NULL,
            'created_at'          => $cur_date,
            'created_by'          => $id_by,
            'updated_at'          => $cur_date,
            'updated_by'          => $id_by,
            'deleted_at'          => NULL,
            'deleted_by'          => NULL,
            'id_aktif'            => NULL,
            'id_tolak'            => NULL,
            'alasan_tolak'        => NULL,
            'sequence'            => $seq,

        ];
        $exec = $this->mcore->store('pengajuan', $data);

        if (!$exec) {
            $this->db->trans_rollback();
            echo json_encode(['code' => 500]);
            exit;
        }

        $data = [
            'no_kredit'               => $no_kredit,
            'id_barang'               => $id_barang,
            'id_jenis_barang'         => $id_jenis_barang,
            'id_vendor'               => $id_vendor,
            'id_kategori'             => $id_kategori,
            'nama_barang'             => $nama_barang,
            'spesifikasi'             => $spesifikasi,
            'hpp_pengajuan'           => $hpp,
            'hpp'                     => 0,
            'potongan'                => 0,
            'uang_muka'               => 0,
            'tenor'                   => $tenor,
            'pokok_pengajuan'         => $pokok,
            'pokok'                   => 0,
            'margin_persen_pengajuan' => $margin_persen,
            'margin_persen'           => 0,
            'margin_rp_pengajuan'     => $margin_rp,
            'margin_rp'               => 0,
            'harga_jual_pengajuan'    => $total_angsuran,
            'harga_jual'              => 0,
            'angsuran_pengajuan'      => $angsuran,
            'angsuran'                => 0,
            'created_at'              => $cur_date,
            'created_by'              => $id_by,
            'updated_at'              => $cur_date,
            'updated_by'              => $id_by,
            'deleted_at'              => NULL,
            'deleted_by'              => NULL,
        ];
        $exec = $this->mcore->store('pengajuan_barang', $data);

        if (!$exec) {
            $this->db->trans_rollback();
            echo json_encode(['code' => 500]);
            exit;
        }

        $data = [
            'alamat'               => $alamat,
            'no_telp'              => $no_telp,
            'email'                => $email,
            'id_pekerjaan'         => $id_pekerjaan,
            'hubungan'             => $hubungan,
            'nama_penjamin'        => $nama_penjamin,
            'no_telp_penjamin'     => $no_telp_penjamin,
            'sumber_pendapatan'    => $sumber_pendapatan,
            'penghasilan_perbulan' => $penghasilan_perbulan,
            'updated_at'           => $cur_date,
            'updated_by'           => $id_by,
        ];
        $exec = $this->mcore->update('customers', $data, ['id' => $id_customer]);

        if (!$exec) {
            $this->db->trans_rollback();
            echo json_encode(['code' => 500]);
            exit;
        }

        $this->db->trans_commit();
        echo json_encode(['code' => 200]);
    }

    public function edit($no_kredit = NULL)
    {
        if ($no_kredit == NULL || $no_kredit == "") {
            show_error("Data Pengajuan Tidak Ditemukan", 404, "An Error Was Encountered");
            exit;
        }

        $arr_pengajuan = $this->mcore->get('pengajuan', '*', ['no_kredit' => $no_kredit, 'deleted_at' => NULL]);
        $arr_pengajuan_barang = $this->mcore->get('pengajuan_barang', '*', ['no_kredit' => $no_kredit, 'deleted_at' => NULL]);

        if (!$arr_pengajuan) {
            show_error("Terjadi Kesalahan Dengan Database", 500, "An Error Was Encountered");
            exit;
        }

        if (!$arr_pengajuan_barang) {
            show_error("Terjadi Kesalahan Dengan Database", 500, "An Error Was Encountered");
            exit;
        }

        if ($arr_pengajuan->num_rows() == 0) {
            show_error("Data Pengajuan Tidak Ditemukan", 404, "An Error Was Encountered");
            exit;
        }

        if ($arr_pengajuan_barang->num_rows() == 0) {
            show_error("Data Pengajuan Tidak Ditemukan", 404, "An Error Was Encountered");
            exit;
        }

        $data['title']             = 'Edit Pengajuan';
        $data['content']           = 'pengajuan/form_edit';
        $data['vitamin']           = 'pengajuan/form_edit_vitamin';
        $data['marketings']        = $this->mcore->get('admins', '*', ['role' => 'marketing', 'deleted_at' => NULL]);
        $data['customers']         = $this->mcore->get('customers', '*', ['deleted_at' => NULL]);
        $data['pekerjaans']        = $this->mcore->get('pekerjaans', '*', ['deleted_at' => NULL]);
        $data['kategoris']         = $this->mcore->get('kategori', '*', ['deleted_at' => NULL], 'nama', 'ASC');
        $data['pengajuans']        = $arr_pengajuan;
        $data['pengajuan_barangs'] = $arr_pengajuan_barang;
        $this->template->template($data);
    }

    public function update()
    {
        $this->db->trans_begin();
        $no_kredit    = $this->input->post('no_kredit');
        $id_customer  = $this->input->post('id_customer');
        $alamat       = trim($this->input->post('alamat'));
        $no_telp      = $this->input->post('no_telp');
        $email        = strtolower($this->input->post('email'));
        $id_pekerjaan = $this->input->post('id_pekerjaan');

        $tanggal_pengajuan    = $this->input->post('tanggal_pengajuan');
        $id_marketing         = $this->input->post('id_marketing');
        $hubungan             = $this->input->post('hubungan');
        $nama_penjamin        = $this->input->post('nama_penjamin');
        $no_telp_penjamin     = $this->input->post('no_telp_penjamin');
        $sumber_pendapatan    = $this->input->post('sumber_pendapatan');
        $penghasilan_perbulan = str_replace(',', '', $this->input->post('penghasilan_perbulan'));

        $id_kategori     = $this->input->post('id_kategori');
        $id_vendor       = $this->input->post('id_vendor');
        $id_jenis_barang = $this->input->post('id_jenis_barang');
        $id_barang       = $this->input->post('id_barang');
        $spesifikasi     = $this->input->post('spesifikasi');
        $hpp             = str_replace(',', '', $this->input->post('hpp'));
        $tenor           = $this->input->post('tenor');
        $pokok           = str_replace(',', '', $this->input->post('pokok'));
        $margin_rp       = str_replace(',', '', $this->input->post('margin'));
        $total_angsuran  = str_replace(',', '', $this->input->post('total_angsuran'));
        $angsuran        = str_replace(',', '', $this->input->post('angsuran'));
        $cur_date        = date('Y-m-d H:i:s');
        $id_by           = $this->session->userdata(SESS . 'id');

        $arr_barang = $this->mcore->get('barang', 'nama', ['id' => $id_barang]);
        $nama_barang = '';
        if ($arr_barang->num_rows() > 0) {
            $nama_barang = $arr_barang->row()->nama;
        }

        if ($tenor == 6) {
            $margin_persen = 25;
        } elseif ($tenor == 8) {
            $margin_persen = 30;
        } elseif ($tenor == 10) {
            $margin_persen = 35;
        }

        $harga_jual = $pokok + $margin_rp;

        $data = [
            'id_marketing'        => $id_marketing,
            'id_customer'         => $id_customer,
            'alamat'              => $alamat,
            'no_telp'             => $no_telp,
            'email'               => $email,
            'id_pekerjaan'        => $id_pekerjaan,
            'hubungan'            => $hubungan,
            'nama_penjamin'       => $nama_penjamin,
            'no_telp_penjamin'    => $no_telp_penjamin,
            'total_angsuran'      => $harga_jual,
            'terbayarkan'         => 0,
            'status'              => 'pengajuan',
            'tanggal_pengajuan'   => $tanggal_pengajuan,
            'tanggal_aktif'       => NULL,
            'tanggal_jatuh_tempo' => NULL,
            'angsuran_ke'         => 0,
            'tanggal_lunas'       => NULL,
            'tanggal_ditolak'     => NULL,
            'created_at'          => $cur_date,
            'created_by'          => $id_by,
            'updated_at'          => $cur_date,
            'updated_by'          => $id_by,
            'deleted_at'          => NULL,
            'deleted_by'          => NULL,
            'id_aktif'            => NULL,
            'id_tolak'            => NULL,
            'alasan_tolak'        => NULL,
        ];
        $exec = $this->mcore->update('pengajuan', $data, ['no_kredit' => $no_kredit]);

        if (!$exec) {
            $this->db->trans_rollback();
            echo json_encode(['code' => 500]);
            exit;
        }

        $data = [
            'id_barang'               => $id_barang,
            'id_jenis_barang'         => $id_jenis_barang,
            'id_vendor'               => $id_vendor,
            'id_kategori'             => $id_kategori,
            'nama_barang'             => $nama_barang,
            'spesifikasi'             => $spesifikasi,
            'hpp_pengajuan'           => $hpp,
            'hpp'                     => 0,
            'potongan'                => 0,
            'uang_muka'               => 0,
            'tenor'                   => $tenor,
            'pokok_pengajuan'         => $pokok,
            'pokok'                   => 0,
            'margin_persen_pengajuan' => $margin_persen,
            'margin_persen'           => 0,
            'margin_rp_pengajuan'     => $margin_rp,
            'margin_rp'               => 0,
            'harga_jual_pengajuan'    => $total_angsuran,
            'harga_jual'              => 0,
            'angsuran_pengajuan'      => $angsuran,
            'angsuran'                => 0,
            'created_at'              => $cur_date,
            'created_by'              => $id_by,
            'updated_at'              => $cur_date,
            'updated_by'              => $id_by,
            'deleted_at'              => NULL,
            'deleted_by'              => NULL,
        ];
        $exec = $this->mcore->update('pengajuan_barang', $data, ['no_kredit' => $no_kredit]);

        if (!$exec) {
            $this->db->trans_rollback();
            echo json_encode(['code' => 500]);
            exit;
        }

        $data = [
            'alamat'               => $alamat,
            'no_telp'              => $no_telp,
            'email'                => $email,
            'id_pekerjaan'         => $id_pekerjaan,
            'hubungan'             => $hubungan,
            'nama_penjamin'        => $nama_penjamin,
            'no_telp_penjamin'     => $no_telp_penjamin,
            'sumber_pendapatan'    => $sumber_pendapatan,
            'penghasilan_perbulan' => $penghasilan_perbulan,
            'updated_at'           => $cur_date,
            'updated_by'           => $id_by,
        ];
        $exec = $this->mcore->update('customers', $data, ['id' => $id_customer]);

        if (!$exec) {
            $this->db->trans_rollback();
            echo json_encode(['code' => 500]);
            exit;
        }

        $this->db->trans_commit();
        echo json_encode(['code' => 200]);
    }

    public function destroy()
    {
        $cur_date = new DateTime('now');
        $no_kredit = $this->input->post('no_kredit');

        $object = [
            'deleted_at' => $cur_date->format('Y-m-d H:i:s'),
            'deleted_by' => $this->session->userdata(SESS . 'id')
        ];
        $where = ['no_kredit' => $no_kredit];
        $exec  = $this->mcore->update('pengajuan', $object, $where);
        $exec2 = $this->mcore->update('pengajuan_barang', $object, $where);

        if ($exec && $exec2) {
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

            $alias = "";
            if ($field->alias != NULL || $field->alias != "") {
                $alias = "(" . $field->alias . ")";
            }

            $row['no_kredit']         = $field->no_kredit;
            $row['id_marketing']      = $field->id_marketing;
            $row['nama_marketing']    = $field->nama_marketing;
            $row['id_customer']       = $field->id_customer;
            $row['nama_customer']     = $field->nama_customer . $alias;
            $row['alamat']            = $field->alamat;
            $row['no_telp']           = $field->no_telp;
            $row['email']             = $field->email;
            $row['id_pekerjaan']      = $field->id_pekerjaan;
            $row['nama_pekerjaan']    = $field->nama_pekerjaan;
            $row['hubungan']          = $field->hubungan;
            $row['nama_penjamin']     = $field->nama_penjamin;
            $row['no_telp_penjamin']  = $field->no_telp_penjamin;
            $row['total_angsuran']    = number_format($field->total_angsuran, 0);
            $row['terbayarkan']       = number_format($field->terbayarkan, 0);
            $row['status']            = strtoupper($field->status);
            $row['tanggal_pengajuan'] = $field->tanggal_pengajuan;
            $row['tanggal_aktif']     = $field->tanggal_aktif;
            $row['tanggal_lunas']     = $field->tanggal_lunas;
            $row['tanggal_ditolak']   = $field->tanggal_ditolak;
            $row['id_aktif']          = $field->id_aktif;
            $row['id_tolak']          = $field->id_tolak;
            $row['alasan_tolak']      = $field->alasan_tolak;
            $data[]                    = $row;
        }

        $output = array(
            "draw"            => $_POST['draw'],
            "recordsTotal"    => $this->mless->count_all(),
            "recordsFiltered" => $this->mless->count_filtered(),
            "data"            => $data,
        );

        echo json_encode($output);
    }
}

/* End of file VerifikasiPengajuanController.php */
