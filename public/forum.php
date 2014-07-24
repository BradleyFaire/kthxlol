<?php

require_once '../libraries/config.lib.php';
require_once '../libraries/database.lib.php';
require_once '../libraries/form.lib.php';
require_once '../libraries/hash.lib.php';
require_once '../libraries/login.lib.php';
require_once '../libraries/model.lib.php';
require_once '../models/page.collection.php';
require_once '../models/comment.collection.php';
require_once '../models/thread.collection.php';
require_once '../models/user.models.php';


$order = $_GET['order'] ? $_GET['order'] : 'recent_activity';

if($order == 'recent_activity'){
	$orderby = 'latest_change';
	$orderdir = 'asc';

}elseif($order == 'first_created'){
	$orderby = 'id';
	$orderdir = 'asc';

}else{
	$orderby = 'id';
	$orderdir = 'desc';
}

$threads = new Threads(false, $orderby, $orderdir);


include '../views/header.php';
include '../views/navigation.php';
include '../views/forum_content.php';
include '../views/footer.php';