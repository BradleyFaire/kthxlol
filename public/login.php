<?php

session_start();

require_once '../libraries/config.lib.php';
require_once '../libraries/database.lib.php';
require_once '../libraries/form.lib.php';
require_once '../libraries/hash.lib.php';
require_once '../libraries/login.lib.php';
require_once '../libraries/model.lib.php';
require_once '../libraries/admin.lib.php';
require_once '../libraries/user.lib.php';
require_once '../models/page.collection.php';

if($_POST){

	# create a new user
	$user = new User();

	# store the posted username and password into $user
	$user->username = $_POST['username'];
	$user->password = $_POST['password'];

	if($user->authenticate()){

		# check if the user is an admin
		if($user->admin == 1){
			# sets the admin to logged in in the Session for access to extra features across the site.
			Login::admin_log_in();
		}else{
			# then log them in as a user instead
			Login::user_log_in();
		}

		$_SESSION['user_id']     = $user->id;
		$_SESSION['username']    = $user->username;
		$_SESSION['email']       = $user->email;
		$_SESSION['hide_email']  = $user->hide_email;
		$_SESSION['image']       = $user->image;
		$_SESSION['description'] = $user->description;
		$_SESSION['signature']   = $user->signature;
		$_SESSION['location']    = $user->location;
		$_SESSION['date_joined'] = $user->date_joined;

		header('location: index.php');
		exit;

	}else{
		# otherwise the login details are wrong
		$error = 'Incorrect username, password or no input';
	}
}

include '../views/header.php';
include '../views/navigation.php';
include '../views/login_form.php';
include '../views/footer.php';