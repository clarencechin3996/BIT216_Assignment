<?php
require_once 'db.php';
session_start();
session_destroy();
header("refresh:1; url=login.html");
?>
