<?php

include("../classes/User.class.php");
$user = new User($_SESSION['username']);
$tweets = $user->getTweetsFollowing();

include("../views/home_user_view.php");
