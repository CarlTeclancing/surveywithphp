<?php $pageTitle = "Email Verification"; ?>

<?php require "partials/header.php" ?>


<?php

// debug_array($_GET);
use Surveyplus\App\Middleware\CheckLoggedInUser;
$guestOnly = new CheckLoggedInUser();
$guestOnly->guestOnly();

if (!isset($_GET["survey"]) && !isset($_GET["profile"]) && !isset($_GET["handle"]) &&  !isset($_GET["slug"])):
    
        header("Location:" . base_url());
        exit(0);
?>

<?php else:  ?>

<?php

    $survey = $_GET["survey"];
    $profile = $_GET["profile"];
    $slug = $_GET["slug"];
    $handle = $_GET["handle"];

?>

<?php require "partials/navigation.php" ?>


<main class="container-fluid h-screen d-flex justify-content-center align-items-center bg-primary">


    <div class="container">

        <div class="row">
            <div class="col-lg-5 mx-auto">
                <?php require "partials/notification.php" ?>
            </div>
        </div>

        <div class="row">

            <div class="col-lg-5 mx-auto p-0">
                <?php if(!isset($_GET["success"]) || empty($_GET["success"])): ?>


                    <div class="card rounded-0 border border-1 border-primary">

                    <div class="card-header">
                        <h3 class="text-center"><span class="fw-bold">survey+</span> Email Address</h3>
                    </div>

                    <div class="card-body text-center py-4">


                        <h4>Hello! You require a valid email address to take this survey</h4>


                        <form action="<?= base_url("includes/email/verify.inc.php") ?>" method="POST">
                            <div class="form-group mb-3">
                                <input type="hidden" name="survey" value="<?= $survey ?>">
                                <input type="hidden" name="profile" value="<?= $profile ?>">
                                <input type="hidden" name="handle" value="<?= $handle ?>">
                                <input type="hidden" name="slug" value="<?= $slug ?>">


                                <input type="email" class="form-control border border-1 border-primary rounded-0" placeholder="name@email.com" name="email" required>
                            </div>

                            <button type="submit" class="btn btn-primary rounded-0 text-white text-center">Submit</button>
                        </form>


                        <p class="mb-0 mt-3">Please make sure your email address works!</p>

                    </div>


                    </div>

                <?php elseif(isset($_GET["success"]) && $_GET["success"] == 'emailverified' || $_GET["success"] == 'emailalreadyverified'): ?>


                    <div class="card rounded-0 border border-1 border-primary py-4">
                        <div class="card-body text-center">
                            <p class="text-center fs-4"><span class="fw-bold">Hello!</span> You can now carry out the survey</p>
                            <a href="<?= survey($handle, $survey, $slug, $profile) ?>" class="btn btn-primary rounded-0 mt-3 text-white" target="_blank">Carryout Survey!</a>
                        </div>
                    </div>

                <?php elseif(isset($_GET["success"]) && $_GET["success"] == 'verifyemail'): ?>


                    <div class="card rounded-0 border border-1 border-primary py-4">
                        <div class="card-body text-center">
                            <p class="text-center fs-4"><span class="fw-bold">Hello!</span> Please verify your email address</p>
                        </div>
                    </div>

                <?php endif ?>

                

            </div>
        </div>


    </div>



</main>


<?php require "partials/footer.php" ?>

<?php endif ?>