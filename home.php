<?php
    session_start();
?>

<head>
    <title>Home | Cave Colombe </title>
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

    <!--Example Wine Card-->

    <div class="row row-cols-1 row-cols-md-3 g-4">

        <div class="col d-flex justify-content-center">
            <div class="wine-card card w-50 pt-3">
                <a href="" class="mx-auto"><img class="wine-img card-img-top" src="images/wine-bottle.png" alt="Wine Bottle"></a>
                <ul class="action">
                    <li><a href=""><i class="fa-solid fa-heart fa-3x" data-bs-toggle="tooltip" data-bs-placement="right" title="<?php if($_SESSION["login"] == true){ echo "Add to Favorites"; } else { echo "Please Log In To Use Favorite Function"; }?>"></i></a></li>
                </ul>

                <div class="wine-info card-body mt-3 p-3">
                    <a href="" class="wine-link"><h4 class="card-title text-center fw-bold fst-italic mt-2">Wine Name</h4></a>
                    <div class="fs-5 text-center">???? FCFA / Bottle</div>
                    <div class="fs-5 text-center">???? FCFA / Case of 6</div>
                    <div class="d-flex justify-content-center mt-3">
                        <button type="button" class="btn cart-btn py-3 px-5 fs-5 fw-bold rounded-pill" data-bs-toggle="modal" data-bs-target="#add-to-cart"><i class="fa-solid fa-cart-plus"></i>&nbsp;&nbsp;Add to Cart</button>
                    </div>
                </div>

            </div>
        </div>

    </div>

</div>

    <!-- Add to Cart Modal for Wine Card-->

    <div class="modal fade" id="add-to-cart" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <h3 class="modal-title fw-bold fst-italic ms-2">Add to Cart</h3>
                    <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close"><i class="fa-solid fa-xmark fa-2x"></i></button>
                </div>

                <div class="modal-body mx-3 px-3 py-4 row gap-3">
                    <form action="wine-processing.php" method="POST">

                        <div class="col-lg-12 col-sm-12 mt-3">
                            <label for="wineFormat" class="fs-5 fw-bold form-label">Wine Format</label>
                            <select class="form-select form-select-lg" name="wineFormat" id="wineFormat" required>
                                <option selected value="">Please Choose a Format...</option>
                                <option value="Bottle">Bottle(s)</option>
                                <option value="Case">Case(s)</option>
                            </select>
                        </div>

                        <div class="col-lg-12 col-sm-12 mt-3">
                            <label for="quantity" class="fs-5 fw-bold form-label">Quantity</label>
                            <input class="form-control form-control-lg" type="number" min="1" max="10" name="quantity" id="quantity" required/>
                        </div>

                </div>

                <div class="modal-footer gap-2">
                    <input type="hidden" name="form" value="addToCart">
                    <button type="submit" class="btn btn-outline-success fw-bold px-3 py-2">Add to Cart</button>
                    <button type="reset" class="btn btn-outline-secondary fw-bold rounded-circle"><i class="fas fa-redo-alt"></i></button>
                    <button type="button" class="btn btn-outline-secondary fw-bold px-3 py-2" data-bs-dismiss="modal">Cancel</button>
                    </form>
                </div>

            </div>
        </div>
    </div>


<br><br>



<br><br>   

<!-- End of Page -->
 
    <script>
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    </script>  
