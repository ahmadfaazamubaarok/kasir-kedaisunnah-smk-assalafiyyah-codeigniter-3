<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata('id_user')){
			redirect('auth');
		} else {
			$id_user = $this->session->userdata('id_user');
			$user = $this->user_model->get_by_id($id_user);
			if ($user->level !== 'admin') {
				$this->session->set_flashdata('hak_akses_salah','Tidak ada izin untuk mengakses!');
				redirect('auth');
			}
		}
	}

	public function index()
	{
		$id_user = $this->session->userdata('id_user');
		$data['user'] = $this->user_model->get_by_id($id_user);
		$data['halaman_dashboard'] = 'collapsed';
		$this->load->view('admin/dashboard/dashboard', $data);
	}
}
