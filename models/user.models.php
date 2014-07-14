<?php 

require_once '../libraries/config.lib.php';
require_once '../libraries/hash.lib.php';

class User{

	#Property ===============================================!

	public $customer_id = 0;
	public $admin_id = 0;
	public $username = '';
	public $password = '';
	private $db = null;

	#MAGIC METHODS ===============================================!

	# establish a connection to the db
	function __construct($admin_id = 0, $customer_id = 0){
		$this->db = new Database(
			Config::$hostname,
			Config::$username,
			Config::$password,
			Config::$database
			);

		# if it is an admin
		if($admin_id){

			# select the admin's id, username, and pw where the id matches
			$result = $this->db
			->select('id, username, password')
			->from('tb_admins')
			->where('id', $admin_id)
			->get_one();

			# the user's id, username and pw are stored into $result array
			$this->admin_id = $result['id'];
			$this->username = $result['username'];
			$this->password = $result['password'];

		# otherwise if it is a customer
		}else if($customer_id){

			# select the customer's id, username, and pw where the id matches
			$result = $this->db
			->select('id, username, password')
			->from('tb_customers')
			->where('id', $customer_id)
			->get_one();

			# the user's id, username and pw are stored into $result array
			$this->customer_id = $result['id'];
			$this->username = $result['username'];
			$this->password = $result['password'];
		}
	}

	#NORMAL METHODS ===============================================!

		public function admin_authenticate(){
			
			# select the salt where the inputted username matches in the db
			$user = $this->db
				->select('salt')
				->from('tb_admins')
				->where('username', $this->username)
				->get_one();

			# encrypt the password and add the user's salt, store it in $encrypted_pw
			$encrypted_pw = Hash::encrypt(
				$this->password,
				$user['salt']
				);

			# select the admin's id where the encrypted pws match
			$result = $this->db
				->select('id')
				->from('tb_admins')
				->where('password', $encrypted_pw)
				->get_one();

			# if there is a match in the admin db
			if($result['id']){
				$this->admin_id = $result['id'];
				# then open the gates
				return true;
			}else{
				# otherwise, they entered something wrong
				return false;
			}
		}
		
		public function authenticate(){
			
			# select the salt where the inputted username matches in the db
			$user = $this->db
				->select('salt')
				->from('tb_customers')
				->where('username', $this->username)
				->get_one();

			# encrypt the password and add the user's salt, store it in $encrypted_pw
			$encrypted_pw = Hash::encrypt(
					$this->password,
					$user['salt']
					);

			# select the user's id where the encrypted pws match
			$result = $this->db
				->select('id')
				->from('tb_users')
				->where('password', $encrypted_pw)
				->get_one();

			# if there is a match in the customer db
			if($result['id']){
				$this->customer_id 	= $result['id'];
				# then open the gates
				return true;
			}else{
				# otherwise, they entered something wrong
				return false;
			}
		}



		public function save(){
			#if this is is 0 then no subject has been already loaded
			if($this->id == 0){
				#set the username, encrypted password, and salt
				$success = $this->db
					->set(array(
						'username'		=> $this->username,
						'password'		=> Hash::make_password($this->password),
						'salt'			=> Hash::salt()
						
					))
				# put the new user into tb_users
				->insert('tb_users');
			}else{
				#set the username, encrypted password, and salt
				$success = $this->db
					->set(array(
						'username'		=> $this->username,
						'password'		=> Hash::make_password($this->password),
						'salt'			=> Hash::salt()
						))
				#find the user by id and update it
				->where('id', $this->id)
				->update('tb_users');
			}
			# Saved!
			return $success;
		}

		#change the deleted column to 1 (true)
		public function delete(){
			$this->deleted = 1;
			$this->save();
		}



}