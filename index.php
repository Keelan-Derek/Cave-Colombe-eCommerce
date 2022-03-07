<?php

/* Code for checking whether the user has setup the database using the form provided in 'installer.php' and whether he has then logged in to the system */

    session_start();

    $userID = $_SESSION["user"];

    $file = "check.txt";
    $text = file_get_contents($file);
    $values = preg_split('/[\n,]+/', $text);

    foreach($values as $value){
        //echo $value;
    }

    if($value == "No" || $value == " "){
        header("location:installer.php");
    }
    else{
        if($_SESSION["login"] == true){
            header("location:index1.php?page=home");
            exit();
        }
        else{
            header("location:index1.php?page=login");
            exit();
        }
    }