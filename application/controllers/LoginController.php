<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LoginController extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->helper(['cookie', 'string']);
	}

	public function index()
	{
		echo password_hash(UYAH . 'admin123)', PASSWORD_BCRYPT);
		$cookies = get_cookie(COOK);

		if ($cookies != NULL) {
			$check_cookies = $this->mcore->get('admins', '*', ['cookies' => $cookies]);

			if ($check_cookies->num_rows() == 1) {
				$id       = $check_cookies->row()->id;
				$nama     = $check_cookies->row()->nama;
				$username = $check_cookies->row()->username;
				$role     = $check_cookies->row()->role;

				$this->_set_session($id, $nama, $username, $role);
				$this->session->set_flashdata('first_login', 'Login Berhasil, pastikan kamu menjaga Password Kamu');
				redirect(site_url() . 'dashboard');
			} else {
				delete_cookie(COOK);
				$this->session->set_flashdata('expired', 'Sesi Berakhir');
				redirect(site_url());
			}
		} else {
			$this->form_validation->set_rules('username', 'Username', 'callback_username_check');
			$this->form_validation->set_rules('password', 'Password', 'callback_password_check');

			if ($this->form_validation->run() === FALSE) {
				$this->load->view('login');
			} else {
				$username = $this->input->post('username');

				$where = [
					'username'      => $username,
					'deleted_at' => NULL
				];
				$arr = $this->mcore->get('admins', '*', $where);

				if ($arr->num_rows() == 1) {

					$id       = $arr->row()->id;
					$nama     = $arr->row()->nama;
					$username = $arr->row()->username;
					$role     = $arr->row()->role;
					$this->_set_session($id, $nama, $username, $role);

					$remember = $this->input->post('remember');
					if ($remember == 'on') {
						$key_cookies = random_string('alnum', 64);
						set_cookie(COOK, $key_cookies, 3600 * 24 * 30);
						$this->mcore->update('admins', ['cookies' => $key_cookies, 'remember' => '1'], ['id' => $id]);
					} else {
						$this->mcore->update('admins', ['remember' => '0'], ['id' => $id]);
					}

					$this->session->set_flashdata('first_login', 'Login Berhasil, pastikan kamu menjaga Password Kamu');
					redirect(site_url('dashboard'));
				} else {
					delete_cookie(COOK);
					$this->session->set_flashdata('unknown', 'Username tidak ditemukan');
					redirect(site_url());
				}
			}
		}
	}

	public function username_check($str)
	{
		$where = [
			'username'   => $str,
			'deleted_at' => NULL
		];
		$arr = $this->mcore->get('admins', '*', $where);

		if ($arr->num_rows() == 1) {
			return TRUE;
		}

		$this->form_validation->set_message('username_check', 'Username tidak ditemukan, silahkan cek kembali');
		return FALSE;
	}

	public function password_check($str)
	{
		$username = $this->input->post('username');
		$password = UYAH . $str;

		$where = [
			'username'   => $username,
			'deleted_at' => NULL
		];
		$arr = $this->mcore->get('admins', '*', $where);

		if ($arr->num_rows() == 1) {
			$db_pass  = $arr->row()->password;

			if (password_verify($password, $db_pass)) {
				return TRUE;
			}

			$this->form_validation->set_message('password_check', 'Password Salah, silahkan cek kembali');
			return FALSE;
		}

		$this->form_validation->set_message('password_check', 'Username tidak ditemukan, silahkan cek kembali');
		return FALSE;
	}

	public function _set_session($id, $nama, $username, $role)
	{
		$this->session->set_userdata(SESS . 'id', $id);
		$this->session->set_userdata(SESS . 'nama', $nama);
		$this->session->set_userdata(SESS . 'username', $username);
		$this->session->set_userdata(SESS . 'role', $role);
	}

	public function logout()
	{
		delete_cookie(COOK);
		$this->session->unset_userdata(SESS . 'id');
		$this->session->unset_userdata(SESS . 'nama');
		$this->session->unset_userdata(SESS . 'username');
		$this->session->unset_userdata(SESS . 'role');
		$this->session->set_flashdata('logout', 'Logout Berhasil');
		redirect(site_url());
	}

	public function change_password()
	{
		$id               = $this->session->userdata(SESS . 'id');
		$current_password = $this->input->post('current_pass') . UYAH;
		$new_password     = $this->input->post('new_pass');

		if ($id == NULL) {
			echo json_encode(['code' => 404]);
			exit;
		}
		$admin = $this->mcore->get('admins', '*', ['id' => $id]);

		if ($admin->num_rows() == 0) {
			echo json_encode(['code' => 404]);
			exit;
		}

		$password_db = $admin->row()->password;

		if (!password_verify($current_password, $password_db)) {
			echo json_encode(['code' => 501, 'id' => $id, 'current_password' => $current_password]);
			exit;
		}

		$new_password = password_hash($new_password . UYAH, PASSWORD_DEFAULT);

		$exec = $this->mcore->update('admins', ['password' => $new_password], ['id' => $id]);

		if (!$exec) {
			echo json_encode(['code' => 500]);
			exit;
		}

		echo json_encode(['code' => 200]);
		exit;
	}
}

/* End of file LoginController.php */
/* Location: ./application/controllers/LoginController.php */
