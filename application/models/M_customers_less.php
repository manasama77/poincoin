<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_customers_less extends CI_Model
{

    var $table         = 'customers';
    var $column_order  = array(
        'customers.id',
        'customers.no_ktp',
        'customers.nama',
        'customers.tgl_lahir',
        'customers.alamat',
        'customers.no_telp',
        'customers.email',
        'customers.id_pekerjaan',
        'pekerjaans.nama as nama_pekerjaan',
        'customers.hubungan',
        'customers.nama_penjamin',
        'customers.no_telp_penjamin',
        'customers.foto_ktp',
    );
    var $column_search = array(
        'customers.no_ktp',
        'customers.nama',
        'customers.tgl_lahir',
        'customers.alamat',
        'customers.no_telp',
        'customers.email',
        'customers.id_pekerjaan',
        'pekerjaans.nama',
        'customers.hubungan',
        'customers.nama_penjamin',
        'customers.no_telp_penjamin',
    );
    var $order = array('id' => 'desc');

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    private function _get_datatables_query()
    {
        $this->db->select(
            array(
                'customers.id',
                'customers.no_ktp',
                'customers.nama',
                'customers.tgl_lahir',
                'customers.alamat',
                'customers.no_telp',
                'customers.email',
                'customers.id_pekerjaan',
                'pekerjaans.nama as nama_pekerjaan',
                'customers.hubungan',
                'customers.nama_penjamin',
                'customers.no_telp_penjamin',
                'customers.foto_ktp',
            )
        );

        $this->db->from($this->table);

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

        $this->db->join('pekerjaans', 'pekerjaans.id = customers.id_pekerjaan', 'left');
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
}

/* End of file M_customers_less.php */
