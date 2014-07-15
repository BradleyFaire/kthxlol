<?php

require_once '../libraries/database.lib.php';
require_once '../libraries/model.lib.php';
require_once '../libraries/login.lib.php';

#if you are not logged in, then you cannot access this page
Login::kickout();

# if the category_id exists in the url, then
if($_GET['id']){
	# set up access to tb_categories in db
	$page_thing = new Model('tb_pages');
	# load all of the information of this category's id
	$page_thing->load($_GET['id']);
	# then delete it
	$page_thing->delete();
}

# redirect to index
header('location: index.php');
exit;