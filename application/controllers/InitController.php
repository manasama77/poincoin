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

    public function distribusi_bioner_stacking($username, $password)
    {
        if ($username == "adam" && $password == "adamgantengs") {
            $exec = $this->M_stacking->distribusi_bioner_stacking();
        } else {
            echo "permission rejected";
        }
    }

    public function distribusi_bioner_trade($username, $password)
    {
        if ($username == "adam" && $password == "adamgantengs") {
            $exec = $this->M_trade->distribusi_bioner_trade();
        } else {
            echo "permission rejected";
        }
    }

    // public function test($username, $password)
    // {
    //     if ($username == "adam" && $password == "adamgantengs") {
    //         $this->mcore->store('tb_test', ['test' => date('Y-m-d H:i:s')]);
    //     } else {
    //         echo "permission rejected";
    //     }
    // }

    public function test()
    {
        // echo microtime();
        // exit;
        $url = 'https://indodax.com/tapi';
        // Please find Key from trade API Indodax exchange
        $key = 'ZDOGCDMQ-OUW0REIV-WE127QWC-UBWIV9WR-WLB6AIRU';
        // Please find Secret Key from trade API Indodax exchange
        $secretKey = '37585096bad1bc0a803eb570c37d5757e4d8a4758352c3e30c56acc87dec9ef256efbf04a3c540a0';

        $data = [
            'method' => 'getInfo',
            'timestamp' => (time() * 1000),
            'recvWindow' => (time() * 1000)
        ];
        $post_data = http_build_query($data, '', '&');
        $sign = hash_hmac('sha512', $post_data, $secretKey);

        $headers = ['Key:' . $key, 'Sign:' . $sign];

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_HTTPHEADER => $headers,
            CURLOPT_URL => $url,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_RETURNTRANSFER => true
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
    }

    public function get_idr_market()
    {
        $ch_sum = curl_init();
        curl_setopt($ch_sum, CURLOPT_URL, "https://indodax.com/api/summaries");
        curl_setopt($ch_sum, CURLOPT_RETURNTRANSFER, 1);
        $output_sum = curl_exec($ch_sum);
        curl_close($ch_sum);
        $output_sum = json_decode($output_sum);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://indodax.com/api/pairs");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);
        $output = json_decode($output);


        if (count($output) > 0) {
            foreach ($output as $key) {
                $id_coin                   = $key->id;
                $symbol                    = $key->symbol;
                $base_currency             = $key->base_currency;
                $traded_currency           = $key->traded_currency;
                $traded_currency_unit      = $key->traded_currency_unit;
                $description               = $key->description;
                $ticker_id                 = $key->ticker_id;
                $volume_precision          = $key->volume_precision;
                $price_precision           = $key->price_precision;
                $price_round               = $key->price_round;
                $price_scale               = $key->pricescale;
                $trade_min_base_currency   = $key->trade_min_base_currency;
                $trade_min_traded_currency = $key->trade_min_traded_currency;
                $has_memo                  = $key->has_memo;
                $memo_name                 = $key->memo_name;
                $url_logo                  = $key->url_logo;
                $url_logo_png              = $key->url_logo_png;
                $is_maintenance            = $key->is_maintenance;

                foreach ($output_sum->tickers as $key => $val) {
                    if ($key == $ticker_id) {
                        $name = $val->name;
                        $last = $val->last;
                        $buy  = $val->buy;
                        $sell = $val->sell;
                        $high = $val->high;
                        $low  = $val->low;
                    }
                }

                $data = [
                    "id_coin"                   => $id_coin,
                    "name"                      => $name,
                    "symbol"                    => $symbol,
                    "base_currency"             => $base_currency,
                    "traded_currency"           => $traded_currency,
                    "traded_currency_unit"      => $traded_currency_unit,
                    "description"               => $description,
                    "ticker_id"                 => $ticker_id,
                    "volume_precision"          => $volume_precision,
                    "price_precision"           => $price_precision,
                    "price_round"               => $price_round,
                    "price_scale"               => $price_scale,
                    "trade_min_base_currency"   => $trade_min_base_currency,
                    "trade_min_traded_currency" => $trade_min_traded_currency,
                    "has_memo"                  => $has_memo,
                    "memo_name"                 => $memo_name,
                    "url_logo"                  => $url_logo,
                    "url_logo_png"              => $url_logo_png,
                    "is_maintenance"            => $is_maintenance,
                    "last"                      => $last,
                    "buy"                       => $buy,
                    "sell"                      => $sell,
                    "high"                      => $high,
                    "low"                       => $low,
                ];

                $check_coin = $this->mcore->count('idr_market', ['id_coin' => $id_coin]);

                if ($check_coin == 1) {
                    $where = ['id_coin' => $id_coin];
                    $exec = $this->mcore->update('idr_market', $data, $where);
                } else {
                    $exec = $this->mcore->store('idr_market', $data);
                }
            }
        }
    }
}

/* End of file InitController.php */
/* Location: ./application/controllers/InitController.php */
