<?php

require_once '../libraries/config.lib.php';
require_once '../libraries/database.lib.php';
require_once '../libraries/form.lib.php';
require_once '../libraries/hash.lib.php';
require_once '../libraries/login.lib.php';
require_once '../libraries/model.lib.php';
require_once '../libraries/upload.lib.php';
require_once '../models/page.collection.php';
require_once '../models/thread.collection.php';
require_once '../models/user.models.php';

Login::not_user();

$user = new Model('tb_users');

$user->load($_SESSION['user_id']);

$title = 'Edit Your Profile';

if($_FILES){
	$upload_result = Upload::to_folder('assets/img/');

	foreach($upload_result as $file){
		if($file['error_message']){
			$error_message = $file['error_message'];
		}else{
			$user->image = $file['filepath'];
		}
	}
}

if($_POST){

	$user->username = $_POST['username'];
	$user->email = $_POST['email'];
	$user->hide_email = $_POST['hide_email'];
	$user->security_question = $_POST['security_question'];
	$user->security_answer = $_POST['security_answer'];
	$user->description = $_POST['description'];
	$user->signature = $_POST['signature'];
	$user->location = $_POST['location'];
	//Saves the threads
	$user->save();
	//Redirects us to the page where we just added the new pages
	header("location: user_profile.php?id=$user->id");
	exit;
}

include '../views/header.php';
include '../views/navigation.php';
include '../views/profile_content.php';
include '../views/footer.php';