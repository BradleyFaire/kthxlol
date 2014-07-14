<?php

require_once '../libraries/login.lib.php';

# log the user out
Login::log_out();

# and redirect them to the index
header('location: index.php');
exit;