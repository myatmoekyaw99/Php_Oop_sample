<?php

use app\UserSession;

require_once 'config/config.php';
require_once 'vendor/autoload.php';

UserSession::destroySession();

echo "<script>alert('Successfully logout your Account!'); window.location = 'index.php';</script>"

?>