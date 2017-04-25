<?php

session_start();
include("../classes/User.class.php");

$searched_user = new User($_POST['username']);
$user = new User($_SESSION['username']);

if ($user->isFollowing($searched_user->getUsername())) {
    echo "unfollow";
}
else if ($user->getUsername() === $searched_user->getUsername()) {
    echo "yourself";
}
else {
    echo "follow";
}
