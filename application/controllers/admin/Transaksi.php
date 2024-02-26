<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller
{
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
		$data['halaman_laporan'] = 'collapsed';

		if ($this->session->userdata('waktu_awal')) {
			$waktu_awal = $this->session->userdata('waktu_awal');
			$waktu_akhir = $this->session->userdata('waktu_akhir');

			$laporan_transaksi = $this->transaksi_model->get_by_time_join_user($waktu_awal, $waktu_akhir);

			if ($laporan_transaksi) {
				$data['detail_transaksi'] = [];
	
				foreach ($laporan_transaksi as $transaksi) {
	
					$detail = $this->detail_transaksi_model->get_by_id_transaksi($transaksi->id_transaksi);
					$data['detail_transaksi'] = $detail;
	
					$data['laporan_penjualan'][] = [
	
						'transaksi'			=> $transaksi,
						'detail_transaksi'	=> $data['detail_transaksi']
					];
				}
	
				$data['jumlah_penjualan'] = count($data['laporan_penjualan']);
	
				$data['total_transaksi'] = 0;
				$data['total_laba'] = 0;
	
				foreach ($data['laporan_penjualan'] as $laporan) {
					$data['total_transaksi'] += $laporan['transaksi']->total;
					$data['total_laba'] += $laporan['transaksi']->laba;
				}

				$data['waktu_awal'] = $waktu_awal;
				$data['waktu_akhir'] = $waktu_akhir;

				$this->session->unset_userdata('waktu_awal');
				$this->session->unset_userdata('waktu_akhir');
				// var_dump($data['laporan_penjualan']);
				// die();

			} else {
				$this->session->set_flashdata('tidak_ketemu','Tidak ditemukan riwayat transaksi pada periode <strong>' . $waktu_awal . '</strong> s/d <strong>' . $waktu_akhir . '</strong>');
			}
		}

		if ($this->input->method() === 'post') {
			$waktu_awal = $this->input->post('waktu_awal');
			$waktu_akhir = $this->input->post('waktu_akhir');
			

			$laporan_transaksi = $this->transaksi_model->get_by_time_join_user($waktu_awal, $waktu_akhir);

			if ($laporan_transaksi) {
				
				$data['detail_transaksi'] = [];
	
				foreach ($laporan_transaksi as $transaksi) {
	
					$detail = $this->detail_transaksi_model->get_by_id_transaksi($transaksi->id_transaksi);
					$data['detail_transaksi'] = $detail;
	
					$data['laporan_penjualan'][] = [
	
						'transaksi'			=> $transaksi,
						'detail_transaksi'	=> $data['detail_transaksi']
					];
				}
	
				$data['jumlah_penjualan'] = count($data['laporan_penjualan']);
	
				$data['total_transaksi'] = 0;
				$data['total_laba'] = 0;
	
				foreach ($data['laporan_penjualan'] as $laporan) {
					$data['total_transaksi'] += $laporan['transaksi']->total;
					$data['total_laba'] += $laporan['transaksi']->laba;
				}

				$data['waktu_awal'] = $waktu_awal;
				$data['waktu_akhir'] = $waktu_akhir;


			} else {
				$this->session->set_flashdata('tidak_ketemu','Tidak ditemukan riwayat transaksi pada periode <strong>' . $waktu_awal . '</strong> s/d <strong>' . $waktu_akhir . '</strong>');
				redirect('admin/transaksi');
			}
		}

		$this->load->view('admin/laporan/transaksi', $data);
	}

	public function hapus($id_transaksi = null)
	{
		$this->session->set_userdata('waktu_awal', $this->input->post('waktu_awal'));
		$this->session->set_userdata('waktu_akhir', $this->input->post('waktu_akhir'));

		$this->transaksi_model->delete($id_transaksi);
		$this->session->set_flashdata('hapus','Berhasil menghapus data transaksi');
		redirect('admin/transaksi');
	}

	public function ekspor_excel()
	{
		$waktu_awal = $this->input->post('waktu_awal');
		$waktu_akhir = $this->input->post('waktu_akhir');

		$laporan_transaksi = $this->transaksi_model->get_by_time_join_user($waktu_awal, $waktu_akhir);

		require(APPPATH. 'phpexcel/Classes/PHPExcel.php');
		require(APPPATH. 'phpexcel/Classes/PHPExcel/Writer/Excel2007.php');

		$object = new PHPExcel();

		$object->getProperties()->setCreator("Kedaisunnah");
		$object->getProperties()->setLastModifiedBy("Kedaisunnah");
		$object->getProperties()->setTitle("Data Transaksi");

		$object->setActiveSheetIndex(0);

		$object->getActiveSheet()->setCellValue('A1', 'No');
		$object->getActiveSheet()->setCellValue('B1', 'Kode Transaksi');
		$object->getActiveSheet()->setCellValue('C1', 'Kasir');
		$object->getActiveSheet()->setCellValue('D1', 'Tanggal');
		$object->getActiveSheet()->setCellValue('E1', 'Total');
		$object->getActiveSheet()->setCellValue('F1', 'Bayar');
		$object->getActiveSheet()->setCellValue('G1', 'Kembalian');
		$object->getActiveSheet()->setCellValue('H1', 'Laba');

		$baris = 2;
		$no = 1;

		foreach ($laporan_transaksi as $transaksi) {
			$object->getActiveSheet()->setCellValue('A' . $baris, $no++);
			$object->getActiveSheet()->setCellValue('B' . $baris, $transaksi->id_transaksi);
			$object->getActiveSheet()->setCellValue('C' . $baris, $transaksi->nama_user);
			$object->getActiveSheet()->setCellValue('D' . $baris, $transaksi->tanggal);
			$object->getActiveSheet()->setCellValue('E' . $baris, $transaksi->total);
			$object->getActiveSheet()->setCellValue('F' . $baris, $transaksi->bayar);
			$object->getActiveSheet()->setCellValue('G' . $baris, $transaksi->kembalian);
			$object->getActiveSheet()->setCellValue('H' . $baris, $transaksi->laba);

			$baris++;
		}

		$filename = "Data Transaksi ".$waktu_awal." sampai ". $waktu_akhir .'.xlsx';
		$object->getActiveSheet()->setTitle("Data Transaksi");

		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheethtml.sheet');
		header('Content-Disposition: attachment;filename="' . $filename . '"');
		header('Cache-Control: max-age=0');

		$writer = PHPExcel_IOFactory::createwriter($object, 'Excel2007');
		$writer->save('php://output');

		exit;
	}
}