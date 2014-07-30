<?php

require_once '../libraries/config.lib.php';
require_once '../libraries/database.lib.php';
require_once '../libraries/form.lib.php';
require_once '../libraries/hash.lib.php';
require_once '../libraries/login.lib.php';
require_once '../libraries/model.lib.php';
require_once '../models/comment.collection.php';
require_once '../models/user.models.php';
require_once '../models/thread.collection.php';
require_once '../models/page.collection.php';

$user = new Model('tb_users');
$user->load($_GET['id']);

include '../views/header.php';
include '../views/navigation.php';
include '../views/user_content.php';
include '../views/footer.php';