<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Supplier_model extends CI_Model {

	private $table = 'tb_supplier';

	// CRUD START //

    public function get() {
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function get_by_id($id_supplier) {
        $query = $this->db->get_where($this->table, ['id_supplier' => $id_supplier]);
        return $query->row();
    }

    public function insert($supplier) {
        $this->db->insert($this->table, $supplier);
    }

    public function update($supplier) {
        return $this->db->update($this->table, $supplier, ['id_supplier' => $supplier['id_supplier']]);
    }

    public function delete($id_supplier) {
        $this->db->where('id_supplier', $id_supplier);
        $this->db->delete($this->table);
    }

    // END CRUD //
}

