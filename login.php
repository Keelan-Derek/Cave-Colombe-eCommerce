<?php
    session_start();
?>

<head>
    <title>Login | Cave Colombe</title>
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

            <div class="card p-5 pb-0" id="logContainer">

                <br><br><br><br>
                <div class="row g-5 align-items-center">

                    <div class="col-lg-6 col-md-6 col-sm-12 text-center py-5" id="regPrompt">
                        <h3 class="display-4">Hello, Guest!</h3>
                        <p class="mb-2 fs-5">If you are a new user, please create your account to gain full access to the system's functions.</p>
                        <a href="index1.php?page=register" class="btn px-5 py-2 mt-2 rounded-pill text-center btn-reg" role="button"><i class="fa-solid fa-user-plus"></i>&nbsp;&nbsp; Register</a>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-12 py-5 my-5" id="logForm">
                        <div class="card-body">

                        <?php
                            if(isset($_COOKIE["lock"])){
                                echo "<div class='alert alert-danger border border-danger text-center' role='alert'>3 Unsuccessful Login Attempts Have Been Made. <br> Please wait for 3 minutes.</div>";
                            }else {
                        ?>

                            <h1 class="card-title display-2 text-center">Login</h1>

                            <form action="register-login-processing.php" method="POST" name="Login" class="row g-4 mt-2">

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
                                
                                <div class="col-lg-12 col-md-12 col-sm-12 text-center">
                                    <input type="hidden" name="form" value="Login">
                                    <button class="btn px-5 py-3 rounded-pill text-center fw-bold btn-log" type="submit"><i class="fa-solid fa-right-to-bracket"></i>&nbsp;&nbsp;Login</button>
                                    <button  type="reset" class="btn btn-outline-secondary rounded-circle ms-2"value="clearValues" title="Reset Form"><i class="fas fa-redo-alt"></i></button>
                                </div>

                            </form>

                        <?php } ?>

                        </div>
                    </div>

                </div>
                <br><br><br><br>

            </div>
        </div>

        <div class="col-lg-1"></div>
    </div>
</div>

<br><br>



<br><br>