<?php

    session_start();
    require_once("dbconnect.php");
    $connection = dbconnect();    
    $userID = $_SESSION["user"];

    // System-Wide Deletion Processing 
    
    if(isset($_POST["delete"])){
        $delete = $_POST["delete"];
    }

    //Processing for Account Deletion (The Delete Account Function)

    if($delete == "deleteUser"){
        $userID = mysqli_real_escape_string($connection, $_POST["userID"]);
        $sql = "DELETE FROM User WHERE userID = '$userID' ";
        $result = mysqli_query($connection, $sql);
        if($result){
            $_SESSION["response"] = "User Account Succesfully Deleted.";
            $_SESSION["resType"] = "success";
            unset($_SESSION["login"]);
            unset($_SESSION["firstname"]);
            unset($_SESSION["accessRole"]);
            header("location:index1.php?page=home");
            exit();
        }
        else{
            $_SESSION["response"] = "Error Deleting Your Account: '".mysqli_error($connection)."' ";
            $_SESSION["resType"] = "danger";
            header("location:index1.php?page=myaccount");
        }
    }