<?php 

include("../views/header.php");

// user logged in
if(!empty($_SESSION['logged_in']) && !empty($_SESSION['username']) && isset($_GET['searched_user']) && !empty($_GET['searched_user'])) {
        include("../classes/User.class.php");
        $user = new User($_SESSION['username']);
        $searched_user = new User($_GET['searched_user']);
        $tweets = $searched_user->getTweets();
        $stats = $searched_user->getStats();

        include("../views/search_user_view.php");
}
// Visitor
else {
    header("location:../controller/home.php");
}

include("../views/footer.php");