<?php require "vendor/autoload.php"; ?>
<?php

use Surveyplus\App\Controllers\SurveyController;
use Surveyplus\App\Controllers\QuestionController;
?>
<?php $pageTitle = "View Survey"; ?>
<?php require "partials/header.php" ?>


<?php if (isset($_GET["handle"]) && isset($_GET["id"]) && isset($_GET["profile"]) && isset($_GET["slug"])) : ?>

    <?php
    // debug_array($_SESSION);
    $survey_id = $_GET["id"];
    $profile_id = $_GET["profile"];

    $surveys = new SurveyController();
    $questions = new QuestionController();

    // Check if survey is published
    $published = $surveys->is_published($survey_id);

    if (!$published) {

        // Redirect where user is logged in
        if (isset($_SESSION["user_id"])) {
            header("Location: " . DASHBOARD_URL . "/survey/index.php?type=survey&error=notpublished");
            exit(0);
        }

        if (!isset($_SESSION["user_id"])) {
            // Redirect where user is not logged in
            header("Location: " . base_url());
            exit(0);
        }
    }

    $survey = $surveys->show_view($survey_id, true, $profile_id);

    $all_survey_questions = $questions->show_survey_single_question($profile_id, $survey_id);

    $count_question = 0;

    // debug_array($survey);
    ?>

    <?php require "partials/navigation.php" ?>

    <main class="container my-5">


        <h1 class="fw-bold text-center mb-5 text-primary text-decoration-underline"><?= $survey["name"] ?></h1>


        <form action="<?= base_url("includes/survey/submit.inc.php") ?>" method="POST">

        <input type="hidden" value="<?= $survey_id ?>" name="survey_id">
        <input type="hidden" value="<?= $profile_id?>" name="profile_id">


        <?php if(isset($all_survey_questions) && !empty($all_survey_questions)): ?>

            <?php foreach ($all_survey_questions as $question) : ?>

                <?php $count_question++ ?>


                <?php if ($question["answer_type_id"] == 1) : ?>

                    <div class="form-group mb-4 border border-1 border-primary py-4 px-4">

                        <h4><?= $count_question . ") " . ucwords($question["name"]) ?></h4>

                        <?php $description = json_decode($question["description"]); ?>

                        <?php if (isset($description) && !empty($description)) : ?>
                            <?php foreach ($description as $label) : ?>

                                <div class="form-check">
                                    <input type="radio" name="<?= "radio_" . $question["id"] ?>" class="form-check-input border border-1 border-primary" value="<?= $label ?>">
                                    <label class="ms-2 fw-bold form-check-label"  for="<?= "radio_" . $question["id"] ?>"><?= $label ?></label>
                                </div>

                            <?php endforeach ?>

                        <?php endif ?>

                    </div>
                <?php endif ?>




                <?php if ($question["answer_type_id"] == 2) : ?>

                    <div class="form-group mb-4 border border-1 border-primary py-4 px-4">

                        <h4><?= $count_question . ") " . ucwords($question["name"]) ?></h4>

                        <?php $description = json_decode($question["description"]); ?>

                        <?php if (isset($description) && !empty($description)) : ?>

                            <?php foreach ($description as $label) : ?>

                                <div class="form-check">
                                    <input type="checkbox" name="<?= "checkbox_" . $question["id"] . "[]" ?>" class="form-check-input border border-1 border-primary"  value="<?= $label ?>">
                                    <label class="ms-2 fw-bold form-check-label" for="<?= "checkbox_" . $question["id"] ?>"><?= $label ?></label>
                                </div>

                            <?php endforeach ?>

                        <?php endif ?>
                    </div>

                <?php endif ?>




                <?php if ($question["answer_type_id"] == 3) : ?>

                    <div class="form-group mb-4 border border-1 border-primary py-4 px-4">

                        <h4><?= $count_question . ") " . ucwords($question["name"]) ?></h4>


                        <div class="container p-0 my-3">
                            <input type="text" name="<?= "textfield_" . $question["id"] ?>" class="form-control border border-1 border-primary rounded-0" placeholder="Type your response">
                        </div>


                    </div>

                <?php endif ?>


            <?php endforeach ?>



                <div class="container p-0 mt-5 survey-taker">

                <h2 class="mb-3 text-center fw-bold text-primary">Validate Survey</h2>

                    <label for="email" class="fw-bold fs-3 mb-2">Your Email Address <span class="text-danger">*</span></label>
                    <div class="form-group mb-4">
                        <input type="email" name="email" class="form-control border border-1 border-primary rounded-0" placeholder="Type your email address" />
                    </div>
        
                    <label for="email" class="fw-bold fs-3 mb-2">What do you think about this survey?</label>
                    <div class="form-group mb-4">
                        <textarea name="comment" class="form-control border border-1 border-primary rounded-0" placeholder="Comment" style="resize:none"></textarea>
                    </div>

                </div>
                

                <button type="submit" class="btn btn-primary btn-lg w-100 text-white rounded-0">Submit Survey</button>

            </form>



            <?php else: ?>

                <p class="fs-4 fw-bold text-center">Sorry! No Questions Found this Survey</p>

            <?php endif ?>


    <?php else : ?>

        <?php
        header("Location: " . DASHBOARD_URL . "/survey/index.php?type=survey&error=invalidlink");
        exit(0);
        ?>

    <?php endif ?>


    </main>


    <?php require "partials/footer.php" ?>