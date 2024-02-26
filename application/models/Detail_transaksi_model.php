<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Detail_transaksi_model extends CI_Model {

    private $table = 'tb_detail_transaksi';

    // CRUD START //

    public function get() {
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function get_by_id($id_detail_transaksi) {
        $query = $this->db->get_where($this->table, ['id_detail_transaksi' => $id_detail_transaksi]);
        return $query->row();
    }

    public function insert($detail_transaksi) {
        $this->db->insert($this->table, $detail_transaksi);
    }

    public function update($detail_transaksi) {
        return $this->db->update($this->_table, $detail_transaksi, ['id_detail_transaksi' => $detail_transaksi['id_detail_transaksi']]);
    }

    public function delete($id_detail_transaksi) {
        $this->db->where($this->table, $id_detail_transaksi);
        $this->db->delete($this->table);
    }

    // END CRUD //

    public function get_by_id_transaksi($id_transaksi) 
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->join('tb_barang', 'tb_detail_transaksi.id_barang = tb_barang.id_barang', 'left');
        $this->db->join('tb_kategori', 'tb_barang.kategori = tb_kategori.id_kategori', 'left');
        $this->db->where($this->table . '.id_transaksi', $id_transaksi);
        $query = $this->db->get();
        return $query->result();
    }
}

