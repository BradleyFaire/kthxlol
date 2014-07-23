<?php

require_once '../libraries/config.lib.php';
require_once '../libraries/database.lib.php';
require_once '../libraries/form.lib.php';
require_once '../libraries/hash.lib.php';
require_once '../libraries/login.lib.php';
require_once '../libraries/model.lib.php';
require_once '../models/comment.collection.php';
require_once '../models/thread.collection.php';
require_once '../models/page.collection.php';

include '../views/header.php';
include '../views/navigation.php';
if($_GET['id'] == 1){
	include '../views/success_message.php';
}elseif($_GET['id'] == 2){
	include '../views/fail_message.php';
}elseif($_GET['id'] == 3){
	include '../views/cancel_success.php';
}elseif($_GET['id'] == 4){
	include '../views/change_success.php';
}
include '../views/footer.php';