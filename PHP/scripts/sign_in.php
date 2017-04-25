<?php
session_start();

include("../classes/User.class.php");
$user = new User($_POST['username']);
if ($user->validPassword($_POST['password'])) {
    $_SESSION['username'] = $user->getUsername();
    $_SESSION['logged_in'] = 1;

    header("location:../controller/home.php");
}
else {
    echo "<h1>Error</h1>";
    echo "<a href=\"../controller/home.php\">click here to try again</a>.</p>";
}

