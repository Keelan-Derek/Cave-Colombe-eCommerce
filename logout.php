<?php
    // Code for logging out the user. Serves as an extension of the login function. 

    session_start();
    unset($_SESSION["login"]);
    unset($_SESSION["firstname"]);
    unset($_SESSION["accessRole"]);
    header("location:index1.php?page=home");
    exit();

?>