<?php

require_once '../libraries/database.lib.php';
require_once '../libraries/model.lib.php';


# if the category_id exists in the url, then
if($_GET['email']){
	# set up access to tb_categories in db
	$user = new Register();
	# load all of the information of this category's id
	$user->users_email($_GET['email']);
	# then delete it
	
	$user->hard_delete();
}

# redirect to index
header('location: forum.php');
exit;