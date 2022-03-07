<?php
   
    session_start();
    require ("dbconnect.php");
    $connection = dbconnect();
    $form = $_POST["form"];

    // Code required for the Register and Login Functions 

    if($form == "Register"){
        $firstname = mysqli_real_escape_string($connection, $_POST["firstname"]);
        $lastname  = mysqli_real_escape_string($connection, $_POST["lastname"]);
        $email     = mysqli_real_escape_string($connection, $_POST["email"]);
        $phone     = mysqli_real_escape_string($connection, $_POST["phone"]);
        $dob       = mysqli_real_escape_string($connection, (date('Y-m-d', strtotime($_POST["dob"]))));
        $gender    = mysqli_real_escape_string($connection, $_POST["gender"]);
        $access    = mysqli_real_escape_string($connection, $_POST["accessRole"]);
        $user      = mysqli_real_escape_string($connection, $_POST["username"]);
        $passw     = mysqli_real_escape_string($connection, $_POST["password"]);
        $hashpass  = password_hash($passw, PASSWORD_BCRYPT);

        $sql = "SELECT email, phone, username, passw FROM User";
        $result = mysqli_query($connection, $sql);
        $numRows = mysqli_num_rows($result);
        $match = 0;

        for($i = 0; $i < $numRows; $i++){
            $row = mysqli_fetch_array($result);

            if($row["email"] == $email){
                $match++;
                $_SESSION["response"] = "This email address is currently in use! Please choose a different one.";
                $_SESSION["resType"] = "warning";
                header("location:index1.php?page=register");
                exit();
            }

            if($row["phone"] == $phone){
                $match++;
                $_SESSION["response"] = "This phone number is currently in use! Please choose a different one.";
                $_SESSION["resType"] = "warning";
                header("location:index1.php?page=register");
                exit();
            }

            if($row["username"] == $user){
                $match++;
                $_SESSION["response"] = "This username is currently in use! Please choose a different one, or <a href='index1.php?page=login'>log in</a> to your existing user account.";
                $_SESSION["resType"] = "warning";
                header("location:index1.php?page=register");
                exit();
            }

            $duplicatePass = password_verify($passw, $row["passw"]);
            if($duplicatePass){
                $match++;
                $_SESSION["response"] = "This password is currently in use! Please choose a more secure one.";
                $_SESSION["resType"] = "warning";
                header("location:index1.php?page=register");
                exit();
            }
        }

        if($match == 0){
            $sql2 = "INSERT INTO User (firstName, lastName, email, phone, DOB, gender, accessRole, username, passw)
                     VALUES ('$firstname', '$lastname', '$email', '$phone', '$dob', '$gender', '$access', '$user', '$hashpass')";
            $register = mysqli_query($connection, $sql2);
            if($register){
                $lastID = mysqli_insert_id($connection);
                $_SESSION["user"] = $lastID;
                $sql3 = "SELECT * FROM User WHERE userID = '".$lastID."' ";
                $result = mysqli_query($connection, $sql3);
                $userRec = mysqli_fetch_array($result);
                $_SESSION["login"] = true;
                $_SESSION["firstname"] = $userRec["firstName"];
                $_SESSION["accessRole"] = $userRec["accessRole"];
                $_SESSION["response"] = "Your registration has been successful! You have been automatically logged in.";
                $_SESSION["resType"] = "success";
                header("location:index1.php?page=home");
                exit();
            }
            else{
                $_SESSION["response"] = "Registration Error = " . mysqli_error($connection) . ".";
                $_SESSION["resType"] = "danger";
                header("location:index1.php?page=register");
                exit();
            }
        }
    }
    elseif($form == "Login"){
        $user  = mysqli_real_escape_string($connection, $_POST["username"]);  
        $passw = mysqli_real_escape_string($connection, $_POST["password"]);

        $sql = "SELECT * FROM User WHERE username = '".$user."' ";
        $result = mysqli_query($connection, $sql);
        $row = mysqli_fetch_array($result);

        if($row && $user == $row["username"]){
            $validPass = password_verify($passw, $row["passw"]);

            if($validPass){
                $_SESSION["login"] = true;
                $_SESSION["user"] = $row["userID"];
                $_SESSION["firstname"] = $row["firstName"];
                $_SESSION["accessRole"] = $row["accessRole"];
                $_SESSION["response"] = "Login successful!";
                $_SESSION["resType"] = "success";
                header("location:index1.php?page=home");
                exit();
            }
            else{
                $_SESSION["login"] = false;
                $_SESSION["response"] = "Invalid Password!";
                $_SESSION["resType"] = "danger";

                $_SESSION["attempts"] += 1;
                if($_SESSION["attempts"] >= 3){
                    setcookie("lock", $user, time() +180);
                    $_SESSION["attempts"] = 0;
                }

                header("location:index1.php?page=login");
                exit();
            }
        }
        else{
            $_SESSION["login"] = false;
            $_SESSION["response"] = "Invalid Username!";
            $_SESSION["resType"] = "danger";

            $_SESSION["attempts"] += 1;
            if($_SESSION["attempts"] >= 3){
                setcookie("lock", $user, time() +180);
                $_SESSION["attempts"] = 0;
            }

            header("location:index1.php?page=login");
            exit();
        }

    }
?>