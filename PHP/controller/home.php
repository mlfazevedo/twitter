<?php 

include("../views/header.php");

// user logged in
if(!empty($_SESSION['logged_in']) && !empty($_SESSION['username'])) {
    include("home_user_controller.php");
}
// Visitor
else {
    include("../views/home_visitor_view.php");
}

include("../views/footer.php");