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
require_once '../models/user.models.php';

if($_GET['page']){
	$comments = new Comments($_GET['id'], $_GET['page']);
}else{
	$comments = new Comments($_GET['id'], 1);
}

$thread = new Model('tb_threads');
$thread->load($_GET['id']);

$creator = new Model('tb_users');
$creator->load($thread->user_id);

$comment_count = $comments->count_comments($_GET['id']);
$totalpages = ceil($comment_count/$comments->per_page);


$number = $_GET['page'] ? $_GET['page'] : 1;
$back = $number-1;
$next = $number+1;
$left = $number-3;
$right = $number+2;
$lastmarker = $totalpages - 3;

include '../views/header.php';
include '../views/navigation.php';
include '../views/thread_content.php';
include '../views/footer.php';