<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AdminsController extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('TemplateAdmin', NULL, 'template');
		$this->load->model('M_admins_less', 'mless');
	}

	public function index()
	{
		$this->form_validation->set_rules(
			'username',
			'Username',
			'callback_username_check'
		);
		$this->form_validation->set_rules(
			'password',
			'Password',
			'required|trim'
		);

		$this->form_validation->set_rules('verify_password', 'Verify Password', 'required|trim|matches[password]', array('matches' => "{field} tidak sama dengan field Password"));

		$this->form_validation->set_error_delimiters('<span class="help-block text-red">', '</span>');

		if ($this->form_validation->run() === FALSE) {
			$data['title']   = 'Admin Management';
			$data['content'] = 'admins/index';
			$data['vitamin'] = 'admins/index_vitamin';
			$this->template->template($data);
		} else {
			$cur_date = new DateTime('now');
			$username = strtolower($this->input->post('username'));
			$password = password_hash($this->input->post('password') . UYAH, PASSWORD_DEFAULT);

			$object = [
				'username'   => $username,
				'password'   => $password,
				'created_at' => $cur_date->format('Y-m-d H: i: s'),
				'updated_at' => $cur_date->format('Y-m-d H: i: s'),
				'deleted_at' => NULL
			];
			$exec = $this->mcore->store('admins', $object);

			if ($exec === TRUE) {
				$this->session->set_flashdata('success', TRUE);
			} else {
				$this->session->set_flashdata('error', TRUE);
			}
			redirect(site_url() . 'admins');
		}
	}

	public function destroy()
	{
		$cur_date = new DateTime('now');
		$id       = $this->input->post('id');

		$object = ['deleted_at' => $cur_date->format('Y-m-d H:i:s')];
		$where  = ['id' => $id];
		$exec   = $this->mcore->update('admins', $object, $where);

		if ($exec) {
			$ret = ['code' => 200];
		} else {
			$ret = ['code' => 500];
		}

		echo json_encode($ret);
	}

	public function reset()
	{
		$id       = $this->input->post('id');
		$password = password_hash($this->input->post('password') . UYAH, PASSWORD_BCRYPT);

		$object = ['password' => $password];
		$where  = ['id' => $id];
		$exec   = $this->mcore->update('admins', $object, $where);

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

			$row['no']       = $no;
			$row['id']       = $field->id;
			$row['username'] = $field->username;
			$data[]          = $row;
		}

		$output = array(
			"draw"            => $_POST['draw'],
			"recordsTotal"    => $this->mless->count_all(),
			"recordsFiltered" => $this->mless->count_filtered(),
			"data"            => $data,
		);

		echo json_encode($output);
	}

	public function username_check($str)
	{
		$where = [
			'username'   => $str,
			'deleted_at' => NULL
		];
		$arr = $this->mcore->get('admins', '*', $where);

		if ($arr->num_rows() > 0) {
			$this->form_validation->set_message('username_check', "{field} sama ditemukan, silahkan gunakan username lain");
			return FALSE;
		} else {
			return TRUE;
		}
	}
}

/* End of file  AdminsController.php */
