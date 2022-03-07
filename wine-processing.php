<?php

    session_start();
    require ("dbconnect.php");
    $connection = dbconnect();
    $form = $_POST["form"];

    // Code required for the Add Wine function 

    if($form == "addWine"){
        $name         = mysqli_real_escape_string($connection, $_POST["wineName"]);
        $image        = mysqli_real_escape_string($connection, $_POST["wineIMG"]);
        $description  = mysqli_real_escape_string($connection, $_POST["wineDesc"]);
        $category     = mysqli_real_escape_string($connection, $_POST["wineCat"]);
        $producer     = mysqli_real_escape_string($connection, $_POST["wineProd"]);
        $year         = mysqli_real_escape_string($connection, $_POST["wineYear"]);
        $origin       = mysqli_real_escape_string($connection, $_POST["wineOrg"]);
        $capacity     = mysqli_real_escape_string($connection, $_POST["botCap"]);
        $abv          = mysqli_real_escape_string($connection, $_POST["ABV"]);
        $bottlePrice  = mysqli_real_escape_string($connection, $_POST["botPrice"]);
        $casePrice    = mysqli_real_escape_string($connection, $_POST["casePrice"]);
        
        $sql = "INSERT INTO Wine (wineName, wineIMG, wineDesc, wineCategory, wineProducer, wineYear, placeOfOrigin, bottleCapacity, ABV, pricePerBottle, pricePerCase) 
                VALUES ('$name', '$image', '$description', '$category', '$producer', '$year', '$origin', '$capacity', '$abv', '$bottlePrice', '$casePrice')";

        $addWine = mysqli_query($connection, $sql);

        // The subsequent section will need to be changed once the wine cards and individual product pages for the wines are working 

        if($addWine){
            $_SESSION["response"] = "Wine Successfully Added to the Shop";
            $_SESSION["resType"] = "success";
            header("location:index1.php?page=home");
            exit();
        }
        else{
            $_SESSION["response"] = "Error Adding Wine to Shop: '".mysqli_error($connection)."' ";
            $_SESSION["resType"] = "danger";
            header("location:index1.php?page=home");
            exit();
        }
    }