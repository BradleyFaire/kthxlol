<?php

require_once '../libraries/config.lib.php';
require_once '../libraries/database.lib.php';
require_once '../libraries/form.lib.php';
require_once '../libraries/hash.lib.php';
require_once '../libraries/login.lib.php';
require_once '../libraries/model.lib.php';
require_once '../models/page.collection.php';
require_once '../models/thread.collection.php';
require_once '../libraries/user.lib.php';

Login::not_user();

$user = new Model('tb_users');

$title = 'Change Password';

if($_POST && $_POST['password'] == $_POST['confirmpassword']){

	# create a new user
	$user = new User();

	# store the posted username and password into $user
	$user->username = $_SESSION['username'];
	$user->password = $_POST['current_password'];

	if($user->authenticate()){

		$user->password        = Hash::make_password($_POST['password']);
		$user->salt            = Hash::salt();
		$user->save();

		header('location: check_email.php?id=4');
		exit;

	}else{
		# otherwise the login details are wrong
		$error = 'Incorrect current password or no input';
	}
}else if($_POST){

	$error = 'New passwords do not match.';

}

include '../views/header.php';
include '../views/navigation.php';
include '../views/password.php';
include '../views/footer.php';