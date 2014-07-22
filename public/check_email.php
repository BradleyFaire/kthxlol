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
}else{
	include '../views/fail_message.php';
}
include '../views/footer.php';