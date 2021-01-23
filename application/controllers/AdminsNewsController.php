<?php

defined('BASEPATH') or exit('No direct script access allowed');

class AdminsNewsController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('TemplateAdmin', NULL, 'template');
        $this->load->model('M_news_less', 'mless');
    }

    public function index()
    {
        $this->form_validation->set_rules(
            'title',
            'Title',
            'required|min_length[3]|trim'
        );

        $this->form_validation->set_rules(
            'content',
            'Content',
            'required|min_length[10]|trim'
        );

        $this->form_validation->set_rules(
            'status',
            'Status',
            'required'
        );

        $this->form_validation->set_error_delimiters('<span class="help-block text-red">', '</span>');

        if ($this->form_validation->run() === FALSE) {
            $data['title']   = 'News Management';
            $data['content'] = 'news/index';
            $data['vitamin'] = 'news/index_vitamin';
            $this->template->template($data);
        } else {
            $cur_date = new DateTime('now');
            $title    = $this->input->post('title');
            $content  = nl2br($this->input->post('content'));
            $status   = $this->input->post('status');

            $object = [
                'title'      => $title,
                'content'    => $content,
                'status'     => $status,
                'created_by' => $this->session->userdata(SESS_ADMIN . 'id'),
                'created_at' => $cur_date->format('Y-m-d H: i: s'),
                'updated_by' => $this->session->userdata(SESS_ADMIN . 'id'),
                'updated_at' => $cur_date->format('Y-m-d H: i: s'),
                'deleted_by' => NULL,
                'deleted_at' => NULL,
            ];
            $exec = $this->mcore->store('news', $object);

            if ($exec === TRUE) {
                $this->session->set_flashdata('success', TRUE);
            } else {
                $this->session->set_flashdata('error', TRUE);
            }
            redirect(site_url() . 'admins/news');
        }
    }

    public function update()
    {
        $id      = $this->input->post('id');
        $title   = $this->input->post('title');
        $content = nl2br($this->input->post('content'));
        $status  = $this->input->post('status');
        $code    = 500;

        $data = [
            'title' => $title,
            'content' => $content,
            'status' => $status,
            'updated_by' => $this->session->userdata(SESS_ADMIN . 'id'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        $where = ['id' => $id];

        $exec = $this->mcore->update('news', $data, $where);

        if ($exec) {
            $code = 200;
        }

        echo json_encode(['code' => $code]);
    }

    public function destroy()
    {
        $cur_date = new DateTime('now');
        $id       = $this->input->post('id');

        $object = [
            'deleted_at' => $cur_date->format('Y-m-d H:i:s'),
            'deleted_by' => $this->session->userdata(SESS_ADMIN . 'id')
        ];
        $where  = ['id' => $id];
        $exec   = $this->mcore->update('news', $object, $where);

        if ($exec) {
            $ret = ['code' => 200];
        } else {
            $ret = ['code' => 500];
        }

        echo json_encode($ret);
    }

    public function change_status()
    {
        $cur_date = new DateTime('now');
        $id       = $this->input->post('id');
        $status   = $this->input->post('status');

        $object = [
            'status'     => ($status == "show") ? "hide" : "show",
            'updated_by' => $this->session->userdata(SESS_ADMIN . 'id'),
            'updated_at' => $cur_date->format('Y-m-d H: i: s')
        ];
        $where  = ['id' => $id];
        $exec   = $this->mcore->update('news', $object, $where);

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

            $row['no']         = $no;
            $row['id']         = $field->id;
            $row['title']      = $field->title;
            $row['content']    = $field->content;
            $row['status']     = $field->status;
            $row['created_at'] = $field->created_at;
            $row['updated_at'] = $field->updated_at;
            $data[]            = $row;
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
        
    /* End of file  AdminsNewsController.php */
