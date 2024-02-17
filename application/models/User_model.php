<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

	private $table = 'tb_user';

	// CRUD START //

    public function get() {
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function get_by_id($id_user) {
        $query = $this->db->get_where($this->table, ['id_user' => $id_user]);
        return $query->row();
    }

    public function insert($user) {
        $this->db->insert($this->table, $user);
    }

    public function update($user) {
        return $this->db->update($this->table, $user, ['id_user' => $user['id_user']]);
    }

    public function delete($id_user) {
        $this->db->where($this->table, $id_user);
        $this->db->delete($this->table);
    }

    // END CRUD //

    public function login($nama, $password)
    {
        $user = $this->db->get_where($this->table, ['nama_user' => $nama])->row();
    
        if (!$user) {
            return FALSE;
        } else {
            if (!password_verify($password, $user->password)) {
                return FALSE;
            } else {
                return $user;
            } 
        } 
    }
}

