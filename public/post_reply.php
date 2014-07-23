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

$thread = new Model('tb_threads');
$thread->load($_GET['id']);

$comment = new Model('tb_comments');

if($_GET['comment_id']){
	$comment->load($_GET['comment_id']);

	if($_SESSION['admin_logged_in'] == false){
		# and also not a customer
		if($comment->user_id != $_SESSION['user_id']){
			# then you'd better log in before you look at that
			header("location: forum.php");
			exit;
		}
	}

	$title = 'Edit Comment';
}else{ 
	$title = 'New Comment';
}

if($_POST){
	//
	$comment->thread_id = $_POST['thread_id'];
	$comment->user_id = $_POST['user_id'];
	$comment->content = $_POST['content'];
	$comment->save();
	header("location: thread.php?id=$comment->thread_id");
	exit;
}

include '../views/header.php';
include '../views/navigation.php';
include '../views/reply_form.php';
include '../views/footer.php';