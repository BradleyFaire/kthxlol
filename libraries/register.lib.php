<?php

require_once '../libraries/model.lib.php';

class Register extends Model{

	public $table = 'tb_users';

	# construct the tb_users table
	public function __construct(){
		parent::__construct($this->table);
	}

	# see if they have correct user login details
	public function users_token($token){
		$result = $this->db
			->select('*')
			->from($this->table)
			->where('security_token', $token)
			->where_and('deleted', 1)
			->get_one();

		$this->data = $result;
	}

	public function users_email($email){
		$result = $this->db
			->select('*')
			->from($this->table)
			->where('email', $email)
			->where_and('deleted', 0)
			->get_one();
		if($email == $result['email']){
			$this->data = $result;
			return true;
		}else{
			return false;
		}
	}

	public function users_answer($answer){
		$result = $this->db
			->select('*')
			->from($this->table)
			->where('security_answer', $answer)
			->where_and('deleted', 0)
			->get_one();
		if($answer == $result['answer']){
			$this->data = $result;
			return true;
		}else{
			return false;
		}
	}

}