<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Stok extends CI_Controller {

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
		$data['barang'] = $this->barang_model->get();
		$data['supplier'] = $this->supplier_model->get();
		$data['stok'] = $this->stok_model->get_join_barang_supplier();
		$data['halaman_stok'] = 'collapsed';

		if ($this->input->method() === 'post') {

			$id_barang = $this->input->post('id_barang');
			$id_supplier = $this->input->post('id_supplier');
			$tambahan = $this->input->post('tambahan');
			$pengeluaran = $this->input->post('pengeluaran');
			$keterangan = $this->input->post('keterangan');

			$barang_akan_update = $this->barang_model->get_by_id($id_barang);
			$stok_baru = $barang_akan_update->stok + $tambahan;

			$barang = [
				'id_barang'	=> $id_barang,
				'stok'		=> $stok_baru
			];

			$updated = $this->barang_model->update($barang);

			$stok = [
				'id_stok' 		=> 'ST' . date('y'.'m'.'d'.'h'.'i'.'s'),
				'id_barang' 	=> $id_barang,
				'id_supplier'	=> $id_supplier,
				'tambahan'		=> $tambahan,
				'pengeluaran'	=> $pengeluaran,
				'keterangan'	=> $keterangan,
				'tanggal'		=> date('Y-m-d H:i:s')
			];

			$inserted = $this->stok_model->insert($stok);

			if ($updated && $inserted) {
				echo "string";
				die();
				$this->session->set_flashdata('berhasil','Berhasil menambahkan <strong>' . $tambahan . '</strong> stok untuk <strong>' . $barang_akan_update . '</strong>');
				redirect('admin/stok');
			} else {
				$this->session->set_flashdata('gagal','Gagal menambahkan!');
				redirect('admin/stok');
			}
		}

		$this->load->view('admin/stok/stok', $data);
	}

	public function hapus($id_stok = null)
	{
		$this->stok_model->delete($id_stok);
		$this->session->set_flashdata('berhasil_hapus','Berhasil menghapus riwayat stok barang!');
		redirect('admin/stok');
	}

	public function tambah_supplier()
	{
		$supplier = [
			'id_supplier' 	=> uniqid(),
			'nama_supplier' => $this->input->post('nama_supplier'),
			'no_hp'			=> $this->input->post('no_hp'),
			'alamat'		=> $this->input->post('alamat')
		];
		$this->supplier_model->insert($supplier);
		$this->session->set_flashdata('tambah_supplier', 'Berhasil menambahkan supplier baru!');
		redirect('admin/stok');
	}

	public function edit_supplier($id_supplier = null)
	{
		$supplier = [
			'id_supplier' 	=> $id_supplier,
			'nama_supplier' => $this->input->post('nama_supplier'),
			'no_hp'			=> $this->input->post('no_hp'),
			'alamat'		=> $this->input->post('alamat')
		];
		// var_dump($supplier);
		// die();
		$this->supplier_model->update($supplier);
		$this->session->set_flashdata('edit_supplier', 'Berhasil mengubah 1 data supplier!');
		redirect('admin/stok');
	}

	public function hapus_supplier($id_supplier)
	{
		$this->supplier_model->delete($id_supplier);
		$this->session->set_flashdata('hapus_supplier', 'Berhasil menghapus supplier!');
		redirect('admin/stok');
	}
}
