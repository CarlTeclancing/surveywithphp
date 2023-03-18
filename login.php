<?php $pageTitle = "Login"; ?>
<?php require "partials/header.php"?>
<?php require "partials/navigation.php"?>


<main>

    <div class="container mt-5 p-5 px-lg-0 py-lg-5">


        <div class="row">


            <div class="col-lg-7 mt-5">
                <img class="img-fluid" src="images/undraw_sign__up.svg" alt="Signup Image"/>
            </div>
            <div class="col-lg-5 mt-5 mb-5">

                <h3 class="text-center fw-bold">SURVEYplus</h3>
                <p class="text-center mb-3">Login to your Dashboard</p>


                <form action="">

                    <div class="form-group mb-3">

                        <input type="text" class="form-control border border-1 border-primary rounded-0" placeholder="Enter your email..." />

                    </div>


                    <div class="form-group mb-5">

                        <input type="password" class="form-control border border-1 border-primary rounded-0" placeholder="Enter your password..." />

                    </div>

                    <div class="form-group mb-3">

                        <button type="submit" class="btn btn-primary text-white w-100 rounded-0">Login</button>

                    </div>

                    <p class="text-center">Or</p>

                    <div class="row">
                        <div class="col-md-6">
                            <a href="#" class="btn surveybtn--facebook text-white w-100 rounded-0">Login with Facebook</a>
                        </div>
                        <div class="col-md-6 mt-2 mt-md-0">
                            <a href="#" class="btn surveybtn--gmail text-white w-100 rounded-0">Login with Google</a>
                        </div>
                    </div>

                    <p class="text-center mt-3">Don't have an account ? <a href="<?= BASE_URL . "/signup.php" ?>">Signup Here</a> </p>


                </form>

            </div>


        </div>



    </div>



</main>




<?php require "partials/footer.php"?>