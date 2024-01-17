        <footer id="footer" class="d-print-none">

            <div class="container-fluid py-3">

                <div class="row align-items-center">

                    <!-- Logo Column -->

                    <div class="col-lg-3 col-md-3 col-sm-12 d-flex justify-content-center py-3">
                        <a href="index1.php?page=home"><img id="auxLogo" src="images/CC LOGO.jpeg" alt="Cave Colombe Secondary Logo" /></a>
                    </div>

                    <!-- Our Shops Column -->

                    <div class="col-lg-3 col-md-3 col-sm-12">
                        <br><br>
                        <h2 class="text-center"> Our Shop</h2>
                        <br><br>

                        <div class="d-flex justify-content-center footText">
                            <span class="me-4 mt-3"><i class="fas fa-map-marked-alt fa-2x"></i></span>
                            <p class="text-start fw-bold">Angré 7ème Tranche Rue L173 <br> Cocody II Plateaux <br> Abidjan, Côte d'Ivoire</p>
                        </div>

                        <div class="d-flex justify-content-center mt-2 gap-3">
                            <a href="index1.php?page=about-us" class="btn btn-outline-light fw-bold" role="button" id="contactBtn"> About Us</a>
                            <a href="index1.php?page=contact-us" class="btn btn-outline-light fw-bold" role="button" id="contactBtn"> Contact Us</a>
                        </div>         
                    </div>

                    <!-- Connect With Us Column -->

                    <div class="col-lg-3 col-md-3 col-sm-12">
                        <br><br>
                        <h2 class="text-center"> Connect With Us On</h2>
                        <br><br>

                        <div class="app">
                            <div class="social">
                                <a href="https://www.facebook.com/cavecolombevins/" target="_blank" class="button-s facebook">
                                    <i class="fab fa-facebook-square"></i>
                                </a>
                                <a href="https://www.instagram.com/cavecolombe/" target="_blank" class="button-s instagram">
                                    <i class="fab fa-instagram"></i>
                                </a> 
                            </div>
                        </div>
                    </div>

                    <!-- Quick Links Column -->

                    <div class="col-lg-3 col-md-3 col-sm-12">
                        <br><br><br>
                        <h2 class="text-center"> Quick Links</h2>
                        <br>

                        <div class="d-flex justify-content-center">

                            <div class="text-start fw-bold">
                                
                                <table class="table table-borderless">

                                    <tbody> 
                                            <?php if($_SESSION["login"] == false){ ?>

                                            <tr class="text-center gap-2">
                                                <td>
                                                    <a href="index1.php?page=login" class="btn quickLink fw-bold" role="button"><i class="fa-solid fa-right-to-bracket"></i>&nbsp;&nbsp; Log In</a>
                                                </td>
                                                <td>
                                                    <a href="index1.php?page=register" class="btn quickLink fw-bold" role="button"><i class="fa-solid fa-user-plus"></i>&nbsp;&nbsp; Register</a>
                                                </td>
                                            </tr> 

                                            <?php } ?>
                                        
                                            <tr class="text-center gap-2">
                                                <td>
                                                    <a href="index1.php?page=favorites" class="btn userQL fw-bold" role="button"><i class="fa-solid fa-heart"></i>&nbsp;&nbsp; My Favorites</a>
                                                </td>
                                                <td>
                                                    <a href="index1.php?page=cart" class="btn userQL fw-bold" role="button"><i class="fa-solid fa-cart-shopping"></i>&nbsp;&nbsp; My Cart</a>
                                                </td>
                                            </tr>

                                            <?php if($_SESSION["login"] == true){ ?>
                                    
                                            <tr class="text-center gap-2">
                                                <td>
                                                    <a href="index1.php?page=myaccount" class="btn quickLink fw-bold" role="button"><i class="fas fa-user"></i>&nbsp;&nbsp; My Account</a>
                                                </td>
                                                <td>
                                                    <a href="" class="btn quickLink fw-bold" role="button" data-bs-toggle="modal" data-bs-target="#log-out"><i class="fas fa-sign-out-alt"></i>&nbsp;&nbsp; Log Out</a>
                                                </td>
                                            </tr>

                                            <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
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

                <!-- Copyright Row -->

                <div class="row mt-4">
                    <div class="col-lg-12 col-sm-12 text-center fw-bold h5" >
                        <p>Copyright &copy; 2021-2022 Cave Colombe.</p>
                    </div>
                </div>  

            </div>
        </footer>
    </body>
</html>