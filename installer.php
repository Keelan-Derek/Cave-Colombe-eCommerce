<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name=”viewport” content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="images/CC ICON.png">
        <title>Setup Page | Cave Colombe</title>
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"> 
        <link href="fontawesome-free-6.0.0-web/css/all.css" rel="stylesheet" type="text/css"/>
        <script src="js/jquery-3.4.1.js"></script>
        <script src="js/bootstrap.bundle.js"></script>
        <link rel="stylesheet" href="css/styling.css"/>
    </head>  
    <body>

    <!-- Interface for Configuring the System and Its Database By Importing the SQL file into a Database in the Web Server -->
    
        <div class="container-fluid">
            <div class="row align-items-center">

                <div class="col-lg-2 d-flex justify-content-center mb-4">
                    <img class="ms-4" id="main-logo" src="images/Cave Colombe LOGO.jpeg" alt="Cave Colombe Main Logo"/>
                </div>

                <div class="col-lg-8">

                    <h1 class="display-2 text-center"><u>Welcome to the Setup Page</u></h1>

                    <p class="mt-4 text-center fs-5"> Please fill in the following fields to configure the system's connection to its database.</p>

                    <p class="fs-6"> First, please create an empty database in <span class="fst-italic">phpMyAdmin</span>. The created database should be named CaveColombe, and this should be name inserted down below. <br>
                    Then enter the details of your <span class="fst-italic">phpMyAdmin</span> to configure the site's database and import the tables.</p>

                    <form id="setup" method="POST" action="database-setup.php">
                        <div class="form-group">
                            <label for="localhost" class="fs-5 fw-bold">Database localhost:</label>
                            <input class="form-control form-control-lg" type="text" name="localhost" placeholder="Name of the server host"/> <br>
                        </div>
                        
                        <div class="form-group">
                            <label for="dbuser" class="fs-5 fw-bold">Username:</label>
                            <input class="form-control form-control-lg" type="text" name="dbuser" placeholder="Username for the user account being used"/><br>
                        </div>
                        
                        <div class="form-group">
                            <label for="dbpass" class="fs-5 fw-bold">Password:</label>
                            <input class="form-control form-control-lg" type="password" name="dbpass" placeholder="If there is no password, leave this field blank."/><br>
                        </div>
                        
                        <div class="form-group">
                            <label for="database" class="fs-5 fw-bold">Database name:</label>
                            <input class="form-control form-control-lg" type="text" name="database" placeholder="Name given to the empty database created in phpMyAdmin."/><br>
                        </div>

                        <div class="text-center">
                            <input class="btn py-3 px-5 rounded-pill fw-bold btn-reg" type="submit" value="Configure">
                        </div>
                    </form> 

                    <p class="text-muted fw-bold my-5">Values set in "includes/config.ini" need to be cleared (e.g."host = " where host = localhost) after a session with the website. 
                     And "includes/check.txt" needs to be set back to "No" where the value is equal to "Yes". This will allow the system to be reinitialized for the next use.</p>
                </div>

                <div class="col-lg-2"></div>

            </div> 
         </div> 
    </body>      
</html> 