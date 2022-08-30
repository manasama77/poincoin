<?php

defined('BASEPATH') or exit('No direct script access allowed');

class DashboardUserController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('TemplateUser', NULL, 'template');
        $this->load->model('M_dashboard');
        $this->load->model('M_idrmarketless', 'mless');
    }

    public function index()
    {
        $data['title']          = 'Dashboard';
        $data['content']        = 'dashboard/index';
        $data['vitamin']        = 'dashboard/index_vitamin';
        $data['arr_news']       = $this->mcore->get('news', '*', ['deleted_at' => NULL, 'status' => 'show'], 'id', 'DESC');
        $data['count_referal']  = $this->M_dashboard->count_referal();
        $data['count_bank']     = $this->mcore->count('user_banks', ['id_user'   => $this->session->userdata(SESS . 'id')]);
        $data['count_wallet']   = $this->mcore->count('user_wallets', ['id_user' => $this->session->userdata(SESS . 'id')]);

        $this->template->template($data);
    }

    public function get_market_idr()
    {
        $arr  = $this->mcore->get('idr_market', '*', NULL, 'id', 'ASC');
        $data = [];

        foreach ($arr->result() as $key) {
            $nested['id']                        = $key->id;
            $nested['id_coin']                   = $key->id_coin;
            $nested['name']                      = $key->name;
            $nested['symbol']                    = $key->symbol;
            $nested['base_currency']             = $key->base_currency;
            $nested['traded_currency']           = $key->traded_currency;
            $nested['traded_currency_unit']      = $key->traded_currency_unit;
            $nested['description']               = $key->description;
            $nested['ticker_id']                 = $key->ticker_id;
            $nested['volume_precision']          = $key->volume_precision;
            $nested['price_precision']           = $key->price_precision;
            $nested['price_round']               = $key->price_round;
            $nested['price_scale']               = $key->price_scale;
            $nested['trade_min_base_currency']   = $key->trade_min_base_currency;
            $nested['trade_min_traded_currency'] = $key->trade_min_traded_currency;
            $nested['has_memo']                  = $key->has_memo;
            $nested['memo_name']                 = $key->memo_name;
            $nested['url_logo']                  = $key->url_logo;
            $nested['url_logo_png']              = $key->url_logo_png;
            $nested['is_maintenance']            = $key->is_maintenance;
            $nested['last']                      = number_format($key->last, $key->price_round, '.', ',');
            $nested['buy']                       = number_format($key->buy, $key->price_round, '.', ',');
            $nested['sell']                      = number_format($key->sell, $key->price_round, '.', ',');
            $nested['high']                      = number_format($key->high, $key->price_round, '.', ',');
            $nested['low']                       = number_format($key->low, $key->price_round, '.', ',');

            array_push($data, $nested);
        }
        echo json_encode(['data' => $data]);
    }

    public function datatables_idrmarket()
    {
        $list = $this->mless->get_datatables();
        $lq   = $this->db->last_query();
        $data = array();
        $no   = $_POST['start'];

        foreach ($list as $field) {
            $no++;
            $row = array();

            $row['id']                        = $field->id;
            $row['id_coin']                   = $field->id_coin;
            $row['name']                      = $field->name;
            $row['symbol']                    = $field->symbol;
            $row['base_currency']             = $field->base_currency;
            $row['traded_currency']           = $field->traded_currency;
            $row['traded_currency_unit']      = $field->traded_currency_unit;
            $row['description']               = $field->description;
            $row['ticker_id']                 = $field->ticker_id;
            $row['volume_precision']          = $field->volume_precision;
            $row['price_precision']           = $field->price_precision;
            $row['price_round']               = $field->price_round;
            $row['price_scale']               = $field->price_scale;
            $row['trade_min_base_currency']   = $field->trade_min_base_currency;
            $row['trade_min_traded_currency'] = $field->trade_min_traded_currency;
            $row['has_memo']                  = $field->has_memo;
            $row['memo_name']                 = $field->memo_name;
            $row['url_logo']                  = $field->url_logo;
            $row['url_logo_png']              = $field->url_logo_png;
            $row['is_maintenance']            = $field->is_maintenance;
            $row['last']                      = number_format($field->last, $field->price_round, '.', ',');
            $row['buy']                       = number_format($field->buy, $field->price_round, '.', ',');
            $row['sell']                      = number_format($field->sell, $field->price_round, '.', ',');
            $row['high']                      = number_format($field->high, $field->price_round, '.', ',');
            $row['low']                       = number_format($field->low, $field->price_round, '.', ',');

            $data[] = $row;
        }

        $output = array(
            "draw"            => $_POST['draw'],
            "recordsTotal"    => $this->mless->count_all(),
            "recordsFiltered" => $this->mless->count_filtered(),
            "data"            => $data,
            "lq"            => $lq,
        );

        echo json_encode($output);
    }

    public function temp_chart()
    {
        $arr_last = $this->mcore->get('ratio', '*', ['deleted_at' => null], 'tanggal', 'desc', '1');
        $tanggal  = $arr_last->row()->tanggal;
        $trx      = $arr_last->row()->trx;
        $bnr      = $arr_last->row()->bnr;

        $title    = "PC / TRX";
        $subtitle = $tanggal . " - PC / TRX: (" . $bnr . " : " . $trx . ")";

        $arr   = $this->mcore->get('ratio', '*', ['deleted_at' => null], 'tanggal', 'asc', '7');

        $data = [];
        array_push($data, ['Date', 'PC', 'TRX']);

        if ($arr->num_rows() > 0) {
            foreach ($arr->result() as $key) {
                $nested = [$key->tanggal, $key->bnr, $key->trx];
                array_push($data, $nested);
            }
        }

        echo json_encode([
            'title'    => $title,
            'subtitle' => $subtitle,
            'data'     => $data,
        ]);
    }
}
        
    /* End of file  DashboardUserController.php */
