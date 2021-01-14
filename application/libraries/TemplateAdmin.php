<?php
defined('BASEPATH') or exit('No direct script access allowed');

class TemplateAdmin
{
	protected $ci;

	public function __construct()
	{
		$this->ci = &get_instance();
		$this->ci->load->model('M_core', 'mcore');
		$this->ci->load->helper(['cookie', 'string']);
	}

	public function template($data)
	{
		$check_cookies = $this->check_cookies();

		if ($check_cookies === TRUE) {
			$this->render_view($data);
		} else {
			$check_session = $this->check_session();

			if ($check_session === TRUE) {
				$this->render_view($data);
			} else {
				$this->reject();
			}
		}
	}

	public function check_cookies()
	{
		$cookies = get_cookie(COOK_ADMIN);

		if ($cookies === NULL) {
			return FALSE;
		} else {
			$arr        = $this->ci->mcore->get('admins', '*', ['cookies' => $cookies]);
			if ($arr->num_rows() > 0) {
				$id         = $arr->row()->id;
				$username   = $arr->row()->username;
				$remember   = $arr->row()->remember;
				$cookies_db = $arr->row()->cookies;

				if ($remember == '1') {
					if ($cookies == $cookies_db) {
						$this->reset_session($id, $username);
						return TRUE;
					}
					return FALSE;
				}
				return FALSE;
			} else {
				return FALSE;
			}
		}
	}

	public function check_session()
	{
		$id       = $this->ci->session->userdata(SESS_ADMIN . 'id');
		$username = $this->ci->session->userdata(SESS_ADMIN . 'username');

		if ($id && $username) {
			return TRUE;
		}
		return FALSE;
	}

	public function render_view($data)
	{
		if (file_exists(APPPATH . 'views/pages/' . $data['content'] . '.php')) {
			$this->ci->load->view('layouts/app', $data, FALSE);
		} else {
			show_404();
		}
	}

	public function reject()
	{
		$this->ci->session->set_flashdata('expired', 'Sesi berakhir');
		redirect('logout');
		exit;
	}

	public function reset_session($id, $username)
	{
		$this->ci->session->set_userdata(SESS_ADMIN . 'id', $id);
		$this->ci->session->set_userdata(SESS_ADMIN . 'username', $username);
	}
}

/* End of file TemplateAdmin.php */
/* Location: ./application/libraries/TemplateAdmin.php */
