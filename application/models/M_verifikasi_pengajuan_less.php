<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_verifikasi_pengajuan_less extends CI_Model
{

    var $table         = 'pengajuan';
    var $column_order  = array(
        'pengajuan.no_kredit',
        'pengajuan.id_marketing',
        'marketing.nama',
        'pengajuan.id_customer',
        'customer.nama',
        'customer.alias',
        'pengajuan.alamat',
        'pengajuan.no_telp',
        'pengajuan.email',
        'pengajuan.id_pekerjaan',
        'pekerjaan.nama',
        'pengajuan.hubungan',
        'pengajuan.nama_penjamin',
        'pengajuan.no_telp_penjamin',
        'pengajuan.total_angsuran',
        'pengajuan.terbayarkan',
        'pengajuan.status',
        'pengajuan.tanggal_pengajuan',
        'pengajuan.tanggal_aktif',
        'pengajuan.tanggal_lunas',
        'pengajuan.tanggal_ditolak',
        'pengajuan.id_aktif',
        'pengajuan.id_tolak',
        'pengajuan.alasan_tolak',
    );
    var $column_search = array(
        'pengajuan.no_kredit',
        'pengajuan.id_marketing',
        'marketing.nama',
        'pengajuan.id_customer',
        'customer.nama',
        'pengajuan.alamat',
        'pengajuan.no_telp',
        'pengajuan.email',
        'pengajuan.id_pekerjaan',
        'pekerjaan.nama',
        'pengajuan.hubungan',
        'pengajuan.nama_penjamin',
        'pengajuan.no_telp_penjamin',
        'pengajuan.total_angsuran',
        'pengajuan.terbayarkan',
        'pengajuan.status',
        'pengajuan.tanggal_pengajuan',
        'pengajuan.tanggal_aktif',
        'pengajuan.tanggal_lunas',
        'pengajuan.tanggal_ditolak',
        'pengajuan.id_aktif',
        'pengajuan.id_tolak',
        'pengajuan.alasan_tolak',
    );
    var $order = array('pengajuan.no_kredit' => 'desc');

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    private function _get_datatables_query()
    {
        $this->db->select(
            array(
                'pengajuan.no_kredit',
                'pengajuan.id_marketing',
                'marketing.nama as nama_marketing',
                'pengajuan.id_customer',
                'customer.nama as nama_customer',
                'customer.alias',
                'pengajuan.alamat',
                'pengajuan.no_telp',
                'pengajuan.email',
                'pengajuan.id_pekerjaan',
                'pekerjaan.nama as nama_pekerjaan',
                'pengajuan.hubungan',
                'pengajuan.nama_penjamin',
                'pengajuan.no_telp_penjamin',
                'pengajuan.total_angsuran',
                'pengajuan.terbayarkan',
                'pengajuan.status',
                'pengajuan.tanggal_pengajuan',
                'pengajuan.tanggal_aktif',
                'pengajuan.tanggal_lunas',
                'pengajuan.tanggal_ditolak',
                'pengajuan.id_aktif',
                'pengajuan.id_tolak',
                'pengajuan.alasan_tolak',
            )
        );

        $this->db->from($this->table);
        $this->db->join('admins as marketing', 'marketing.id = pengajuan.id_marketing', 'left');
        $this->db->join('customers as customer', 'customer.id = pengajuan.id_customer', 'left');
        $this->db->join('pekerjaans as pekerjaan', 'pekerjaan.id = pengajuan.id_pekerjaan', 'left');

        $i = 0;

        foreach ($this->column_search as $item) {
            if ($_POST['search']['value']) {
                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($this->column_search) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }

        $this->db->where($this->table . '.deleted_at', NULL);
    }

    function get_datatables()
    {
        $this->_get_datatables_query();

        if ($_POST['length'] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }

        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->from($this->table);
        $this->db->where($this->table . '.deleted_at', NULL);
        return $this->db->count_all_results();
    }

    public function get_list_pengajuan()
    {
        // $this->db->select('
        // pengajuan.no_kredit,
        // marketing.nama as nama_marketing,
        // customer.nama as nama_customer,
        // pengajuan.alamat,
        // pengajuan.no_telp,
        // pengajuan.email,
        // pekerjaan.nama as nama_pekerjaan,
        // pengajuan.hubungan,
        // pengajuan.nama_penjamin,
        // pengajuan.no_telp_penjamin,
        // jenis_barang.nama as nama_jenis_barang,
        // ');
        // $this->db->join('pengajuan_barang', 'pengajuan_barang.no_kredit = pengajuan.no_kredit', 'left');
        // $this->db->join('admins as marketing', 'marketing.id = pengajuan.id_marketing', 'left');
        // $this->db->join('customers as customer', 'customer.id = pengajuan.id_customer', 'left');
        // $this->db->join('pekerjaans', 'pekerjaans.id = pengajuan.id_pekerjaan', 'left');
        // $this->db->join('kategori', 'kategori.id = pengajuan_barang.id_kategori', 'left');
        // $this->db->join('vendor', 'vendor.id = pengajuan_barang.id_vendor', 'left');
        // $this->db->join('jenis_barang', 'jenis_barang.id = pengajuan_barang.id_jenis_barang', 'left');
        // $this->db->where('deleted_at', NULL);
        // $this->db->order_by('no_kredit', 'ASC');
        // return $this->db->get('pengajuan');
        $this->db->join('customers as customer', 'customer.id = pengajuan.id_customer', 'left');
        $this->db->where('pengajuan.deleted_at', NULL);
        $this->db->order_by('pengajuan.no_kredit', 'ASC');
        return $this->db->get('pengajuan');
    }

    public function get_list_pengajuan_barang($no_kredit)
    {
        $this->db->where('deleted_at', NULL);
        $this->db->order_by('no_kredit', 'ASC');
        return $this->db->get('pengajuan_barang');
    }
}

/* End of file M_verifikasi_pengajuan_less.php */
