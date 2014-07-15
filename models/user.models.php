<?php 

require_once '../libraries/config.lib.php';
require_once '../libraries/hash.lib.php';

class Users{

	#Property ===============================================!

	public $user_id = 0;
	public $username = '';
	public $password = '';
	public $email = '';
	public $image = '';
	public $description = '';
	public $signature = '';
	public $location = '';
	public $date_joined = '';
	public $admin = '';
	private $db = null;

	#MAGIC METHODS ===============================================!

	# establish a connection to the db
	function __construct($user_id){
		$this->db = new Database(
			Config::$hostname,
			Config::$username,
			Config::$password,
			Config::$database
			);

			# select the customer's id, username, and pw where the id matches
			$result = $this->db
			->select('id, username, password, email, image, description, signature, location, date_joined, admin')
			->from('tb_users')
			->where('id', $user_id)
			->get_one();

			# the user's id, username and pw are stored into $result array
			$this->user_id     = $result['id'];
			$this->username    = $result['username'];
			$this->password    = $result['password'];
			$this->email       = $result['email'];
			$this->image       = $result['image'];
			$this->description = $result['description'];
			$this->signature   = $result['signature'];
			$this->location    = $result['location'];
			$this->date_joined = $result['date_joined'];
			$this->admin       = $result['admin'];
	}

	#NORMAL METHODS ===============================================!
		
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