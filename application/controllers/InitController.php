<?php
defined('BASEPATH') or exit('No direct script access allowed');

class InitController extends CI_Controller
{
    private $table = 'admins';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_stacking');
        $this->load->model('M_trade');
    }

    public function init_admins()
    {

        $this->db->truncate('admins');
        $this->db->truncate('barang');
        $this->db->truncate('customers');
        $this->db->truncate('pengajuan');
        $this->db->truncate('pengajuan_barang');

        $now      = new DateTime();
        $password = password_hash('admin123)' . UYAH, PASSWORD_DEFAULT);

        ##################################################################
        $data = [];
        $object = [
            'nama'       => 'Adam PM',
            'email'      => 'adam.pm77@gmail.com',
            'password'   => $password,
            'role'       => 'master_admin',
            'created_at' => $now->format('Y-m-d H:i:s'),
            'updated_at' => $now->format('Y-m-d H:i:s'),
            'deleted_at' => NULL,
            'cookies'    => NULL,
            'remember'   => '0',
        ];
        array_push($data, $object);

        $object = [
            'nama'       => 'M. Nunu',
            'email'      => 'nunu@gmail.com',
            'password'   => $password,
            'role'       => 'master_admin',
            'created_at' => $now->format('Y-m-d H:i:s'),
            'updated_at' => $now->format('Y-m-d H:i:s'),
            'deleted_at' => NULL,
            'cookies'    => NULL,
            'remember'   => '0',
        ];
        array_push($data, $object);

        $object = [
            'nama'       => 'Nasrul',
            'email'      => 'nasrul@gmail.com',
            'password'   => $password,
            'role'       => 'master_admin',
            'created_at' => $now->format('Y-m-d H:i:s'),
            'updated_at' => $now->format('Y-m-d H:i:s'),
            'deleted_at' => NULL,
            'cookies'    => NULL,
            'remember'   => '0',
        ];
        array_push($data, $object);

        $object = [
            'nama'       => 'Nana',
            'email'      => 'nana@gmail.com',
            'password'   => $password,
            'role'       => 'master_admin',
            'created_at' => $now->format('Y-m-d H:i:s'),
            'updated_at' => $now->format('Y-m-d H:i:s'),
            'deleted_at' => NULL,
            'cookies'    => NULL,
            'remember'   => '0',
        ];
        array_push($data, $object);

        $object = [
            'nama'       => 'Yudi',
            'email'      => 'yudi@gmail.com',
            'password'   => $password,
            'role'       => 'marketing',
            'created_at' => $now->format('Y-m-d H:i:s'),
            'updated_at' => $now->format('Y-m-d H:i:s'),
            'deleted_at' => NULL,
            'cookies'    => NULL,
            'remember'   => '0',
        ];
        array_push($data, $object);

        $object = [
            'nama'       => 'Fira',
            'email'      => 'fira@gmail.com',
            'password'   => $password,
            'role'       => 'marketing',
            'created_at' => $now->format('Y-m-d H:i:s'),
            'updated_at' => $now->format('Y-m-d H:i:s'),
            'deleted_at' => NULL,
            'cookies'    => NULL,
            'remember'   => '0',
        ];
        array_push($data, $object);

        $exec = $this->mcore->store_batch($this->table, $data);
        ##################################################################
        ##################################################################
        $data = [];

        $object = [
            'nama'            => 'Iphone 12',
            'id_jenis_barang' => '1',
            'spesifikasi'     => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Magnam nihil optio quae beatae omnis velit modi libero sed ratione placeat?',
            'hpp'             => '12000000',
            'created_at'      => $now->format('Y-m-d H:i:s'),
            'created_by'      => '1',
            'updated_at'      => $now->format('Y-m-d H:i:s'),
            'updated_by'      => '1',
            'deleted_at'      => NULL,
            'deleted_by'      => NULL,
        ];
        array_push($data, $object);

        $object = [
            'nama'            => 'Iphone 11',
            'id_jenis_barang' => '1',
            'spesifikasi'     => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Magnam nihil optio quae beatae omnis velit modi libero sed ratione placeat?',
            'hpp'             => '10000000',
            'created_at'      => $now->format('Y-m-d H:i:s'),
            'created_by'      => '1',
            'updated_at'      => $now->format('Y-m-d H:i:s'),
            'updated_by'      => '1',
            'deleted_at'      => NULL,
            'deleted_by'      => NULL,
        ];
        array_push($data, $object);

        $exec = $this->mcore->store_batch('barang', $data);
        ##################################################################
        ##################################################################
        $data = [];

        $object = [
            'no_ktp'               => '123456789',
            'nama'                 => 'Nurul AL',
            'tgl_lahir'            => '1992-11-05',
            'alamat'               => 'Jl. Raya A no. 1 Rt.1 Rw. 2 Bogor',
            'no_telp'              => '08123456789',
            'email'                => 'nurul@gmail.com',
            'id_pekerjaan'         => '1',
            'hubungan'             => 'Teman',
            'nama_penjamin'        => 'Adam PM',
            'no_telp_penjamin'     => '08123456789',
            'sumber_pendapatan'    => 'gaji_tetap',
            'penghasilan_perbulan' => '10000000',
            'foto_ktp'             => NULL,
            'created_at'           => $now->format('Y-m-d H:i:s'),
            'created_by'           => '1',
            'updated_at'           => $now->format('Y-m-d H:i:s'),
            'updated_by'           => '1',
            'deleted_at'           => NULL,
            'deleted_by'           => NULL,
        ];
        array_push($data, $object);

        $object = [
            'no_ktp'               => '123456789',
            'nama'                 => 'Inara AL',
            'tgl_lahir'            => '2017-05-16',
            'alamat'               => 'Jl. Raya A no. 2 Rt.1 Rw. 2 Bogor',
            'no_telp'              => '08123456789',
            'email'                => 'inara@gmail.com',
            'id_pekerjaan'         => '2',
            'hubungan'             => 'Teman',
            'nama_penjamin'        => 'Adam PM',
            'no_telp_penjamin'     => '08123456789',
            'sumber_pendapatan'    => 'gaji_tetap',
            'penghasilan_perbulan' => '20000000',
            'foto_ktp'             => NULL,
            'created_at'           => $now->format('Y-m-d H:i:s'),
            'created_by'           => '1',
            'updated_at'           => $now->format('Y-m-d H:i:s'),
            'updated_by'           => '1',
            'deleted_at'           => NULL,
            'deleted_by'           => NULL,
        ];
        array_push($data, $object);

        $object = [
            'no_ktp'               => '123456789',
            'nama'                 => 'Aghnia AS',
            'tgl_lahir'            => '2019-09-06',
            'alamat'               => 'Jl. Raya A no. 3 Rt.1 Rw. 2 Bogor',
            'no_telp'              => '08123456789',
            'email'                => 'aghnia@gmail.com',
            'id_pekerjaan'         => '3',
            'hubungan'             => 'Teman',
            'nama_penjamin'        => 'Adam PM',
            'no_telp_penjamin'     => '08123456789',
            'sumber_pendapatan'    => 'gaji_tetap',
            'penghasilan_perbulan' => '30000000',
            'foto_ktp'             => NULL,
            'created_at'           => $now->format('Y-m-d H:i:s'),
            'created_by'           => '1',
            'updated_at'           => $now->format('Y-m-d H:i:s'),
            'updated_by'           => '1',
            'deleted_at'           => NULL,
            'deleted_by'           => NULL,
        ];
        array_push($data, $object);

        $exec = $this->mcore->store_batch('customers', $data);
    }

    public function distribusi_bioner_stacking()
    {
        $exec = $this->M_stacking->distribusi_bioner_stacking();
    }

    public function distribusi_bioner_trade()
    {
        $exec = $this->M_trade->distribusi_bioner_trade();
    }
}

/* End of file InitController.php */
/* Location: ./application/controllers/InitController.php */
