<?php
    session_start();
    require_once("dbconnect.php");
    $connection = dbconnect();    
    $userID = $_SESSION["user"];  

    //Query for selecting all the details associated with the user's account from the database to display on the page

    $sql = "SELECT * FROM User WHERE userID = '".$userID."' ";
    $result = mysqli_query($connection, $sql);
    $row = mysqli_fetch_array($result);

    //Processing for Any Updates the User Might Make to their Account (The Update Account Function)
    
    if(isset($_POST["form"])){
        $update = $_POST["form"];
    }

    if($update == "firstName"){
        if(isset($_POST["newFirstname"])){
            $firstname = mysqli_real_escape_string($connection, $_POST["newFirstname"]);
            $sql = "UPDATE User SET firstName = '$firstname' WHERE userID = '$userID' ";
            $result = mysqli_query($connection, $sql);
            if($result){
                $_SESSION["response"] = "First Name Successfully Updated. &nbsp;<a href='index1.php?page=myaccount'>Click here to see!</a>";
                $_SESSION["resType"] = "success";
                $_SESSION["firstname"] = $firstname;
                header("refresh:0");
            }
            else{
                $_SESSION["response"] = "Error Updating First Name: '".mysqli_error($connection)."' ";
                $_SESSION["resType"] = "danger";
                header("refresh:0");
            }
        }
    }
    elseif($update == "lastName"){ 
        if(isset($_POST["newLastname"])){
            $lastname = mysqli_real_escape_string($connection, $_POST["newLastname"]);
            $sql = "UPDATE User SET lastName = '$lastname' WHERE userID = '$userID' ";
            $result = mysqli_query($connection, $sql);
            if($result){
                $_SESSION["response"] = "Last Name Successfully Updated. &nbsp;<a href='index1.php?page=myaccount'>Click here to see!</a>";
                $_SESSION["resType"] = "success";
                header("refresh:0");
            }
            else{
                $_SESSION["response"] = "Error Updating Last Name: '".mysqli_error($connection)."' ";
                $_SESSION["resType"] = "danger";
                header("refresh:0");
            }
        }
    }
    elseif($update == "email"){ 
        if(isset($_POST["newEmail"])){
            $email = mysqli_real_escape_string($connection, $_POST["newEmail"]);
            $sql = "UPDATE User SET email = '$email' WHERE userID = '$userID' ";
            $result = mysqli_query($connection, $sql);
            if($result){
                $_SESSION["response"] = "Email Address Successfully Updated. &nbsp;<a href='index1.php?page=myaccount'>Click here to see!</a>";
                $_SESSION["resType"] = "success";
                header("refresh:0");
            }
            else{
                $_SESSION["response"] = "Error Updating Email Address: '".mysqli_error($connection)."' ";
                $_SESSION["resType"] = "danger";
                header("refresh:0");
            }
        }
    }
    elseif($update == "phone"){ 
        if(isset($_POST["newPhone"])){
            $phone = mysqli_real_escape_string($connection, $_POST["newPhone"]);
            $sql = "UPDATE User SET phone = '$phone' WHERE userID = '$userID' ";
            $result = mysqli_query($connection, $sql);
            if($result){
                $_SESSION["response"] = "Phone Number Successfully Updated. &nbsp;<a href='index1.php?page=myaccount'>Click here to see!</a>";
                $_SESSION["resType"] = "success";
                header("refresh:0");
            }
            else{
                $_SESSION["response"] = "Error Updating Phone Number: '".mysqli_error($connection)."' ";
                $_SESSION["resType"] = "danger";
                header("refresh:0");
            }
        }
    }
    elseif($update == "DOB"){ 
        if(isset($_POST["newDOB"])){
            $DOB = mysqli_real_escape_string($connection, (date('Y-m-d', strtotime($_POST["newDOB"]))));
            $sql = "UPDATE User SET DOB = '$DOB' WHERE userID = '$userID' ";
            $result = mysqli_query($connection, $sql);
            if($result){
                $_SESSION["response"] = "Date of Birth Successfully Updated. &nbsp;<a href='index1.php?page=myaccount'>Click here to see!</a>";
                $_SESSION["resType"] = "success";
                header("refresh:0");
            }
            else{
                $_SESSION["response"] = "Error Updating Last Name: '".mysqli_error($connection)."' ";
                $_SESSION["resType"] = "danger";
                header("refresh:0");
            }
        }
    }
    elseif($update == "user"){ 
        if(isset($_POST["newUser"])){
            $user = mysqli_real_escape_string($connection, $_POST["newUser"]);
            $sql = "UPDATE User SET username = '$user' WHERE userID = '$userID' ";
            $result = mysqli_query($connection, $sql);
            if($result){
                $_SESSION["response"] = "Username Successfully Updated. &nbsp;<a href='index1.php?page=myaccount'>Click here to see!</a>";
                $_SESSION["resType"] = "success";
                header("refresh:0");
            }
            else{
                $_SESSION["response"] = "Error Updating Username: '".mysqli_error($connection)."' ";
                $_SESSION["resType"] = "danger";
                header("refresh:0");
            }
        }
    }
    elseif($update == "pass"){ 
        if(isset($_POST["currentPass"]) && isset($_POST["newPass"])){
            $currpass = mysqli_real_escape_string($connection, $_POST["currentPass"]);
            $validpass = password_verify($currpass, $row['passw']);
            if($validpass){
                $passw = mysqli_real_escape_string($connection, $_POST["newPass"]);
                $hashpass = password_hash($passw, PASSWORD_BCRYPT);
                $sql = "UPDATE User SET passw = '$hashpass' WHERE userID = '$userID' ";
                $result = mysqli_query($connection, $sql);
                if($result){
                    $_SESSION["response"] = "Password Successfully Updated. &nbsp;<a href='index1.php?page=myaccount'>Click here to see!</a>";
                    $_SESSION["resType"] = "success";
                    header("refresh:0");
                }
                else{
                    $_SESSION["response"] = "Error Updating Password: '".mysqli_error($connection)."' ";
                    $_SESSION["resType"] = "danger";
                    header("refresh:0");
                }
            }
            else{
                $_SESSION["response"] = "The entered current password for this account is invalid! ";
                $_SESSION["resType"] = "danger";
                header("refresh:0");
            }
        }
    }

?>

<head>
    <title>My Account | Cave Colombe</title>
</head>

<br><br>

<?php if(isset($_SESSION["response"])){ ?>
    <div class="mx-4 alert fw-bold alert-<?= $_SESSION["resType"]; ?> alert-dismissible fade show" role="alert">
    <button type="button" class="btn-close fw-bold" data-bs-dismiss="alert" aria-label="Close" title="Close"></button>
        <?= $_SESSION["response"];?>
    </div>
<?php } unset($_SESSION["response"]); ?>

<br>

<!-- Main Page (i.e., Header, Personal Information Table, Account Settings Table) -->

<div class="container-fluid">
    <div class="row align-items-center">
        <div class="col-sm-12">
            <div class="mx-5">
                <h1 class="text-center display-4 fst-italic fw-bold"><?php if($_SESSION["login"] == true){ echo $_SESSION["firstname"]; } else {echo "USER";} ?>'s Account </h1>
                <p class="text-center fs-5">All your account details in one place!</p>
                <p class="lead fw-bold mx-5 text-end"><span class="fst-italic">Last Updated:  </span><?php echo $row["lastUpdated"]; ?></p>
            </div>
        </div>
    </div>

    <br>

    <div class="mb-3 p-5 mx-3" id="personalInfo">

        <h2 class="mx-5 fs-1 fw-bold fst-italic">Personal Information</h2>

        <div class="table-responsive mx-5">
            <table class="table table-borderless table-striped table-dark text-center mt-4" id="tb-user-info">

                <tr class="fs-5">
                    <td class="fw-bold align-middle">First Name:</td>
                    <td class="align-middle"><?php echo $row["firstName"]; ?></td>
                    <td><button class="btn btn-outline-info px-3 py-2 fw-bold" data-bs-toggle="modal" data-bs-target="#updateFirstname"><i class="fa-solid fa-pen-to-square"></i>&nbsp;&nbsp; Update</button></td>
                </tr>

                <tr class="fs-5">
                    <td class="fw-bold align-middle">Last Name:</td>
                    <td class="align-middle"><?php echo $row["lastName"]; ?></td>
                    <td><button class="btn btn-outline-info px-3 py-2 fw-bold" data-bs-toggle="modal" data-bs-target="#updateLastname"><i class="fa-solid fa-pen-to-square"></i>&nbsp;&nbsp; Update</button></td>
                </tr>

                <tr class="fs-5">
                    <td class="fw-bold align-middle">Email:</td>
                    <td class="align-middle"><?php echo $row["email"]; ?></td>
                    <td><button class="btn btn-outline-info px-3 py-2 fw-bold" data-bs-toggle="modal" data-bs-target="#updateEmail"><i class="fa-solid fa-pen-to-square"></i>&nbsp;&nbsp; Update</button></td>
                </tr>

                <tr class="fs-5">
                    <td class="fw-bold align-middle">Phone:</td>
                    <td class="align-middle"><?php echo $row["phone"]; ?></td>
                    <td><button class="btn btn-outline-info px-3 py-2 fw-bold" data-bs-toggle="modal" data-bs-target="#updatePhone"><i class="fa-solid fa-pen-to-square"></i>&nbsp;&nbsp; Update</button></td>
                </tr>

                <tr class="fs-5">
                    <td class="fw-bold align-middle">Date of Birth:</td>
                    <td class="align-middle"><?php echo $row["DOB"]; ?></td>
                    <td><button class="btn btn-outline-info px-3 py-2 fw-bold" data-bs-toggle="modal" data-bs-target="#updateDOB"><i class="fa-solid fa-pen-to-square"></i>&nbsp;&nbsp; Update</button></td>
                </tr>

                <tr class="fs-5">
                    <td class="fw-bold align-middle">Gender:</td>
                    <td class="align-middle"><?php echo $row["gender"]; ?></td>
                    <td><button class="btn btn-danger px-3 py-2 fw-bold disabled"><i class="fa-solid fa-lock"></i>&nbsp;&nbsp; Locked</button></td>
                </tr>

            </table>
        </div>
    </div>

    <br>

    <div class="p-5 mx-3" id="accountSettings">

        <h2 class="mx-5 fs-1 fw-bold fst-italic">Account Settings</h2>

        <div class="table-responsive mx-5">
            <table class="table table-borderless table-striped table-light text-center mt-4" id="tb-account-set">

                <tr class="fs-5">
                    <td class="fw-bold align-middle">User ID:</td>
                    <td class="align-middle"><?php echo $row["userID"]; ?></td>
                    <td><button class="btn btn-danger px-3 py-2 fw-bold disabled"><i class="fa-solid fa-lock"></i>&nbsp;&nbsp; Locked</button></td>
                </tr>

                <tr class="fs-5">
                    <td class="fw-bold align-middle">Access Role:</td>
                    <td class="align-middle"><?php echo $row["accessRole"]; ?></td>
                    <td><button class="btn btn-danger px-3 py-2 fw-bold disabled"><i class="fa-solid fa-lock"></i>&nbsp;&nbsp; Locked</button></td>
                </tr>

                <tr class="fs-5">
                    <td class="fw-bold align-middle">Username:</td>
                    <td class="align-middle"><?php echo $row["username"]; ?></td>
                    <td><button class="btn btn-info px-3 py-2 fw-bold" data-bs-toggle="modal" data-bs-target="#updateUsername"><i class="fa-solid fa-pen-to-square"></i>&nbsp;&nbsp; Update</button></td>
                </tr>

                <tr class="fs-5">
                    <td class="fw-bold align-middle">Password:</td>
                    <td class="align-middle"><?php echo $row["passw"]; ?></td>
                    <td><button class="btn btn-info px-3 py-2 fw-bold" data-bs-toggle="modal" data-bs-target="#updatePassword"><i class="fa-solid fa-pen-to-square"></i>&nbsp;&nbsp; Update</button></td>
                </tr>

            </table>
        </div>
    </div>

    <br><br>

    <div class="row align-items-center">
        <div class="col-12 d-flex justify-content-center">
            <button class="btn btn-danger px-4 py-2 fw-bold" data-bs-toggle="modal" data-bs-target="#deleteAccount"><i class="fa-solid fa-trash-can"></i>&nbsp;&nbsp; Delete Account</button>
        </div>
    </div>

</div>

<br><br>


<br>

<!-- Modals for Credential Updates -->

    <!-- Modal for Updating FIRSTNAME -->

    <div class="modal fade" id="updateFirstname" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <h3 class="modal-title fw-bold fst-italic">Update First Name</h3>
                    <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close"><i class="fa-solid fa-xmark fa-2x"></i></button>
                </div>

                <div class="modal-body px-5 py-3">
                    <form action="index1.php?page=myaccount" method="POST">

                        <div class="row">
                            <label for="currentFirstname" class="col-form-label fs-5 fw-bold">Current First Name: </label>
                            <input class="form-control form-control-lg fs-5" type="text" name="currentFirstname" id="currentFirstname" placeholder="<?php echo $row["firstName"]; ?>" readonly/>
                        </div>

                        <div class="row">
                            <label for="newFirstname" class="col-form-label fs-5 fw-bold">New First Name: </label>
                            <input class="form-control form-control-lg fs-5" type="text" name="newFirstname" id="newFirstname" placeholder="Insert New Value" required/>
                        </div>
                </div>

                <div class="modal-footer gap-2">
                    <input type="hidden" name="form" value="firstName">
                    <button type="submit" class="btn btn-outline-success fw-bold px-3 py-2 " name="firstName" value="firstName">Save</button>
                    <button type="reset" class="btn btn-outline-secondary fw-bold rounded-circle"><i class="fas fa-redo-alt"></i></button>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <!-- Modal for Updating LASTNAME -->

    <div class="modal fade" id="updateLastname" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <h3 class="modal-title fw-bold fst-italic">Update Last Name</h3>
                    <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close"><i class="fa-solid fa-xmark fa-2x"></i></button>
                </div>

                <div class="modal-body px-5 py-3">
                    <form action="index1.php?page=myaccount" method="POST">

                        <div class="row">
                            <label for="currentLastname" class="col-form-label fs-5 fw-bold">Current Last Name: </label>
                            <input class="form-control form-control-lg fs-5" type="text" name="currentLastname" id="currentLastname" placeholder="<?php echo $row["lastName"]; ?>" readonly/>
                        </div>

                        <div class="row">
                            <label for="newLastname" class="col-form-label fs-5 fw-bold">New Last Name: </label>
                            <input class="form-control form-control-lg fs-5" type="text" name="newLastname" id="newLastname" placeholder="Insert New Value" required/>
                        </div>
                </div>

                <div class="modal-footer gap-2">
                    <input type="hidden" name="form" value="lastName">
                    <button type="submit" class="btn btn-outline-success fw-bold px-3 py-2 " name="lastName" value="lastName">Save</button>
                    <button type="reset" class="btn btn-outline-secondary fw-bold rounded-circle"><i class="fas fa-redo-alt"></i></button>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <!-- Modal for Updating EMAIL ADDRESS -->

    <div class="modal fade" id="updateEmail" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <h3 class="modal-title fw-bold fst-italic">Update Email Address</h3>
                    <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close"><i class="fa-solid fa-xmark fa-2x"></i></button>
                </div>

                <div class="modal-body px-5 py-3">
                    <form action="index1.php?page=myaccount" method="POST">

                        <div class="row">
                            <label for="currentEmail" class="col-form-label fs-5 fw-bold">Current Email Address: </label>
                            <input class="form-control form-control-lg fs-5" type="email" name="currentEmail" id="currentEmail" placeholder="<?php echo $row["email"]; ?>" readonly/>
                        </div>

                        <div class="row">
                            <label for="newEmail" class="col-form-label fs-5 fw-bold">New Email Address: </label>
                            <input class="form-control form-control-lg fs-5" type="email" name="newEmail" id="newEmail" placeholder="Insert New Value" required/>
                        </div>
                </div>

                <div class="modal-footer gap-2">
                    <input type="hidden" name="form" value="email">
                    <button type="submit" class="btn btn-outline-success fw-bold px-3 py-2 " name="email" value="email">Save</button>
                    <button type="reset" class="btn btn-outline-secondary fw-bold rounded-circle"><i class="fas fa-redo-alt"></i></button>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <!-- Modal for Updating PHONE NUMBER -->

    <div class="modal fade" id="updatePhone" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <h3 class="modal-title fw-bold fst-italic">Update Phone Number</h3>
                    <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close"><i class="fa-solid fa-xmark fa-2x"></i></button>
                </div>

                <div class="modal-body px-5 py-3">
                    <form action="index1.php?page=myaccount" method="POST">

                        <div class="row">
                            <label for="currentPhone" class="col-form-label fs-5 fw-bold">Current Phone Number: </label>
                            <input class="form-control form-control-lg fs-5" type="text" name="currentPhone" id="currentPhone" placeholder="<?php echo $row["phone"]; ?>" readonly/>
                        </div>

                        <div class="row">
                            <label for="newPhone" class="col-form-label fs-5 fw-bold">New Phone Number: </label>
                            <input class="form-control form-control-lg fs-5" type="text" name="newPhone" id="newPhone" placeholder="Insert New Value" required/>
                        </div>
                </div>

                <div class="modal-footer gap-2">
                    <input type="hidden" name="form" value="phone">
                    <button type="submit" class="btn btn-outline-success fw-bold px-3 py-2 " name="phone" value="phone">Save</button>
                    <button type="reset" class="btn btn-outline-secondary fw-bold rounded-circle"><i class="fas fa-redo-alt"></i></button>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <!-- Modal for Updating DATE OF BIRTH -->

    <div class="modal fade" id="updateDOB" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <h3 class="modal-title fw-bold fst-italic">Update Date of Birth</h3>
                    <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close"><i class="fa-solid fa-xmark fa-2x"></i></button>
                </div>

                <div class="modal-body px-5 py-3">
                    <form action="index1.php?page=myaccount" method="POST">

                        <div class="row">
                            <label for="currentDOB" class="col-form-label fs-5 fw-bold">Current Date of Birth <span class="fs-6">(yyyy-mm-dd)</span>: </label>
                            <input class="form-control form-control-lg fs-5" type="text" name="currentDOB" id="currentDOB" placeholder="<?php echo $row["DOB"]; ?>" readonly/>
                        </div>

                        <div class="row">
                            <label for="newDOB" class="col-form-label fs-5 fw-bold">New Date of Birth: </label>
                            <input class="form-control form-control-lg fs-5" type="date" name="newDOB" id="newDOB" required/>
                        </div>
                </div>

                <div class="modal-footer gap-2">
                    <input type="hidden" name="form" value="DOB">
                    <button type="submit" class="btn btn-outline-success fw-bold px-3 py-2 " name="DOB" value="DOB">Save</button>
                    <button type="reset" class="btn btn-outline-secondary fw-bold rounded-circle"><i class="fas fa-redo-alt"></i></button>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <!-- Modal for Updating USERNAME -->

    <div class="modal fade" id="updateUsername" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <h3 class="modal-title fw-bold fst-italic">Update Username</h3>
                    <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close"><i class="fa-solid fa-xmark fa-2x"></i></button>
                </div>

                <div class="modal-body px-5 py-3">
                    <form action="index1.php?page=myaccount" method="POST">

                        <div class="row">
                            <label for="currentUser" class="col-form-label fs-5 fw-bold">Current Username: </label>
                            <input class="form-control form-control-lg fs-5" type="text" name="currentUser" id="currentUser" placeholder="<?php echo $row["username"]; ?>" readonly/>
                        </div>

                        <div class="row">
                            <label for="newUser" class="col-form-label fs-5 fw-bold">New Username: </label>
                            <input class="form-control form-control-lg fs-5" type="text" name="newUser" id="newUser" placeholder="Insert New Value" required/>
                        </div>
                </div>

                <div class="modal-footer gap-2">
                    <input type="hidden" name="form" value="user">
                    <button type="submit" class="btn btn-outline-success fw-bold px-3 py-2 " name="user" value="user">Save</button>
                    <button type="reset" class="btn btn-outline-secondary fw-bold rounded-circle"><i class="fas fa-redo-alt"></i></button>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <!-- Modal for Updating PASSWORD -->

    <div class="modal fade" id="updatePassword" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <h3 class="modal-title fw-bold fst-italic">Update Password</h3>
                    <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close"><i class="fa-solid fa-xmark fa-2x"></i></button>
                </div>

                <div class="modal-body px-5 py-3">
                    <form action="index1.php?page=myaccount" method="POST">

                        <div class="row">
                            <div class="col-11">
                                <label for="currentPass" class="col-form-label fs-5 fw-bold">Current Password: </label>
                                <input class="form-control form-control-lg fs-5" type="password" name="currentPass" id="currentPass" placeholder="Enter Your Current Password" required/>
                            </div>

                            <div class="col-1 d-flex align-items-center mt-5" onClick="hidePassword()"> 
                                <i class="far fa-eye" id="cover1"></i>
                                <i class="far fa-eye-slash" id="cover2"></i>

                                <script>
                                    var x = document.getElementById("currentPass");
                                    var y = document.getElementById("cover1");
                                    var z = document.getElementById("cover2");

                                    y.style.display = "none";

                                    function hidePassword(){
                                        if(x.type === 'password'){
                                            x.type = "text";
                                            y.style.display = "block";
                                            z.style.display = "none";
                                        }
                                        else{
                                            x.type = "password";
                                            y.style.display = "none";
                                            z.style.display = "block";
                                        }
                                    }
                                </script>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-11">
                                <label for="newPass" class="col-form-label fs-5 fw-bold">New Password: </label>
                                <input class="form-control form-control-lg fs-5" type="password" name="newPass" id="newPass" placeholder="Insert New Value" required/>
                            </div>

                            <div class="col-1 d-flex align-items-center mt-5" onClick="showPassword()"> 
                                <i class="far fa-eye" id="cover3"></i>
                                <i class="far fa-eye-slash" id="cover4"></i>

                                <script>
                                    var a = document.getElementById("newPass");
                                    var b = document.getElementById("cover3");
                                    var c = document.getElementById("cover4");

                                    b.style.display = "none";

                                    function showPassword(){
                                        if(a.type === 'password'){
                                            a.type = "text";
                                            b.style.display = "block";
                                            c.style.display = "none";
                                        }
                                        else{
                                            a.type = "password";
                                            b.style.display = "none";
                                            c.style.display = "block";
                                        }
                                    }
                                </script>
                            </div>
                        </div>
                </div>

                <div class="modal-footer gap-2">
                    <input type="hidden" name="form" value="pass">
                    <button type="submit" class="btn btn-outline-success fw-bold px-3 py-2 " name="pass" value="pass">Save</button>
                    <button type="reset" class="btn btn-outline-secondary fw-bold rounded-circle"><i class="fas fa-redo-alt"></i></button>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <!-- Modal for DELETING USER ACCOUNT -->

    <div class="modal fade" id="deleteAccount" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">

                <div class="modal-header">
                    <h3 class="modal-title fw-bold fst-italic">Delete My Account</h3>
                    <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close"><i class="fa-solid fa-xmark fa-2x"></i></button>
                </div>

                <div class="modal-body text-center px-3 py-4">
                    <span class="text-danger"><i class="fa-solid fa-circle-exclamation fa-4x"></i></span>
                    <p class="mt-3 fs-4">Do you really want to delete your account, <?php echo $_SESSION["firstname"]; ?>?</p>
                </div>

                <div class="modal-footer gap-2">
                    <form action="delete-processing.php" method="POST">
                        <input type="hidden" name="userID" value="<?php echo $row["userID"]; ?>">
                        <button type="submit" class="btn btn-danger fw-bold px-3 py-2 fs-5" name="delete" value="deleteUser">Delete</button>
                    </form>
                    <button type="button" class="btn btn-secondary fw-bold px-3 py-2 fs-5" data-bs-dismiss="modal">Cancel</button>
                </div>

            </div>
        </div>
    </div>