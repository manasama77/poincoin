<?php
defined('BASEPATH') or exit('No direct script access allowed');

class TemplateUser
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
		$cookies = get_cookie(COOK);

		if ($cookies === NULL) {
			return FALSE;
		} else {
			$arr        = $this->ci->mcore->get('users', '*', ['cookies' => $cookies]);
			if ($arr->num_rows() > 0) {
				$id         = $arr->row()->id;
				$nama       = $arr->row()->nama;
				$email      = $arr->row()->email;
				$username   = $arr->row()->username;
				$remember   = $arr->row()->remember;
				$cookies_db = $arr->row()->cookies;

				if ($remember == '1') {
					if ($cookies == $cookies_db) {
						$this->reset_session($id, $nama, $email, $username);
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
		$id       = $this->ci->session->userdata(SESS . 'id');
		$nama     = $this->ci->session->userdata(SESS . 'nama');
		$email    = $this->ci->session->userdata(SESS . 'email');
		$username = $this->ci->session->userdata(SESS . 'username');

		if ($id && $nama && $email && $username) {
			return TRUE;
		}
		return FALSE;
	}

	public function render_view($data)
	{
		if (file_exists(APPPATH . 'views/users/' . $data['content'] . '.php')) {
			$this->ci->load->view('layouts/app_user', $data, FALSE);
		} else {
			show_404();
		}
	}

	public function reject()
	{
		$this->ci->session->set_flashdata('expired', 'Sesi berakhir');
		redirect('logout_user');
		exit;
	}

	public function reset_session($id, $nama, $email, $username)
	{
		$this->ci->session->set_userdata(SESS . 'id', $id);
		$this->ci->session->set_userdata(SESS . 'role', $nama);
		$this->ci->session->set_userdata(SESS . 'role', $email);
		$this->ci->session->set_userdata(SESS . 'username', $username);
	}
}

/* End of file TemplateAdmin.php */
/* Location: ./application/libraries/TemplateAdmin.php */
