<?php

    /* Code for Importing the SQL File into a Database in the Web Server based on the inputs made into the form on 'installer.php', and setting the values for the 'incldues/config.ini' file */

    session_start();

    $host = $_POST["localhost"];
    $dbuser = $_POST["dbuser"];
    $dbpass = $_POST["dbpass"];
    $database = $_POST["database"];

    $_SESSION["localhost"] = $host;
    $_SESSION["dbuser"] = $dbuser;
    $_SESSION["dbpass"] = $dbpass;
    $_SESSION["database"] = $database;

    $connection = mysqli_connect($host, $dbuser, $dbpass, $database);

    if(!$connection){
        echo "Failed to connect: " . mysqli_connect_error();
        return mysqli_connect_error();
    }

    $file1 = "config.ini";
    $current1 = array("host" => $host, "user" => $dbuser, "pass" => $dbpass, "dbname" => $database);

        file_put_contents($file1, "host = " . $current1["host"]. "\r\n");
        file_put_contents($file1, "user = " . $current1["user"]. "\r\n", FILE_APPEND);
        file_put_contents($file1,"pass = " . $current1["pass"]. "\r\n", FILE_APPEND);
        file_put_contents($file1, "dbname = " . $current1["dbname"]. "\r\n", FILE_APPEND);

    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    $sql = '';
    $count = 0;
    $sqlines = file("CaveColombe.sql");
    
    foreach ($sqlines as $sqline){
        $start_character = substr(trim($sqline), 0, 2);
        if($start_character != '--' || $start_character != '/*' || $start_character != '//' || $sqline != ''){
            $sql = $sql . $sqline;
            $end_character = substr(trim($sqline), -1, 1);
            if($end_character == ';'){
                if(!mysqli_query($connection, $sql)){
                    $count++;
                }
                $sql = '';
            }
        }
    }
    
    if($count > 0){
        echo "There is an error in the database configuration.";
    } 
    else{
        echo "Database Tables Successfully Imported !";
    }

    $file = "check.txt";
    $current = "Yes";

    if(file_put_contents($file, $current)){
        header('location:index1.php?page=home');
        exit();
    }
