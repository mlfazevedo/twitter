<!DOCTYPE html>
<?php
session_start();
?>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title> PW_Twitter </title>
    <link href="../../CSS/bootstrap.css" rel="stylesheet">

    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link href="../../CSS/style.css" rel="stylesheet" type="text/css"/>
    <link href="../../CSS/signin.css" rel="stylesheet" type="text/css"/>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
</head>

<body>
<div class="container">
    <nav class="navbar navbar-light bg-faded">
        <button class="navbar-toggler hidden-sm-up" type="button" data-toggle="collapse" data-target="#navbar-header" aria-controls="navbar-header">
            &#9776;
        </button>
        <div class="collapse navbar-toggleable-xs" id="navbar-header">
            <a class="navbar-brand" href="../controller/home.php">Home</a>

            <?php
            if(!empty($_SESSION['logged_in']) && !empty($_SESSION['username'])) {
            ?>
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a class="nav-link pull-xs-right" href="../scripts/sign_out.php">Sign out</a>
                </li>
                <li>
                    <form class="form-inline pull-xs-right" method="GET" action="../controller/search_user_controller.php">
                        <input id="searched_user" name="searched_user" class="form-control" type="text" placeholder="Search user">
                        <button id="search" class="btn btn-success-outline" type="submit">Search</button>
                    </form>
                </li>
            </ul>
            <?php
            }
            ?>
        </div>
    </nav>






