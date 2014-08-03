<?php

require_once '../libraries/login.lib.php';

# log the user out
Login::log_out();

$_SESSION['user_id']     = '';
$_SESSION['username']    = '';
$_SESSION['email']       = '';
$_SESSION['hide_email']  = '';
$_SESSION['image']       = '';
$_SESSION['description'] = '';
$_SESSION['signature']   = '';
$_SESSION['location']    = '';
$_SESSION['date_joined'] = '';

# and redirect them to the index
header('location: index.php');
exit;