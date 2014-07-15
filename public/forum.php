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

$threads = new Threads();

include '../views/header.php';
include '../views/navigation.php';
include '../views/forum_content.php';
include '../views/footer.php';