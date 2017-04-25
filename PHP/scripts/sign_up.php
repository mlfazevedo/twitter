<?php

session_start();
include("../classes/User.class.php");

$user = new User($_POST['username']);
$result = $user->createUser($_POST['first_name'], $_POST['last_name'], $_POST['email'], $_POST['password']);

if ($result === "invalid_email") {
    echo "<p>Invalid email address. Please <a href=\"../controller/home.php\">click here to try again</a> </p>";
}
elseif ($result === "email_already_exists") {
    $email = $_POST['email'];
    echo "<p>$email already exists. Please <a href=\"../controller/home.php\">click here to try again</a>.</p>";
}
elseif ($result === "username_already_exists") {
    echo "<p>$user->getUsername() already exists. Please <a href=\"../controller/home.php\">click here to try again</a>.</p>";
}
else {
    $_SESSION['username'] = $user->getUsername();
    $_SESSION['logged_in'] = true;
    header("location:../controller/home.php");
}