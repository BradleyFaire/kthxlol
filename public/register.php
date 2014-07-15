<?php

#start a new session if not already started
session_start();

require_once '../libraries/config.lib.php';
require_once '../libraries/database.lib.php';
require_once '../libraries/form.lib.php';
require_once '../libraries/hash.lib.php';
require_once '../libraries/login.lib.php';
require_once '../libraries/model.lib.php';
require_once '../models/page.collection.php';

# if the form was just posted AND the password matches the confirmed password field
if($_POST && $_POST['password'] == $_POST['confirmpassword']){

	# create a new user inside tb_customers
	$user = new Model(tb_users);

	# store the posted username inside $user
	$user->username 	= $_POST['username'];
	# encrypt their new password and salt
	$user->password     = Hash::make_password($_POST['password']);
	$user->salt         = Hash::salt();
	# and store the new stuff into the db
	$user->save();
	# now make them log in
	header('location: login_page.php');
	exit;
}

# if they posted the login form but the passwords don't match, don't let them log in
else if($_POST){

	$error = 'Passwords do not match.';

}

include '../views/header.php';
include '../views/navigation.php';
include '../views/register_form.php';
include '../views/footer.php';