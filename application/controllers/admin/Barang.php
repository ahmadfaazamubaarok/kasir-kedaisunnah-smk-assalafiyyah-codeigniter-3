<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Barang extends CI_Controller {

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
		$data['barang_barang'] = $this->barang_model->get_join_kategori();
		$data['kategori_barang'] = $this->kategori_model->get();
		$data['halaman_barang'] = 'collapsed';
		$this->load->view('admin/barang/list_barang', $data);
	}

	public function tambah()
	{
		if ($this->input->post('id_barang')) {
		    $id_barang = $this->input->post('id_barang');					
		} else {
		    $id_barang = uniqid(true);
		}
	    $config['upload_path'] = FCPATH . 'upload/barang';
	    $config['allowed_types'] = 'jpg|jpeg|png';
	    $config['max_size'] = 2048;
	    $config['file_name'] = $id_barang . "_" . $_FILES['thumbnail']['name'];

        $this->load->library('upload', $config);
        
        if ($this->upload->do_upload('thumbnail')) {

            if ($upload_data['file_size'] > 2048) {
            	$this->session->set_flashdata('melebihi_batas','Ukuran gambar tidak boleh melebihi 2MB!');
            	redirect('admin/barang/tambah');
            } else {
	    	
	    		$upload_data = $this->upload->data();
	            $nama = $this->input->post('nama');
				$harga_beli = $this->input->post('harga_beli');
				$harga = $this->input->post('harga');
				$kategori = $this->input->post('kategori');
	            $thumbnail = $upload_data['file_name'];
	            $barang = [
	            	'id_barang' => $id_barang,
	            	'nama'		=> $nama,
	            	'harga_beli'=> $harga_beli,
	            	'harga'		=> $harga,
	            	'stok'		=> 0,
	            	'kategori'	=> $kategori,
	            	'thumbnail'	=> $thumbnail
	            ];
	            $this->barang_model->insert($barang);
	            $this->session->set_flashdata('berhasil_insert','Berhasil menambahkan <strong>' . $nama . '</strong>!');
	            redirect('admin/barang');
            }
        } else {	
			$this->session->set_flashdata('upload_gagal', $this->upload->display_errors());
            redirect('admin/barang');
        }
	}

	public function edit($id_barang = null)
	{
		$data['barang'] = $this->barang_model->get_by_id($id_barang);
		if (!empty($_FILES['thumbnail']['name'])) {

			if (!empty($data['barang']->thumbnail)) {
				$gambar_path = FCPATH . 'upload/barang/' . $data['barang']->thumbnail;
				if (file_exists($gambar_path)) {
					unlink($gambar_path);
				}
			}
			// Konfigurasi upload gambar baru
			$config['upload_path'] = FCPATH . 'upload/barang/';
			$config['allowed_types'] = 'gif|jpg|jpeg|png';
			$config['max_size'] = 2048; // 2MB
			$config['file_name'] = $data['barang']->id_barang . '_' . $_FILES['thumbnail']['name']; // Namafile unik
			$this->load->library('upload', $config);
			if ($this->upload->do_upload('thumbnail')) {
				$upload_data = $this->upload->data();
				$thumbnail = $upload_data['file_name']; // Simpan URL gambar baru
			} else {
				$this->session->set_flashdata('upload_gagal', $this->upload->display_errors());
	           	redirect('admin/barang/edit');
			}
		} else {
			// Jika tidak ada gambar yang diunggah, simpan data tanpa mengubah gambar
			$thumbnail = $data['barang']->thumbnail;
		}
		if ($this->input->post('id_barang')) {
		    $id_barang = $this->input->post('id_barang');					
		}
		
		$nama = $this->input->post('nama');
		$harga_beli = $this->input->post('harga_beli');
		$harga = $this->input->post('harga');
		$stok = $this->input->post('stok');
		$kategori = $this->input->post('kategori');
		$barang = [
			'id_barang'	=> $id_barang,
			'nama'		=> $nama,
			'harga_beli'=> $harga_beli,
			'harga'		=> $harga,
			'kategori'	=> $kategori,
			'thumbnail'	=> $thumbnail
		];
		$updated = $this->barang_model->update($barang);
		if ($updated) {
			$this->session->set_flashdata('update_berhasil','Update <strong>'.$nama.'</strong> berhasil!');
			redirect('admin/barang');
		} else {
			$this->session->set_flashdata('update_gagal','Update <strong>'.$nama.'</strong> gagal!');
			redirect('admin/barang');
		}
	}

	public function hapus($id_barang = null)
	{
		$barang = $this->barang_model->get_by_id($id_barang);

		if ($barang->thumbnail) {

			$gambar_path = FCPATH . 'upload/barang/' . $barang->thumbnail;
			if (file_exists($gambar_path)) {
				unlink($gambar_path); //hapus gambar
				$this->barang_model->delete($id_barang);
				$this->session->set_flashdata('hapus', 'Satu pilihan telah dihapus');
				redirect('admin/barang');
			} else {
				echo 'file tidak ditremukan!';
			}
		} else {
			$this->session->set_flashdata('gagal_hapus', 'Gagal menghapus <strong>'.$barang->nama.'</strong>!');
			redirect('admin/barang');
		}
	}

	public function tambah_kategori()
	{
		$kategori = [
			'id_kategori'	=> uniqid(),
			'kategori'		=> $this->input->post('kategori')
		];
		$this->kategori_model->insert($kategori);
		$this->session->set_flashdata('berhasil_tambah_kategori','Berhasil menambahkan <strong>'.$this->input->post('kategori').'</strong> untuk kategori barang!');
		redirect('admin/barang');
	}

	public function edit_kategori($id_kategori)
	{
		$kategori = [
			'id_kategori'	=> $id_kategori,
			'kategori'		=> $this->input->post('kategori')
		];
		$this->kategori_model->update($kategori);
		$this->session->set_flashdata('berhasil_ubah_kategori','Berhasil mengubah <strong>'.$this->input->post('kategori').'</strong> untuk kategori barang!');
		redirect('admin/barang');
	}

	public function hapus_kategori($id_kategori = null)
	{
		$this->kategori_model->delete($id_kategori);
		$this->session->set_flashdata('berhasil_hapus_kategori','Berhasil menghapus 1 kategori barang!');
		redirect('admin/barang');
	}
}