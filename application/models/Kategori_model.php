<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori_model extends CI_Model {

	private $table = 'tb_kategori';

	// CRUD START //

    public function get() {
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function get_by_id($id_kategori) {
        $query = $this->db->get_where($this->table, ['id_kategori' => $id_kategori]);
        return $query->row();
    }

    public function insert($kategori) {
        $this->db->insert($this->table, $kategori);
    }

    public function update($kategori) {
        return $this->db->update($this->table, $kategori, ['id_kategori' => $kategori['id_kategori']]);
    }

    public function delete($id_kategori) {
        $this->db->where('id_kategori' , $id_kategori);
        $this->db->delete($this->table);
    }

    // END CRUD //
}

