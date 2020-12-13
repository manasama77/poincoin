<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DashboardController extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library('TemplateAdmin', NULL, 'template');
	}

	public function index()
	{
		$tgl_obj = new DateTime('now');
		$cur_month = $tgl_obj->format('m');

		$data['title']   = 'Dashboard';
		$data['content'] = 'dashboard/index';
		$data['vitamin'] = 'dashboard/index_vitamin';

		$data['admin_count']     = $this->mcore->count("admins", ['deleted_at' => NULL, 'role' => 'master_admin']);
		$data['marketing_count'] = $this->mcore->count("admins", ['deleted_at' => NULL, 'role' => 'marketing']);
		$data['customer_count']  = $this->mcore->count("customers", ['deleted_at' => NULL]);
		$data['pengajuan_count'] = $this->mcore->count("pengajuan", ['deleted_at' => NULL, 'MONTH(tanggal_pengajuan)' => $cur_month]);

		$this->template->template($data);
	}
}

/* End of file DashboardController.php */
/* Location: ./application/controllers/DashboardController.php */