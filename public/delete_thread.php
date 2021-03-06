<?php

require_once '../libraries/database.lib.php';
require_once '../libraries/model.lib.php';
require_once '../libraries/login.lib.php';

#if you are not logged in, then you cannot access this page
Login::not_user();

# if the category_id exists in the url, then
if($_GET['id']){
	# set up access to tb_categories in db
	$thread_thing = new Model('tb_threads');
	# load all of the information of this category's id
	$thread_thing->load($_GET['id']);

	if($_SESSION['admin_logged_in'] == false){
		# and also not a customer
		if($thread_thing->user_id != $_SESSION['user_id']){
			# then you'd better log in before you look at that
			header("location: forum.php");
			exit;
		}
	}

	# then delete it
	$thread_thing->delete();
}

# redirect to index
header('location: forum.php');
exit;