<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang_model extends CI_Model {

	private $table = 'tb_barang';

	// CRUD START //

    public function get() {
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function get_by_id($id_barang) {
        $query = $this->db->get_where($this->table, ['id_barang' => $id_barang]);
        return $query->row();
    }

    public function insert($barang) {
        $this->db->insert($this->table, $barang);
    }

    public function update($barang) {
        return $this->db->update($this->table, $barang, ['id_barang' => $barang['id_barang']]);
    }

    public function delete($id_barang) {
        $this->db->where('id_barang', $id_barang);
        $this->db->delete($this->table);
    }

    // END CRUD //

    public function get_max()
    {
        $this->db->select_max('id_barang');
        return $this->db->get($this->table)->row_array()['id_barang'];
    }

    public function get_join_kategori()
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->join('tb_kategori', 'tb_barang.kategori = tb_kategori.id_kategori', 'left');
        $query = $this->db->get();
        return $query->result();
    }
}

