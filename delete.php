<?php

use app\Database;

require_once 'config/config.php';
require_once 'vendor/autoload.php';

loginCheck();
// dd($_GET['id']);
$db = new Database();
$db->delete($_GET['id'],'users');

?>