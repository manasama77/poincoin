<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_users_less extends CI_Model
{

    var $table         = 'users';
    var $column_order  = array(
        'users.id',
        'users.nama',
        'users.email',
        'users.no_hp',
    );
    var $column_search = array(
        'users.nama',
        'users.email',
        'users.no_hp',
        'user_banks.no_rekening',
        'user_banks.atas_nama',
    );
    var $order = array('users.id' => 'desc');

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    private function _get_datatables_query()
    {
        $this->db->select(
            array(
                'users.id',
                'users.nama',
                'users.email',
                'users.no_hp',
                'CONCAT(param_banks.nama_bank, " - ", user_banks.no_rekening, " - ", user_banks.atas_nama) AS no_rekening',
                'user_wallets.no_wallet',
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

        $this->db->join('user_banks', 'user_banks.id_user = users.id', 'left');
        $this->db->join('param_banks', 'param_banks.id = user_banks.id_bank', 'left');
        $this->db->join('user_wallets', 'user_wallets.id_user = users.id', 'left');
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

/* End of file M_users_less.php */
