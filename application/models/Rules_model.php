<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rules_model extends CI_Model {

	public function login_rules()
	{
		return [
			[
				'field' => 'nama', 
				'label' => 'Nama', 
				'rules' => 'required|max_length[32]'
			],
			[
				'field' => 'password', 
				'label' => 'Password', 
				'rules' => 'required'
			],
		];
	}

	public function barang_rules()
	{
		return [
			[
				'field' => 'nama',
				'label' => 'Nama',
				'rules' => 'required|max_length[32]'
			],
			[
				'field' => 'harga_beli',
				'label' => 'Harga_beli',
				'rules' => 'required'
			],
			[
				'field' => 'harga',
				'label' => 'Harga',
				'rules' => 'required'
			],
			[
				'field' => 'stok',
				'label' => 'Stok',
				'rules' => 'required'
			]
		];
	}

}