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

$creator = new Users($thread->user_id);

$comment_count = $comments->count_comments();
$totalpages = ceil($comment_count/$comments->per_page);

include '../views/header.php';
include '../views/navigation.php';
include '../views/thread_content.php';
include '../views/footer.php';