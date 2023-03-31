<?php $pageTitle = "Mini REST API"; ?>

<?php require "partials/header.php" ?>

<?php require "partials/navigation.php" ?>



<main>
<section class="bg-light p-5 px-lg-0 py-lg-5">

    <div class="container">

        <h2 class="text-center fw-bolder">Mini REST API for survey+</h2>

        <p class="text-center">Incase you want to get some data from survey+</p>

        <div class="row mt-5 py-3 justify-content-between align-items-center">


            <div class="col-12 col-md-7 col-lg-8 mx-auto">

                <h3 class="text-center fw-bolder">List of available requests</h3>

                <ul class="mt-4 fs-5">
                    <li><kbd><?= base_url("api/users/") ?></kbd> - All Existing Users - <kbd class="bg-success">GET</kbd></li>

                    <li class="mt-4">
                        <kbd><?= base_url("api/surveys/") ?></kbd> - All Published Surveys / Month - <kbd class="bg-success">GET</kbd>
                    </li>

                </ul>

            </div>



        </div>


    </div>


</section>


</main>



<?php require "partials/footer.php" ?>