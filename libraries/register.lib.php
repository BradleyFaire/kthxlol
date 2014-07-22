<?php

require_once '../libraries/model.lib.php';

class Register extends Model{

	public $table = 'tb_users';

	# construct the tb_users table
	public function __construct(){
		parent::__construct($this->table);
	}

	# see if they have correct user login details
	public function users_email($email){
		$result = $this->db
			->select('*')
			->from($this->table)
			->where('email', $email)
			->where_and('deleted', 1)
			->get_one();

		$this->data = $result;
	}

}