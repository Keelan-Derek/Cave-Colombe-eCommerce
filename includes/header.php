<?php
    // Code that enables and controls switching between the system's various web pages

    session_start();

    require_once("dbconnect.php");
    $connection = dbconnect(); 

    // Code for Counting the number of items in the cart
    $cart = $_SESSION["cart"];
    $cartItems = count($cart);

    $UserID = $_SESSION["user"];
    $qry = "SELECT * FROM CustomerFavorites WHERE userID = '$UserID' ";
    $favs = mysqli_query($connection, $qry);
    $_SESSION["numOfFavs"] = mysqli_num_rows($favs);
    $numOfFavs = $_SESSION["numOfFavs"];


    $qry2 = "SELECT * FROM Orders WHERE orderStatus != 'Cancelled' || 'Delivered'";
    $return = mysqli_query($connection, $qry2);
    $custOrders = mysqli_num_rows($return);
 
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="images/CC ICON.png">
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"> 
        <link href="fontawesome-free-6.0.0-web/css/all.css" rel="stylesheet" type="text/css"/>
        <link  rel="stylesheet" type="text/css" href="css/styling.css"/>
        <script src="jquery/jquery-3.4.1.js"></script>
        <script src="js/bootstrap.bundle.js"></script>
    </head>
    <body>

    <div id="navigation" class="d-print-none">

        <!-- Header's Top Nav-->

        <ul class="nav justify-content-end gap-4 py-2" id="top-nav">
            
            <li class="nav-item me-auto mt-2">
                <a href="javascript:history.back(1)" class="btn btn-outline-light rounded-circle me-5 ms-5" role="button" data-bs-toggle="tooltip" data-bs-placement="right" title="Go Back to Previous Page"><i class="fa-solid fa-arrow-left"></i></a>
                <a href="javascript:history.forward(1)" class="btn btn-outline-light rounded-circle me-5 ms-2" role="button" data-bs-toggle="tooltip" data-bs-placement="right" title="Go Forward a Page"><i class="fa-solid fa-arrow-right"></i></a>
            </li>

            <?php if($_SESSION["login"] == true){ ?>

            <li class="nav-item me-5">
                <a href="" class="nav-link btn fs-5 fw-bold act-btn" role="button" data-bs-toggle="modal" data-bs-target="#add-wine"><i class="fa-solid fa-plus"></i>&nbsp;&nbsp; Add Wine</a>
            </li>

            <?php } ?>

            <?php if($_SESSION["login"] == true){ ?>

            <li class="nav-item me-5 position-relative">
                <a href="index1.php?page=customerorders" class="nav-link btn fs-5 fw-bold act-btn" role="button"><i class="fa-solid fa-wine-bottle"></i>&nbsp;&nbsp; Customer Orders</a>

                <?php if($_SESSION["login"] == true && $custOrders > 0){ ?>
                    <span class="position-absolute top-100 start-0 fs-6 translate-middle badge rounded-pill text-dark bg-badge">
                        <?php echo $custOrders; ?>
                    </span>
                <?php } ?>

            </li>

            <?php } ?>

            <?php if($_SESSION["login"] == true){ ?>

            <li class="nav-item me-5">
                <a href="index1.php?page=dashboard" class="nav-link btn fs-5 fw-bold act-btn" role="button"><i class="fa-solid fa-chart-column"></i>&nbsp;&nbsp; Access Dashboard</a>
            </li>

            <?php } ?>

            <?php if($_SESSION["login"] == false ){ ?>

            <li class="nav-item">
                <a href="index1.php?page=login" class="nav-link btn fs-5 fw-bold act-btn" role="button"><i class="fa-solid fa-right-to-bracket"></i>&nbsp;&nbsp; Log In</a>
            </li>

            <li class="nav-item me-5">
                <a href="index1.php?page=register" class="nav-link btn fs-5 fw-bold act-btn" role="button"><i class="fa-solid fa-user-plus"></i>&nbsp;&nbsp; Register</a>
            </li>

            <?php } ?>

        </ul>

        <!-- Add Wine Modal -->

        <div class="modal fade" id="add-wine" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                <div class="modal-content">

                    <div class="modal-header">
                        <h3 class="modal-title fw-bold fst-italic ms-2">Add Wine</h3>
                        <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close"><i class="fa-solid fa-xmark fa-2x"></i></button>
                    </div>

                    <?php if($_SESSION["accessRole"] == "Administrative Staff"){ ?>

                    <div class="modal-body mx-3 px-3 py-4 row gap-3">

                        <form action="wine-processing.php" method="POST" enctype="multipart/form-data">

                            <div class="col-lg-12 col-sm-12">
                                <label for="wineName" class="fs-5 fw-bold form-label">*Wine Name</label>
                                <input class="form-control form-control-lg fst-italic" type="text" name="wineName" id="wineName" required/>
                            </div>

                            <div class="col-lg-12 col-sm-12 mt-3">
                                <label for="wineIMG" class="fs-5 fw-bold form-label">*Wine Image</label>
                                <input class="form-control form-control-lg" type="file" name="wineIMG" id="wineIMG" required/>
                            </div>

                            <div class="col-lg-12 col-sm-12 mt-3">
                                <label for="wineDesc" class=" fs-5 fw-bold form-label">Wine Description</label>
                                <textarea class="form-control form-control-lg" name="wineDesc" id="wineDesc" rows="3"></textarea>
                            </div>

                            <div class="col-lg-12 col-sm-12 mt-3">
                                <label for="wineCat" class="fs-5 fw-bold form-label">*Wine Category</label>
                                <select class="form-select form-select-lg" name="wineCat" id="wineCat" required>
                                    <option selected value="">Wine Type is...</option>
                                    <option value="Red">Red</option>
                                    <option value="White">White</option>
                                    <option value="Rosé">Rosé</option>
                                    <option value="Sparkling">Sparkling</option>
                                </select>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-sm-12 mt-3">
                                    <label for="wineProd" class=" fs-5 fw-bold form-label">Wine Producer</label>
                                    <input class="form-control form-control-lg" type="text" name="wineProd" id="wineProd" placeholder="e.g. Force Majeure Winery"/>
                                </div>

                                <div class="col-lg-6 col-sm-12 mt-3">
                                    <label for="wineYear" class=" fs-5 fw-bold form-label">*Wine Year</label>
                                    <input class="form-control form-control-lg" type="number" min="1700" max="2999" name="wineYear" id="wineYear" placeholder="e.g. 2018" required/>
                                </div>
                            </div>

                            <div class="col-lg-12 col-sm-12 mt-3">
                                <label for="wineOrg" class="fs-5 fw-bold form-label">Place of Origin</label>
                                <input class="form-control form-control-lg" type="text" name="wineOrg" id="wineOrg" placeholder="e.g. Champagne, France"/>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-sm-12 mt-3">
                                    <label for="botCap" class="fs-5 fw-bold form-label">*Bottle Capacity</label>
                                    <input class="form-control form-control-lg" type="text" name="botCap" id="botCap" placeholder="e.g. 75cl / 750ml" required/>
                                </div>

                                <div class="col-lg-6 col-sm-12 mt-3">
                                    <label for="ABV" class="fs-5 fw-bold form-label">*Alcohol By Volume</label>
                                    <input class="form-control form-control-lg" type="text" name="ABV" id="ABV" placeholder="e.g. 13%" required/>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-sm-12 mt-3">
                                    <label for="botPrice" class=" fs-5 fw-bold form-label">*Price per Bottle</label>
                                    <input class="form-control form-control-lg" type="number" min="0" max="1000000000" name="botPrice" id="botPrice" placeholder="e.g. 5000" required/>
                                </div>

                                <div class="col-lg-6 col-sm-12 mt-3">
                                    <label for="casePrice" class=" fs-5 fw-bold form-label">*Price per Case</label>
                                    <input class="form-control form-control-lg" type="number" min="0" max="1000000000" name="casePrice" id="casePrice" placeholder="e.g. 28000" required/>
                                </div>
                            </div>
            
                    </div>

                    <div class="modal-footer gap-2">
                        <input type="hidden" name="form" value="addWine">
                        <button type="submit" class="btn btn-outline-success fw-bold px-3 py-2">Add Wine</button>
                        <button type="reset" class="btn btn-outline-secondary fw-bold rounded-circle"><i class="fas fa-redo-alt"></i></button>
                        <button type="button" class="btn btn-outline-secondary fw-bold px-3 py-2" data-bs-dismiss="modal">Cancel</button>
                        </form>
                    </div>

                    <?php 
                    
                        }
                        else{
                            echo "<br><br><br><br> <div class='alert alert-danger p-5 fs-4 fw-bold' role='alert'><i class='fa-solid fa-triangle-exclamation'></i>&nbsp;&nbsp; You must be a member of Administrative Staff to access the add wine function !</div>
                            <br><br><br><br>";
                        }

                    ?>

                </div>
            </div>
        </div>

        <!-- Header's Middle Nav -->

        <div class="container-fluid py-4">

            <div class="row align-items-center">

                <div class="col-lg-2 col-sm-6">
                    <a href="index1.php?page=home"><img class="ms-4" id="main-logo" src="images/Cave Colombe LOGO.jpeg" alt="Cave Colombe Main Logo"/></a>
                </div>

                <div class="col-lg-7 col-sm-6">
                    <form action="search.php" method="POST" class="d-flex" id="search">
                        <input class="form-control py-3 px-4 me-2 fs-5" type="search" name="searchWine" id="searchWine" placeholder="Search" aria-label="Search">
                        <button class="btn act-btn" type="submit" name="search"><i class="fas fa-search fa-2x"></i></button>
                    </form>
                </div>

                <div class="col-lg-3 col-sm-12">
                    <ul class="nav justify-content-center gap-5 mt-2">
                        <li class="nav-item position-relative">
                            <a href="index1.php?page=favorites" class="navbtn" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-html="true" title="<em>Your Favorites</em>" role="button">
                                <i class="fas fa-heart fa-3x"></i>
                            </a>

                            <!-- Code for Counting the Number of Favorited Wines -->
                            
    
                            <?php if($_SESSION["login"] == true && $numOfFavs > 0){ ?>
                            <span class="position-absolute top-0 start-100 fs-6 translate-middle badge rounded-circle text-dark bg-badge">
                                <?php echo $numOfFavs; ?>
                            </span>
                            <?php } ?>
                        </li>

                        <li class="nav-item position-relative">
                            <a href="index1.php?page=cart" class="navbtn " data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-html="true" title="<em>Your Cart</em>" role="button" id="userDropdown">
                                <i class="fas fa-shopping-cart fa-3x"></i>
                            </a>

                            <!-- Code for Counting the Number of Items in Cart -->

                            <?php if(isset($cart)){ ?>
                            <span class="position-absolute top-0 start-100 fs-6 translate-middle badge rounded-circle text-dark bg-badge">
                                <?php echo $cartItems; ?>
                            </span>
                            <?php } ?>
                           
                        </li>

                        <li class="nav-item dropdown" aria-labelledby="userDropdown">
                            <a href="#" class="navbtn" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user-circle fa-3x"></i></a>

                            <ul class="dropdown-menu">
                                
                                <?php if($_SESSION["login"] == false ){ ?>

                                <li>
                                    <a href="index1.php?page=login" class="dropdown-item fs-5 fw-bold drop-btn"><i class="fa-solid fa-right-to-bracket"></i>&nbsp;&nbsp; Log In</a>
                                </li>

                                <div class="dropdown-divider"></div>

                                <li>
                                    <a href="index1.php?page=register" class="dropdown-item fs-5 fw-bold drop-btn"><i class="fa-solid fa-user-plus"></i>&nbsp;&nbsp; Register</a>
                                </li>

                                <?php } elseif ($_SESSION["login"] == true){ ?>

                                <li>
                                    <a href="index1.php?page=myaccount" class="dropdown-item fs-5 fw-bold drop-btn"><i class="fas fa-user"></i>&nbsp;&nbsp; My Account</a>
                                </li>

                                <div class="dropdown-divider"></div>

                                <li>
                                    <a href="" class="dropdown-item fs-5 fw-bold drop-btn" data-bs-toggle="modal" data-bs-target="#log-out"><i class="fas fa-sign-out-alt"></i>&nbsp;&nbsp; Log Out</a>
                                </li>

                                <?php } ?>

                            </ul>
                        </li>
                    </ul>
                </div>
            </div>

            <?php if($_SESSION["login"] == true){ ?>

            <div class="row align-items-center mt-2">    
                <div class="fs-5 fw-bold fst-italic text-center" id="user-msg"> 
                    <i class="fa-solid fa-handshake"></i>&nbsp;&nbsp;&nbsp;
                    Enjoy Your Session, <?php echo $_SESSION["firstname"]; ?> ! 
                </div>
            </div>

            <?php } ?>
        </div>

        <!-- Log Out Modal -->

        <div class="modal fade" id="log-out" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">

                    <div class="modal-header">
                        <h3 class="modal-title">Log Out</h3>
                        <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close"><i class="fa-solid fa-xmark fa-2x"></i></button>
                    </div>

                    <div class="modal-body text-center mt-1">
                        <i class="fa-solid fa-circle-exclamation fa-4x"></i>
                        <p class="mt-3 fs-4">Are you sure that you want to log out?</p>
                        <p class="text-muted fst-italic">Note that your cart will be emptied.</p>
                    </div>

                    <div class="modal-footer gap-3">
                        <a href="logout.php" class="btn btn-Out py-2 fs-5 rounded-pill" role="button">Log Out</a>
                        <button type="button" class="btn btn-secondary py-2 fs-5 rounded-pill" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Header's Bottom Navbar -->
        
        <nav class="navbar navbar-expand-lg navbar-light bg-light stroke" id="bottom-nav">
            <div class="container-fluid">

                <button class="navbar-toggler my-3" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon fw-bold"></span>
                </button>

                <div class="colapse navbar-collapse justify-content-center" id="mainNav">

                    <ul class="navbar-nav gap-5">


                        <li class="nav-item">
                            <a href="index1.php?page=home" class="nav-link fw-bold fs-4 p-2 navbar-link"><i class="fa-solid fa-house-chimney"></i>&nbsp;&nbsp; Home</a>
                        </li>

                        <li class="nav-item">
                            <a href="index1.php?page=allwines" class="nav-link fw-bold fs-4 p-2 navbar-link"> All Wines</a>
                        </li>

                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle fw-bold fs-4 p-2 navbar-link" id="wineCat" role="button" data-bs-toggle="dropdown" aria-expanded="false"> Wine Categories</a>
                        
                            <div class="dropdown-menu" aria-labelledby="wineCat">
                                <a href="index1.php?page=bestsellers" class="dropdown-item fw-bold fs-5 drop-btn">Best-Selling Wines</a>

                                <div class="dropdown-divider"></div>

                                <a href="index1.php?page=newarrivals" class="dropdown-item fw-bold fs-5 drop-btn">New Arrivals</a>

                                <div class="dropdown-divider"></div>

                                <a href="index1.php?page=redwines" class="dropdown-item fw-bold fs-5 drop-btn">Red Wines</a>

                                <div class="dropdown-divider"></div>

                                <a href="index1.php?page=whitewines" class="dropdown-item fw-bold fs-5 drop-btn">White Wines</a>

                                <div class="dropdown-divider"></div>

                                <a href="index1.php?page=rosewines" class="dropdown-item fw-bold fs-5 drop-btn">Rosé Wines</a>

                                <div class="dropdown-divider"></div>

                                <a href="index1.php?page=sparklingwines" class="dropdown-item fw-bold fs-5 drop-btn">Sparkling Wines</a>
                            </div>
                        </li> 

                        <li class="nav-item">
                            <a href="index1.php?page=about-us" class="nav-link fw-bold fs-4 p-2 navbar-link"> About Us</a>
                        </li>

                        <li class="nav-item">
                            <a href="index1.php?page=contact-us" class="nav-link fw-bold fs-4 p-2 navbar-link"> Contact Us</a>
                        </li>

                        <li class="nav-item">
                            <a href="index1.php?page=faq" class="nav-link fw-bold fs-4 p-2 navbar-link"> FAQ</a>
                        </li>
                        
                    </ul>
                </div>
            </div>
        </nav>
    </div>


    <script>
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    </script>  