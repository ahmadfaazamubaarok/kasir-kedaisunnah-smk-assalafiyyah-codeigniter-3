<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function index()
	{
		$this->load->view('auth');
	}

	public function login()
	{
		$this->form_validation->set_rules($this->rules_model->login_rules());

        if ($this->form_validation->run() == FALSE)
        {
            redirect('auth');
        } else {
        	$nama = $this->input->post('nama');
        	$password = $this->input->post('password');
	
        	$user_login = $this->user_model->login($nama, $password);
	
        	if ($user_login) {
        		if ($user_login->level === 'kasir') {
        			$this->session->set_userdata('id_user', $user_login->id_user);
        			$user = [
        				'id_user'	=> $user_login->id_user,
        				'last_login'=> date('Y-m-d H:i:s')
        			];
        			$this->user_model->update($user);
        			redirect('kasir/dashboard');
        		}
        		if ($user_login->level === 'admin') {
        			$this->session->set_userdata('id_user', $user_login->id_user);
        			$user = [
        				'id_user'	=> $user_login->id_user,
        				'last_login'=> date('Y-m-d H:i:s')
        			];
        			$this->user_model->update($user);
        			redirect('admin/dashboard');
        		}
        	} else {
        		$this->session->set_flashdata('salah','Nama atau Password tidak cocok!');
        		redirect('auth');
        	}
        }
	}

	public function logout()
	{
		$this->session->unset_userdata('id_user');
		redirect('auth');
	}

	public function setting()
	{
		$id_user = $this->session->userdata('id_user');
		$data['user'] = $this->user_model->get_by_id($id_user);
		$this->load->view('setting', $data);
	}

	public function edit_user($id_user = null)
	{
		$user = [
			'id_user'	=> $id_user,
			'nama_user'	=> $this->input->post('nama_user')
		];
		$this->user_model->update($user);
		redirect('');
	}

	public function edit_password($id_user = null)
	{
		$lama = $this->input->post('lama');
		$pertama = $this->input->post('pertama');
		$kedua = $this->input->post('kedua');

		$user = $this->user_model->get_by_id($id_user);

		if (password_verify($lama, $user->password)) {
			if ($pertama === $kedua) {
				$user = [
					'id_user'	=> $user->id_user,
					'password'	=> password_hash($pertama, PASSWORD_DEFAULT)
				];
				$this->user_model->update($user);
				redirect('');
			} else {
				$this->session->set_flashdata('gagalKonfirmasi', 'Gagal konfirmasi password baru!');
				redirect('auth/setting');
			}
		} else {
			$this->session->set_flashdata('passwordbeda', 'Password yang dimasukkan salah!');
			redirect('auth/setting');
		}
	}

	public function profil_user($id_user)
	{
	    $config['upload_path'] = FCPATH . 'upload/profil';
	    $config['allowed_types'] = 'jpg|jpeg|png';
	    $config['max_size'] = 2048;
	    $config['file_name'] = $id_user . "_" . $_FILES['profil']['name'];

        $this->load->library('upload', $config);
        if ($this->upload->do_upload('profil')) {
            if ($upload_data['file_size'] > 2048) {
            	$this->session->set_flashdata('melebihi_batas','Ukuran gambar tidak boleh melebihi 2MB!');
            	redirect('auth/setting');
            } else {
	    	
	    		$upload_data = $this->upload->data();
	            
	            $profil = $upload_data['file_name'];
	            $user = [
	            	'id_user' => $id_user,
	            	'profil'	=> $profil
	            ];
	            $this->user_model->update($user);
	            $this->session->set_flashdata('berhasil_profil','Berhasil mengubah foto profil!');
	            redirect('auth/setting');
            }
        } else {	
			$this->session->set_flashdata('upload_gagal', $this->upload->display_errors());
            redirect('auth/setting');
        }
	}
}
