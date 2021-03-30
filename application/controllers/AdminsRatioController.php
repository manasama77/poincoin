<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AdminsRatioController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('TemplateAdmin', NULL, 'template');
        $this->load->model('M_ratio_less', 'mless');
    }

    public function index()
    {
        $this->form_validation->set_rules(
            'tanggal',
            'Tanggal',
            'required'
        );
        $this->form_validation->set_rules(
            'trx',
            'TRX',
            'required'
        );
        $this->form_validation->set_rules(
            'bnr',
            'BNR',
            'required'
        );

        $this->form_validation->set_error_delimiters('<span class="help-block text-red">', '</span>');

        if ($this->form_validation->run() === FALSE) {
            $data['title']   = 'TRX BNR Ratio Management';
            $data['content'] = 'ratio/index';
            $data['vitamin'] = 'ratio/index_vitamin';
            $this->template->template($data);
        } else {
            $cur_date = new DateTime('now');
            $tanggal  = $this->input->post('tanggal');
            $trx      = $this->input->post('trx');
            $bnr      = $this->input->post('bnr');

            $object = [
                'tanggal'    => $tanggal,
                'trx'        => $trx,
                'bnr'        => $bnr,
                'created_at' => $cur_date->format('Y-m-d H: i: s'),
                'updated_at' => $cur_date->format('Y-m-d H: i: s'),
                'deleted_at' => NULL
            ];
            $exec = $this->mcore->store('ratio', $object);

            if ($exec === TRUE) {
                $this->session->set_flashdata('success', TRUE);
            } else {
                $this->session->set_flashdata('error', TRUE);
            }
            redirect(site_url() . 'admins/ratio');
        }
    }

    public function destroy()
    {
        $cur_date = new DateTime('now');
        $id       = $this->input->post('id');

        $object = ['deleted_at' => $cur_date->format('Y-m-d H:i:s')];
        $where  = ['id' => $id];
        $exec   = $this->mcore->update('ratio', $object, $where);

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

            $row['no']      = $no;
            $row['id']      = $field->id;
            $row['tanggal'] = $field->tanggal;
            $row['trx']     = $field->trx;
            $row['bnr']     = $field->bnr;
            $data[]         = $row;
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

/* End of file  AdminsController.php */
