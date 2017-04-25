<?php
session_start();
$_SESSION = array();
session_destroy();

setcookie('username', '');

header("location:../controller/home.php");

