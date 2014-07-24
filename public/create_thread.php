<?php

require_once '../libraries/config.lib.php';
require_once '../libraries/database.lib.php';
require_once '../libraries/form.lib.php';
require_once '../libraries/hash.lib.php';
require_once '../libraries/login.lib.php';
require_once '../libraries/model.lib.php';
require_once '../models/page.collection.php';
require_once '../models/thread.collection.php';
require_once '../models/user.models.php';

Login::not_user();

$thread_stuff = new Model('tb_threads');

if($_GET['id']){
	
	$thread_stuff->load($_GET['id']);

	if($_SESSION['admin_logged_in'] == false){
		# and also not a customer
		if($thread_stuff->user_id != $_SESSION['user_id']){
			# then you'd better log in before you look at that
			header("location: forum.php");
			exit;
		}
	}
	
	$title = 'Edit Thread';
}
else{
	
	$title = 'Create New Thread';
}

if($_POST){
	//
	$thread_stuff->name = $_POST['name'];
	$thread_stuff->user_id = $_POST['user_id'];
	$thread_stuff->content = $_POST['content'];
	$thread_stuff->date_posted = date('Y-m-d H:i:s');
	$thread_stuff->latest_change = date('Y-m-d H:i:s');
	//Saves the threads
	$thread_stuff->save();

	//Redirects us to the page where we just added the new pages
	header("location: thread.php?id=$thread_stuff->id");
	exit;
}

include '../views/header.php';
include '../views/navigation.php';
include '../views/new_thread_content.php';
include '../views/footer.php';