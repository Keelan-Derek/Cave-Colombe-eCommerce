<?php
    /* Code that establishes a connection between the front-end interface and the back-end database to enable various CRUDE operations*/

    function dbconnect(){
        static $connection;

        if(!isset($connection)){
            $config_file = "config.ini";
            $config = parse_ini_file($config_file);
            
            $host = $config['host'];
            $dbuser = $config['user'];
            $dbpass = $config['pass'];
            $database = $config['dbname'];
            $connection = mysqli_connect($host, $dbuser, $dbpass, $database);
        }
        
        if(!$connection){
            echo "Database Connection Error: " . mysqli_connect_error();
        } else{
            return $connection;
        }
    }
    