<?php
/* A page that houses the links to the various pages that the user would need to navigate to */

session_start();

@$page = $_GET["page"];

include("includes/header.php");

switch(@$page){
    case "":
        include("home.php");
        break;
    case "home":
        include("home.php");
        break;
    case "login":
        include("login.php");
        break;
    case "register":
        include("register.php");
        break;
    case "myaccount":
        include("myaccount.php");
        break;
    }

include("includes/footer.php");