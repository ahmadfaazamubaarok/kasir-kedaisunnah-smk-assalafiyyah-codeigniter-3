<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi_model extends CI_Model {

	private $table = 'tb_transaksi';

	// CRUD START //

    public function get() {
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function get_by_id($id_transaksi) {
        $query = $this->db->get_where($this->table, ['id_transaksi' => $id_transaksi]);
        return $query->row();
    }

    public function insert($transaksi) {
        $this->db->insert($this->table, $transaksi);
    }

    public function update($transaksi) {
        return $this->db->update($this->_table, $transaksi, ['id_transaksi' => $transaksi['id_transaksi']]);
    }

    public function delete($id_transaksi) {
        $this->db->where('id_transaksi', $id_transaksi);
        $this->db->delete($this->table);
    }

    // END CRUD //

   public function get_by_time_join_user($waktu_awal, $waktu_akhir)
    {
        $this->db->select('transaksi.*, user.*');
        $this->db->from('tb_transaksi as transaksi');
        $this->db->join('tb_user as user', 'transaksi.id_user = user.id_user', 'left');
        $this->db->where('transaksi.tanggal >=', $waktu_awal);
        $this->db->where('transaksi.tanggal <=', $waktu_akhir);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_by_id_join_user($id_transaksi)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->join('tb_user', 'tb_transaksi.id_user = tb_user.id_user', 'left');
        $this->db->where('tb_transaksi.id_transaksi',$id_transaksi);
        return $this->db->get()->result();
    }
}

