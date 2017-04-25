<?php

session_start();
include("../classes/User.class.php");
$user = new User($_SESSION['username']);
$user->follow($_POST['username']);
