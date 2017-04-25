<?php

if (isset($_POST) && !empty($_POST['tweet_msg'])) {
    session_start();
    include("../classes/User.class.php");
    $user = new User($_SESSION['username']);
    $tweet = $user->sendTweet($_POST['tweet_msg']);
    ?>

    <!-- New tweet -->
    <div class="panel panel-primary">
        <div class="panel-heading"><?= $tweet->getUsername() ?> - <?=$tweet->getDate() ?></div>
        <div class="panel-body"><?= $tweet->getTweet() ?></div>
    </div>
    <?php
}
?>
