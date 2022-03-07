<?php
    session_start();
?>

<head>
    <title>Register | Cave Colombe</title>
</head>

<br><br>

<?php if(isset($_SESSION["response"])){ ?>
    <div class="mx-4 alert fw-bold alert-<?= $_SESSION["resType"]; ?> alert-dismissible fade show" role="alert">
    <button type="button" class="btn-close fw-bold" data-bs-dismiss="alert" aria-label="Close" title="Close"></button>
        <?= $_SESSION["response"];?>
    </div>
<?php } unset($_SESSION["response"]); ?>

<br><br>

<div class="container-fluid">

    <div class="row">

        <div class="col-lg-1"></div>

        <div class="col-lg-10">

            <div class="card p-5" id="regContainer">

                <div class="row g-5 align-items-center">

                    <div class="col-lg-6 col-md-12 col-sm-12 text-center py-5 pb-0" id="loginPrompt">
                        <h3 class="display-4">Welcome Back!</h3>
                        <p class="mb-2 fs-5">If you are a returning user, please log in to your account for full access to the system's functions.</p>
                        <a href="index1.php?page=login" class="btn px-5 py-2 mt-2 rounded-pill text-center btn-log" role="button"><i class="fa-solid fa-right-to-bracket"></i>&nbsp;&nbsp; Login</a>
                    </div>

                    <div class="col-lg-6 col-md-12 col-sm-12" id="regForm">
                        <div class="card-body">
                            <h1 class="card-title display-2 text-center">Register</h1>

                            <form action="register-login-processing.php" method="POST" name="Register" class="row g-4 mt-2">

                                <div class="form-floating col-lg-6 col-md-6 col-sm-12">
                                    <input class="form-control form-control-lg" type="text" name="firstname" id="firstname" placeholder="First Name" required/>
                                    <label for="firstname" class="px-4 fw-bold">First Name</label>
                                </div>

                                <div class="form-floating col-lg-6 col-md-6 col-sm-12">
                                    <input class="form-control form-control-lg" type="text" name="lastname" id="lastname" placeholder="Last Name" required/>
                                    <label for="lastname" class="px-4 fw-bold">Last Name</label>
                                </div>

                                <div class="form-floating col-lg-6 col-md-6 col-sm-12">
                                    <input class="form-control form-control-lg" type="email" name="email" id="email" placeholder="Email"/>
                                    <label for="email" class="px-4 fw-bold">Email Address</label>
                                </div>

                                <div class="form-floating col-lg-6 col-md-6 col-sm-12">
                                    <input class="form-control form-control-lg" type="text" name="phone" id="phone" placeholder="Phone"/>
                                    <label for="phone" class="px-4 fw-bold">Phone Number</label>
                                </div>

                                <div class="form-floating col-lg-6 col-md-6 col-sm-12">
                                    <input class="form-control form-control-lg" type="date" name="dob" id="dob" placeholder="Date of Birth" required/>
                                    <label for="dob" class="px-4 fw-bold">Date of Birth </label>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-floating">
                                        <select class="form-select form-select-lg" name="gender" id="gender" required>
                                            <option selected value="">Your Gender...</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                        <label class="px-3 fw-bold" for="gender">Gender</label>
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-12 mx-5">
                                    <label for="accessRole"><span class="fw-bold fs-5">User Access Role:</span></label>

                                    <div class="form-check form-check-inline fs-5">
                                        <input class="form-check-input ms-2" type="radio" name="accessRole" id="accessRole1" value="Customer" required>
                                        <label class="form-check-label ms-1" for="accessRole1">Customer</label>
                                    </div>

                                    <div class="form-check form-check-inline fs-5">
                                        <input class="form-check-input ms-2" type="radio" name="accessRole" id="accessRole2" value="Administrative Staff" required>
                                        <label class="form-check-label ms-1" for="accessRole2">Administrative Staff</label>
                                    </div>

                                    <div class="form-check form-check-inline fs-5">
                                        <input class="form-check-input ms-2" type="radio" name="accessRole" id="accessRole3" value="Data Analyst" required>
                                        <label class="form-check-label ms-1" for="accessRole3">Data Analyst</label>
                                    </div>
                                </div>

                                <div class="form-floating col-lg-12 col-md-12 col-sm-12">
                                    <input class="form-control form-control-lg" type="text" name="username" id="username" placeholder="Username" required/>
                                    <label for="username" class="px-4 fw-bold">Username</label>
                                </div>

                                <div class="form-floating col-lg-11 col-md-11 col-sm-11">
                                    <input class="form-control form-control-lg" type="password" name="password" id="password" placeholder="Password" required/>
                                    <label for="password" class="px-4 fw-bold">Password</label>
                                </div>

                                <div class="col-lg-1 col-md-1 col-sm-1 mt-5" onClick="hidePassword()"> 
                                    <i class="far fa-eye" id="cover1"></i>
                                    <i class="far fa-eye-slash" id="cover2"></i>

                                    <script>
                                        var x = document.getElementById("password");
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

                                <div class="col-lg-12 col-md-12 col-sm-12 justify-content-center">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="confirmAge" required>
                                        <label class="form-check-label" for="confirmAge">
                                            <span class="fst-italic">You acknowledge that you are at least <b>21 years</b> of age and that we, Cave Colombe, are not liable should this be false.</span>
                                        </label>
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-12 text-center">
                                    <input type="hidden" name="form" value="Register">
                                    <button class="btn px-5 py-3 rounded-pill text-center fw-bold btn-reg" type="submit"><i class="fa-solid fa-user-plus"></i>&nbsp;&nbsp;Register</button>
                                    <button  type="reset" class="btn btn-outline-secondary rounded-circle ms-2"value="clearValues" title="Reset Form"><i class="fas fa-redo-alt"></i></button>
                                </div>

                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-lg-1"></div>
    </div>
</div>

<br><br>



<br><br>