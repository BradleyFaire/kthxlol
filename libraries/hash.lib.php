<?php

#folder: libraries.
#filename: hash.lib.php

class Hash{

	public function encrypt($password, $salt){

		return hash('sha256', $salt.$password);

	}

	public function salt(){

		return hash('sha256', time().time());

	}

	public function make_password($password){

		return self::encrypt($password, self::salt());

	}

	public function make_token($email, $time){
		return hash('sha256', $email.$time);
	}

	public function small_hash($token){
		return hash('crc32b', $token);
	}
}