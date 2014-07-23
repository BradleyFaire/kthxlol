<?php

require_once '../libraries/model.lib.php';
require_once '../libraries/hash.lib.php';

#Creates an extention to the Model Library, with a specific function used only in a specific situation. (The tb_users is specific to this function, which is why it is seperated from the model library, which can be used with any table.)
class User extends Model{

	public $table = 'tb_users';

	# construct the tb_users table
	public function __construct(){
		parent::__construct($this->table);
	}

	# see if they have correct user login details
	public function authenticate(){

		# select the id, salt, and encrypted pw from tb_users where the usernames match up
		$user = $this->db
			->select('*')
			->from($this->table)
			->where('username', $this->data['username'])
			->get_one();

		# encrypt the pw and salt they entered
		$encrypted_pw = Hash::encrypt(
			$this->data['password'],
			$user['salt']
		);

		# if the password they entered matches up with the encrypted one
		if($user['password'] == $encrypted_pw && $user['deleted'] == 0){
			$this->load($user['id']);
			# open the gates
			return true;
		}else{
			# otherwise get out of here
			return false;
		}
	}

}