<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Penjualan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata('id_user')){
			redirect('auth');
		} else {
			$id_user = $this->session->userdata('id_user');
			$user = $this->user_model->get_by_id($id_user);
			if ($user->level !== 'kasir') {
				$this->session->set_flashdata('hak_akses_salah','Tidak ada izin untuk mengakses!');
				redirect('auth');
			}
		}
	}

	public function index()
	{
		$id_user = $this->session->userdata('id_user');

		$data['halaman_penjualan'] = 'collapsed';

		$data['user'] = $this->user_model->get_by_id($id_user);
		$data['kategori_barang'] = $this->kategori_model->get();
		$data['barang_barang'] = $this->barang_model->get();
		$data['pesanan'] = $this->session->userdata('pesanan');

		if ($this->input->method() === 'post') {

        	$id_barang = $this->input->post("id_barang");
        	$barang = $this->barang_model->get_by_id($id_barang);

        	if (!$barang) {
        		$this->session->set_flashdata('tidak_ketemu','Barang tidak ditemukan!');
        		redirect('kasir/penjualan');
        	} else {
				$pesanan = $this->session->userdata('pesanan');
	
				if (!empty($pesanan)) {
					$sudah_ada = array_search($id_barang, array_column($pesanan, 'id_barang'));
	
					if ($sudah_ada !== false) {
						if ($pesanan[$sudah_ada]['jumlah'] >= $barang->stok) {
							$this->session->set_flashdata('stok_kurang', 'Stok barang kurang!');
							redirect('kasir/penjualan');
						} else {
							$pesanan[$sudah_ada]['jumlah']++;
							$pesanan[$sudah_ada]['subtotal'] = $pesanan[$sudah_ada]['jumlah'] * $pesanan[$sudah_ada]['harga'];
						}
					} else {
						if ($barang->stok <= 0) {
							$this->session->set_flashdata('stok_kurang', 'Stok barang kurang!');
							redirect('kasir/penjualan');
						} else {
							$item = [
        						'id_barang' => $barang->id_barang,
        						'nama' 		=> $barang->nama,
        						'harga_beli'=> $barang->harga_beli,
        						'harga' 	=> $barang->harga,
        						'stok' 		=> $barang->stok,
        						'jumlah'	=> 1,
        						'subtotal'	=> $barang->harga
        					];
				
        					$pesanan[] = $item;
        				}					
					}
				} else {
					if ($barang->stok <= 0) {
						$this->session->set_flashdata('stok_kurang', 'Stok barang kurang!');
						redirect('kasir/penjualan');
					} else {
						$item = [
        					'id_barang' => $barang->id_barang,
        					'nama' 		=> $barang->nama,
        					'harga_beli'=> $barang->harga_beli,
        					'harga' 	=> $barang->harga,
        					'stok' 		=> $barang->stok,
        					'jumlah'	=> 1,
        					'subtotal'	=> $barang->harga
        				];
			
        				$pesanan[] = $item;
        			}
				}

        		$this->session->set_userdata('pesanan', $pesanan);
	
        		$total_harga = 0;
        		$total_jumlah= 0;
        		$no = 0;
        		foreach ($pesanan as $pesan) {
        			$total_harga += $pesanan[$no]['subtotal'];
        			$total_jumlah += $pesanan[$no]['jumlah'];
        			$no++;
        		}
        	}

        	$this->session->set_userdata('total_harga', $total_harga);	
        	$this->session->set_userdata('total_jumlah', $total_jumlah);	
    	}

		$data['total_harga'] = $this->session->userdata('total_harga');
		$data['total_jumlah'] = $this->session->userdata('total_jumlah');
    	
		$data['pesanan'] = $this->session->userdata('pesanan');
		$this->load->view('kasir/penjualan/penjualan', $data);
	}

	public function transaksi()
	{
		$id_user = $this->session->userdata('id_user');
		$data['user'] = $this->user_model->get_by_id($id_user);

		$pesanan = $this->session->userdata('pesanan');
		$total_harga = $this->session->userdata('total_harga');
		$total_jumlah = $this->session->userdata('total_jumlah');

		$bayar = $this->input->post('bayar');
		$kembalian = $this->input->post('kembalian');
		// echo $kembalian;
		// die();

		if ($bayar < $total_harga) {
			$this->session->set_flashdata('bayar_kurang', 'Uang pembayaran kurang!');
			redirect('kasir/penjualan');
		} else {
			$this->session->set_userdata('bayar', $bayar);
			$this->session->set_userdata('kembalian', $kembalian);

			$id_transaksi = 'TR'.date('Y'.'m'.'d'.'h'.'i'.'s');

			$harga_beli_tiap_barang = [];
			$harga_beli_tiap_barang = [];
			$total_harga_beli = 0;
			$total_harga_jual = 0;
			$no = 0;
			$urut = 0;

			foreach ($pesanan as $pesan) {
				$harga_beli_tiap_barang[] = $pesanan[$no]['harga_beli'] * $pesanan[$no]['jumlah'];
				$harga_jual_tiap_barang[] = $pesanan[$no]['harga'] * $pesanan[$no]['jumlah'];
				$no++;
			}

			foreach ($pesanan as $pesan) {
				$total_harga_beli += $harga_beli_tiap_barang[$urut];
				$total_harga_jual += $harga_jual_tiap_barang[$urut];
				$urut++;
			}

			$laba = $total_harga_jual - $total_harga_beli;

			$transaksi = [
				'id_transaksi'	=> $id_transaksi,
				'id_user'		=> $id_user,
				'tanggal'		=> date('Y-m-d H:i:s'),
				'total'			=> $total_harga,
				'bayar'			=> $bayar,
				'kembalian'		=> $kembalian,
				'laba'			=> $laba
			];
			$this->transaksi_model->insert($transaksi);

			foreach ($pesanan as $pesan) {
				$detail_transaksi = [
					'id_detail_transaksi'	=> uniqid('', true),
					'id_transaksi'			=> $id_transaksi,
					'id_barang'				=> $pesan['id_barang'],
					'jumlah'				=> $pesan['jumlah'],
					'total'					=> $pesan['subtotal']
				];
				$this->detail_transaksi_model->insert($detail_transaksi);
			}

			foreach ($pesanan as $pesan) {
				$ambil_barang = $this->barang_model->get_by_id($pesan['id_barang']);
				$stok_akhir = $ambil_barang->stok - $pesan['jumlah'];
				$barang = [
					'id_barang'	=> $pesan['id_barang'],
					'stok'		=> $stok_akhir
				];
				$this->barang_model->update($barang);
			}
			$this->session->set_userdata('id_transaksi',$id_transaksi);

			$this->session->unset_userdata('pesanan');
			$this->session->unset_userdata('total_harga');
			$this->session->unset_userdata('total_jumlah');

			redirect('kasir/penjualan/print');
		}		
	}

	public function print()
	{
		$id_transaksi = $this->session->userdata('id_transaksi');
		$id_user = $this->session->userdata('id_user');

		$data['halaman_penjualan'] = 'collapsed';

		$data['bayar'] = $this->session->userdata('bayar');
		$data['kembalian'] = $this->session->userdata('kembalian');

		$data['user'] = $this->user_model->get_by_id($id_user);
		$data['transaksi'] = $this->transaksi_model->get_by_id_join_user($id_transaksi);
		$data['detail_transaksi'] = $this->detail_transaksi_model->get_by_id_transaksi($id_transaksi);
		// var_dump($data['bayar'].$data['kembalian']);
		// die();

		$this->load->view('kasir/penjualan/print', $data);
	}

	public function back()
	{
		$this->session->set_flashdata('transaksi_berhasil', 'Transaksi berhasil!');
		redirect('kasir/penjualan');
	}

	public function kurang_pesanan($id_barang = null)
	{
		$barang = $this->barang_model->get_by_id($id_barang);
		$pesanan = $this->session->userdata('pesanan');
		$sudah_ada = array_search($id_barang, array_column($pesanan, 'id_barang'));

		if ($pesanan[$sudah_ada]['jumlah'] <= 1) {

			unset($pesanan[$sudah_ada]);
			
			$total_harga = 0;
        	$total_jumlah= 0;
        	$no = 0;
        	foreach ($pesanan as $pesan) {
        		$total_harga += $pesanan[$no]['subtotal'];
        		$total_jumlah += $pesanan[$no]['jumlah'];
        		$no++;
        	 }

        	$this->session->set_userdata('total_harga', $total_harga);	
        	$this->session->set_userdata('total_jumlah', $total_jumlah);	
			$this->session->set_userdata('pesanan', $pesanan);
			redirect('kasir/penjualan');

		} else {

			$pesanan[$sudah_ada]['jumlah'] -= 1;
			$pesanan[$sudah_ada]['subtotal'] = $pesanan[$sudah_ada]['jumlah'] * $pesanan[$sudah_ada]['harga'];

			$total_harga = 0;
        	$total_jumlah= 0;
        	$no = 0;
        	foreach ($pesanan as $pesan) {
        		$total_harga += $pesanan[$no]['subtotal'];
        		$total_jumlah += $pesanan[$no]['jumlah'];
        		$no++;
        	}

        	$this->session->set_userdata('total_harga', $total_harga);	
        	$this->session->set_userdata('total_jumlah', $total_jumlah);	
			$this->session->set_userdata('pesanan', $pesanan);
			redirect('kasir/penjualan');
		}		
	}

	public function tambah_pesanan($id_barang = null)
	{
		$barang = $this->barang_model->get_by_id($id_barang);
		$pesanan = $this->session->userdata('pesanan');
		$sudah_ada = array_search($id_barang, array_column($pesanan, 'id_barang'));

		if ($pesanan[$sudah_ada]['jumlah'] >=  $barang->stok) {
			$this->session->set_flashdata('stok_kurang', 'Stok barang kurang!');
			redirect('kasir/penjualan');
		} else {
			$pesanan[$sudah_ada]['jumlah']+=1;
			$pesanan[$sudah_ada]['subtotal'] = $pesanan[$sudah_ada]['jumlah'] * $pesanan[$sudah_ada]['harga'];

			$total_harga = 0;
        	$total_jumlah= 0;
        	$no = 0;
        	foreach ($pesanan as $pesan) {
        		$total_harga += $pesanan[$no]['subtotal'];
        		$total_jumlah += $pesanan[$no]['jumlah'];
        		$no++;
        	}

        	$this->session->set_userdata('total_harga', $total_harga);	
        	$this->session->set_userdata('total_jumlah', $total_jumlah);	
			$this->session->set_userdata('pesanan', $pesanan);
			redirect('kasir/penjualan');
		}		
	}

	public function kosong_pesanan()
	{
		$this->session->unset_userdata('pesanan');
		$this->session->unset_userdata('total_harga');
		$this->session->unset_userdata('total_jumlah');
		redirect('kasir/penjualan');
	}
}
