<?php

#start a new session if not already started
session_start();

require_once '../libraries/config.lib.php';
require_once '../libraries/database.lib.php';
require_once '../libraries/form.lib.php';
require_once '../libraries/hash.lib.php';
require_once '../libraries/login.lib.php';
require_once '../libraries/model.lib.php';
require_once '../libraries/email.lib.php';
require_once '../models/page.collection.php';

# if the form was just posted AND the password matches the confirmed password field
if($_POST && $_POST['password'] == $_POST['confirmpassword']){

	$token = Hash::make_token($_POST['email'], time());

	$email = new Email();

	$email->to = $_POST['email'];
	$email->from = 'noreply@kthxlol.com';
	$email->subject = 'Confirm Registration to kthxlol.com';
	$email->message = '<p>If you have registered for an account at kthxlol.com, please click this link to continue with the registration process: <a href="http://bradley.faire.yoobee.net.nz/kthxlol/public/continue_registration.php?token='.$token.'">Continue Registration</a></p>
		<p>If this was not you, click this link to cancel the registration: <a href="http://bradley.faire.yoobee.net.nz/kthxlol/public/cancel_registration.php?token='.$token.'">Cancel</a></p>';
	 
	$email->send();

	if($email->success){

		$user = new Model(tb_users);

		# store the posted username inside $user
		$user->username 	   = $_POST['username'];
		$user->email		   = $_POST['email'];
		$user->deleted		   = 1;
		# encrypt their new password and salt
		$user->password        = Hash::make_password($_POST['password']);
		$user->salt            = Hash::salt();
		$user->security_token  = $token;
		# and store the new stuff into the db
		$user->save();

		header('location: check_email.php?id=1');
		exit;
	}else{
		header('location: check_email.php?id=2');
		exit;
	}
}

# if they posted the login form but the passwords don't match, don't let them log in
else if($_POST){

	$error = 'Passwords do not match.';

}

include '../views/header.php';
include '../views/navigation.php';
include '../views/register_form.php';
include '../views/footer.php';