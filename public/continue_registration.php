<?php

#start a new session if not already started
session_start();

require_once '../libraries/config.lib.php';
require_once '../libraries/database.lib.php';
require_once '../libraries/form.lib.php';
require_once '../libraries/hash.lib.php';
require_once '../libraries/login.lib.php';
require_once '../libraries/model.lib.php';
require_once '../libraries/register.lib.php';
require_once '../models/page.collection.php';

# if the form was just posted AND the password matches the confirmed password field
if($_POST && $_POST['security_question'] && $_POST['security_answer']){

	$user = new Register();

	$user->users_token($_GET['token']);

	# store the posted username inside $user
	$user->hide_email	       = $_POST['hide_email'];
	$user->security_question   = $_POST['security_question'];
	$user->security_answer	   = $_POST['security_answer'];
	$user->deleted		       = 0;
	# and store the new stuff into the db
	$user->save();

	Login::user_log_in();

	$_SESSION['user_id']     = $user->id;
	$_SESSION['username']    = $user->username;
	$_SESSION['email']       = $user->email;
	$_SESSION['hide_email']  = $user->hide_email;
	$_SESSION['image']       = $user->image;
	$_SESSION['description'] = $user->description;
	$_SESSION['signature']   = $user->signature;
	$_SESSION['location']    = $user->location;
	$_SESSION['date_joined'] = $user->date_joined;

	header('location: edit_profile.php');
	exit;

}else if($_POST){

	$error = 'You must add a security question and answer';

}

include '../views/header.php';
include '../views/navigation.php';
include '../views/register_form2.php';
include '../views/footer.php';