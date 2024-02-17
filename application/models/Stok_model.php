<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stok_model extends CI_Model {

	private $table = 'tb_stok';

	// CRUD START //

    public function get() {
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function get_by_id($id_stok) {
        $query = $this->db->get_where($this->table, ['id_stok' => $id_stok]);
        return $query->row();
    }

    public function insert($stok) {
        $this->db->insert($this->table, $stok);
    }

    public function update($stok) {
        return $this->db->update($this->table, $stok, ['id_stok' => $stok['id_stok']]);
    }

    public function delete($id_stok) {
        $this->db->where('id_stok', $id_stok);
        $this->db->delete($this->table);
    }

    // END CRUD //

    public function get_join_barang_supplier()
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->join('tb_supplier','tb_stok.id_supplier = tb_supplier.id_supplier','left');
        $this->db->join('tb_barang','tb_stok.id_barang = tb_barang.id_barang','left');
        $query = $this->db->get();
        return $query->result();
    }
}

