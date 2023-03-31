<?php $pageTitle = "Home"; ?>

<?php require "partials/header.php" ?>

<?php require "partials/navigation.php" ?>


<main>

    <section class="hero mt-5 p-5 px-lg-0 py-lg-5">
    
        
        <div class="container">
            <?php require "partials/notification.php"?>

            <div class="row align-items-center mt-4">

                <div class="col-lg-7">
                    <img src="<?= base_url('images/undraw_survey.svg') ?>" class="img-fluid" alt="Surveyplus survey">
                </div>


                <div class="col-lg-5 mt-5 mt-lg-0">
                    <h2 class="fw-bold">Reach your audience wherever they may be</h2>

                    <p>Share your survey via email, SMS, Facebook, Twitter, blogs and more</p>

                    <h2 class="fw-bold">Get answers with surveys</h2>

                    <p>Be the person with great ideas. Surveys give you actional insignits and fresh perspectives</p>

                    <div class="hero__button--group mt-5 d-flex flex-column flex-lg-row">
                        
                    <?php if (!isset($_SESSION['user_id'])) : ?>

                        <a href="<?= base_url("signup.php") ?>" class="btn btn-primary text-white rounded-0">Sign Up For Free</a>

                        <a href="<?= base_url("explore.php") ?>" class="btn btn-outline-secondary rounded-0 mt-3 mt-lg-0 ms-lg-4">Explore Existing Surveys</a>

                    <?php else : ?>

                        <a href="<?= DASHBOARD_URL . "/survey/create.php" ?>" class="btn btn-primary text-white rounded-0" target="_blank">Start creating surveys</a>

                    <?php endif ?>

                    </div>
                </div>
            </div>


        </div>


    </section>


    <section class="bg-light mt-5 p-5 px-lg-0 py-lg-5 border-top border-2 border-primary">

        <div class="container">

            <h2 class="text-center fw-bolder">Need and enterprise-grade solution</h2>

            <p class="text-center">SURVEYplus is best survey system to empower organisations to gain insights from customers, employees and the market - securely and at scale.</p>

            <div class="row mt-5 py-5 justify-content-between align-items-center">


                <div class="col-lg-5">

                    <h3 class="text-center fw-bolder">Everything you need to create the best surveys</h3>

                    <ul class="mt-4">
                        <li>Get access to surey templates that speak to customers, employees or your target audience</li>

                        <li class="mt-4">
                            Choose from expert-written sample questions to include in your surveys.
                        </li>

                        <li class="mt-4">
                            Score your surveys to estimate their success rates with SurveyMonkey Genius.
                        </li>

                        <li class="mt-4">
                            Explore our best practices for creating even the most sophisticated surveys.
                        </li>

                    </ul>

                </div>


                <div class="col-lg-7 text-center text-lg-end">

                    <img src="images/undraw_circuit_board.svg" class="img-fluid" alt="Surveyplus survey">

                </div>

            </div>



        </div>


    </section>


</main>


<?php require "partials/footer.php" ?>