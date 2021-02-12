<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_idrmarketless extends CI_Model
{
    var $table         = 'idr_market';
    var $column_order  = array(
        'idr_market.id',
        'idr_market.id_coin',
        'idr_market.name',
        'idr_market.symbol',
        'idr_market.base_currency',
        'idr_market.base_currency',
        'idr_market.traded_currency',
        'idr_market.traded_currency_unit',
        'idr_market.description',
        'idr_market.ticker_id',
        'idr_market.volume_precision',
        'idr_market.price_precision',
        'idr_market.price_round',
        'idr_market.price_round',
        'idr_market.price_scale',
        'idr_market.trade_min_base_currency',
        'idr_market.trade_min_traded_currency',
        'idr_market.has_memo',
        'idr_market.memo_name',
        'idr_market.url_logo',
        'idr_market.url_logo_png',
        'idr_market.is_maintenance',
        'idr_market.last',
        'idr_market.buy',
        'idr_market.sell',
        'idr_market.high',
        'idr_market.low',
    );
    var $column_search = array(
        'idr_market.id',
        'idr_market.id_coin',
        'idr_market.name',
        'idr_market.symbol',
        'idr_market.base_currency',
        'idr_market.base_currency',
        'idr_market.traded_currency',
        'idr_market.traded_currency_unit',
        'idr_market.description',
        'idr_market.ticker_id',
        'idr_market.volume_precision',
        'idr_market.price_precision',
        'idr_market.price_round',
        'idr_market.price_round',
        'idr_market.price_scale',
        'idr_market.trade_min_base_currency',
        'idr_market.trade_min_traded_currency',
        'idr_market.has_memo',
        'idr_market.memo_name',
        'idr_market.url_logo',
        'idr_market.url_logo_png',
        'idr_market.is_maintenance',
        'idr_market.last',
        'idr_market.buy',
        'idr_market.sell',
        'idr_market.high',
        'idr_market.low',
    );
    var $order = array('idr_market.id' => 'asc');

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    private function _get_datatables_query()
    {
        $this->db->from('idr_market');

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
        return $this->db->count_all_results();
    }
}
                        
/* End of file M_users.php */
