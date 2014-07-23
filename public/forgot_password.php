<?php

session_start();

require_once '../libraries/config.lib.php';
require_once '../libraries/database.lib.php';
require_once '../libraries/form.lib.php';
require_once '../libraries/hash.lib.php';
require_once '../libraries/login.lib.php';
require_once '../libraries/model.lib.php';
require_once '../libraries/register.lib.php';
require_once '../libraries/email.lib.php';
require_once '../models/page.collection.php';

$user = new Register();

if($_SESSION['check'] != 1){
	if($_POST && $user->users_email($_POST['email'])){
		$_SESSION['check'] = 1;
		$_SESSION['temp_id'] = $user->id;
		$_SESSION['temp_question'] = $user->security_question;
		$_SESSION['temp_answer'] = $user->security_answer;
		$_SESSION['temp_user'] = $user->username;
		$_SESSION['temp_email'] = $user->email;
		$error = null;
	}elseif($_POST){
		$error = 'There is no user with this email.';
	}
}elseif($_SESSION['check']){

	if($_POST && $_POST['security_answer'] == $_SESSION['temp_answer']){

		$newpass = Hash::small_hash(time());
		$tempuser = $_SESSION['temp_user'];
		$tempemail = $_SESSION['temp_email'];

		$email = new Email();

		$email->to = $tempemail;
		$email->from = 'noreply@kthxlol.com';
		$email->subject = 'New Password for kthxlol.com';
		$email->message = "<p>You have reset your password to kthxlol.com</p><p>Your new password is: $newpass</p><p>Your username is $tempuser</p><p>You can log on to the website with that password and change it in your edit profile section.</p>";
		 
		$email->send();

		if($email->success){

			$newuser = new Model('tb_users');
			$newuser->load($_SESSION['temp_id']);
			$newuser->password   = Hash::make_password($newpass);
			$newuser->salt       = Hash::salt();
			$newuser->save();

			$_SESSION['check'] = null;
			$_SESSION['temp_id'] = null;
			$_SESSION['temp_question'] = null;
			$_SESSION['temp_answer'] = null;
			$_SESSION['temp_user'] = null;
			$_SESSION['temp_email'] = null;

			header('location: check_email.php?id=1');
			exit;
		}else{
			$_SESSION['check'] = null;
			$_SESSION['temp_id'] = null;
			$_SESSION['temp_question'] = null;
			$_SESSION['temp_answer'] = null;
			$_SESSION['temp_user'] = null;
			$_SESSION['temp_email'] = null;

			header('location: check_email.php?id=2');
			exit;
		}
	}elseif($_POST){
		$_SESSION['check'] = null;
		$_SESSION['temp_id'] = null;
		$_SESSION['temp_question'] = null;
		$_SESSION['temp_answer'] = null;
		$_SESSION['temp_user'] = null;
		$_SESSION['temp_email'] = null;

		$error = 'That is not the correct answer.';
	}
}


include '../views/header.php';
include '../views/navigation.php';

if($_SESSION['check']){
	include '../views/security_form.php';
}else{
	include '../views/email_form.php';
}

include '../views/footer.php';