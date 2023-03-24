<?php

use Surveyplus\App\Controllers\SurveyController;
use Surveyplus\App\Controllers\ProfileController;
use Surveyplus\App\Controllers\QuestionController;
use Surveyplus\App\Controllers\AnswerCategoryController;

$pageTitle = "Edit Questions"; ?>

<?php require "../../vendor/autoload.php"; ?>

<?php require DASHBOARD_PATH . "/partials/header.php" ?>

<?php


if (isset($_GET["question"]) && isset($_GET["action"]) && $_GET["action"] == "edit") {

    $question_id = $_GET["question"];
    $user_id = $_SESSION["user_id"];

    $surveys = new SurveyController();
    $answer_categories = new AnswerCategoryController();
    $questions = new QuestionController();

    $profiles =  new ProfileController();

    $profile = $profiles->all_active_profiles($user_id);


    $all_surveys = $surveys->show_user_survey($profile["id"], false);

    // print_r($all_surveys);

    $all_answer_categories = $answer_categories->show_all();


    $question = $questions->show($question_id, $profile["id"]);

    if ($question["survey_published"] == 1) {
        header("Location:" . DASHBOARD_URL . "/question/index.php?type=question&error=updatenotallowed");
        exit(0);
    }
}

?>

<body class="sb-nav-fixed">

    <?php require DASHBOARD_PATH . "/partials/navigation.php" ?>

    <div id="layoutSidenav">

        <?php require DASHBOARD_PATH . "/partials/sidebar.php" ?>

        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">


                    <?php require DASHBOARD_PATH . "/partials/notification.php" ?>

                    <div class="row align-items-center">
                        <div class="col-md-6">

                            <h1 class="mt-4"><?= $pageTitle ?></h1>
                            <ol class="breadcrumb mb-4">
                                <li class="breadcrumb-item active">Modify questions</li>
                            </ol>

                        </div>
                        <div class="col-md-6 text-start text-md-end mb-5 mb-md-0">

                            <?php if (isset($_SESSION["handle"]) & !empty($_SESSION["handle"])) : ?>
                                <p class="mb-0 fs-2"><?= $_SESSION["full_name"] ?> </p>
                                <p class="mb-0 fs-5"><?= $_SESSION["handle"] ?> </p>
                            <?php endif ?>

                        </div>
                    </div>




                    <div class="container p-0 mt-3">


                        <form action="<?= DASHBOARD_URL . "/includes/question/update.inc.php" ?>" method="POST">

                            <input type="hidden" name="question_id" value="<?= $question["id"] ?>">


                            <div class="form-group mb-4">
                                <label for="name" class="mb-2 fw-bold">Name</label>
                                <input type="text" class="form-control border border-1 border-primary rounded-0" placeholder="Type your Questions Title" value="<?= $question["name"] ?>" name="name">
                            </div>

                            <div class="form-group mb-4">
                                <label for="survey" class="mb-2 fw-bold">Survey</label>
                                <select name="survey" class="form-select border border-1 border-primary rounded-0">
                                    <?php if (isset($all_surveys) && !empty($all_surveys)) : ?>
                                        <?php foreach ($all_surveys as $survey) : ?>

                                            <?php if ($survey["id"] == $question["survey_id"]) : ?>
                                                <option value="<?= $survey["id"] ?>" selected>
                                                    <?= $survey["name"] ?>
                                                    <?php if ($survey["published"] == 1) : ?>
                                                        <span>->Published</span>
                                                    <?php else : ?>
                                                        <span>->Not Published</span>
                                                    <?php endif ?>
                                                </option>

                                            <?php else : ?>

                                                <option value="<?= $survey["id"] ?>">
                                                    <?= $survey["name"] ?>
                                                    <?php if ($survey["published"] == 1) : ?>
                                                        <span>->Published</span>
                                                    <?php else : ?>
                                                        <span>->Not Published</span>
                                                    <?php endif ?>
                                                </option>

                                            <?php endif ?>

                                        <?php endforeach ?>
                                    <?php else : ?>
                                        <option selected disabled>No Answer Category Found</option>
                                    <?php endif ?>
                                </select>
                            </div>


                            <div class="form-group mb-4">
                                <label for="answer_category" class="mb-2 fw-bold">Answer Type</label>
                                <select name="answer_category" id="answer_category" class="form-select border border-1 border-primary rounded-0">
                                    <option disabled>Select and Answer type</option>
                                    <?php if (isset($all_answer_categories) && !empty($all_answer_categories)) : ?>
                                        <?php foreach ($all_answer_categories as $answer_category) : ?>

                                            <?php if ($answer_category["id"] == $question["answer_type_id"]) : ?>

                                                <option value="<?= $answer_category["id"] ?>" selected><?= ucwords($answer_category["name"]) ?></option>

                                            <?php else : ?>

                                                <option value="<?= $answer_category["id"] ?>"><?= ucwords($answer_category["name"]) ?></option>

                                            <?php endif ?>

                                        <?php endforeach ?>
                                    <?php else : ?>
                                        <option selected disabled>No Answer Category Found</option>
                                    <?php endif ?>
                                </select>
                            </div>

                            <!-- Question description -->

                            <div class="container" id="question_items" style="padding: 1rem;">

                                <?php if (isset($question["description"]) && $question["answer_type_id"] == 1) : ?>

                                    <?php $description = json_decode($question["description"]);  ?>

                                    <div id="one_choice">

                                        <button type="button" id="add_one_choice" class="btn btn-primary mb-3 text-white">Click to Add Choices</button>

                                        <div class="container p-0 mb-3" id="one_choice_group" style="margin-top: 1rem;">

                                            <?php if (!empty($description) && isset($description)) : ?>
                                                <?php foreach ($description as $item) : ?>

                                                    <div class="one_choice_field input-group mb-3">
                                                        <input type="radio" class="me-3" disabled="disabled">
                                                        <input type="text" value="<?= $item ?>" class="form-control border border-1 border-primary rounded-0" placeholder="Type choice label" name="one_choice[]"><button type="button" class="delete_one_choice btn btn-danger">delete</button>
                                                    </div>
                                                <?php endforeach ?>


                                            <?php endif ?>

                                        </div>

                                    </div>

                                <?php else : ?>

                                    <div id="one_choice" class="d-none">

                                        <button type="button" id="add_one_choice" class="btn btn-primary mb-3 text-white">Click to Add Choices</button>

                                        <div class="container p-0 mb-3" id="one_choice_group" style="margin-top: 1rem;">

                                        </div>

                                    </div>


                                <?php endif ?>




                                <?php if (isset($question["description"]) && $question["answer_type_id"] == 2) : ?>

                                    <?php $description = json_decode($question["description"]);  ?>
                                    <div id="multiple_choice">

                                        <button type="button" id="add_multi_choice" class="btn btn-primary mb-3 text-white"> Click to Add Multiple Choices</button>

                                        <div class="container p-0 mb-3" id="multi_choice_group" style="margin-top: 1rem;">

                                            <?php if (!empty($description) && isset($description)) : ?>
                                                <?php foreach ($description as $item) : ?>

                                                    <div class="multi_choice_field input-group mb-3"><input type="checkbox" class="me-3" disabled="disabled"><input type="text" value="<?= $item ?>" class="form-control border border-1 border-primary rounded-0" placeholder="Type choice label" name="multi_choice[]"><button type="button" class="delete_multi_choice btn btn-danger">delete</button></div>

                                                <?php endforeach ?>
                                            <?php endif ?>

                                        </div>

                                    </div>


                                <?php else : ?>


                                    <div id="multiple_choice" class="d-none">

                                        <button type="button" id="add_multi_choice" class="btn btn-primary mb-3 text-white"> Click to Add Multiple Choices</button>

                                        <div class="container p-0 mb-3" id="multi_choice_group" style="margin-top: 1rem;">


                                        </div>

                                    </div>


                                <?php endif ?>


                            </div>


                            <div class="form-group">
                                <button type="submit" class="btn btn-primary rounded-0 w-100">Update Survey Question</button>
                            </div>


                        </form>

                    </div>


                </div>
            </main>


            <?php require DASHBOARD_PATH . "/partials/content-footer.php" ?>

        </div>

    </div>


    <?php require DASHBOARD_PATH . "/partials/footer.php" ?>


    <script>
        $(document).ready(function() {


            $("#add_one_choice").click(() => {

                let fieldCount = 1;
                let buttonCount = 1;

                let div = document.createElement("div");
                div.classList.add("one_choice_field", "input-group", "mb-3");
                div.setAttribute("id", "one_choice_field_" + fieldCount++);

                let radio = document.createElement("input");
                radio.type = "radio";
                radio.classList.add("me-3");
                radio.setAttribute("disabled", "disabled");

                let delButton = document.createElement("button");
                delButton.setAttribute("type", "button");
                delButton.classList.add("delete_one_choice", "btn", "btn-danger");
                delButton.setAttribute("id", "delete_one_choice_" + buttonCount++);
                delButton.textContent = "delete";

                let textInput = document.createElement("input");
                textInput.type = "text";
                textInput.classList.add("form-control", "border", "border-1", "border-primary", "rounded-0");
                textInput.placeholder = "Type choice label"
                textInput.name = "one_choice[]";



                let fragment = document.createDocumentFragment();

                fragment.appendChild(div).appendChild(radio);
                fragment.appendChild(div).appendChild(textInput);
                fragment.appendChild(div).appendChild(delButton);

                $("#one_choice_group").append(fragment);



                let currentFields = $(".one_choice_field");
                let deleteButtons = $(".delete_one_choice");

                for (let i = 0; i < currentFields.length; i++) {

                    deleteButtons[i].addEventListener('click', function() {

                        currentFields[i].remove();
                        deleteButtons[i].remove();

                    });


                }



            });



            $("#add_multi_choice").click(() => {

                let fieldCount = 1;
                let buttonCount = 1;

                let div = document.createElement("div");
                div.classList.add("multi_choice_field", "input-group", "mb-3");
                div.setAttribute("id", "multi_choice_field_" + fieldCount++);

                let checkbox = document.createElement("input");
                checkbox.type = "checkbox";
                checkbox.classList.add("me-3");
                checkbox.setAttribute("disabled", "disabled");

                let delButton = document.createElement("button");
                delButton.setAttribute("type", "button");
                delButton.classList.add("delete_multi_choice", "btn", "btn-danger");
                delButton.setAttribute("id", "delete_multi_choice_" + buttonCount++);
                delButton.textContent = "delete";

                let textInput = document.createElement("input");
                textInput.type = "text";
                textInput.classList.add("form-control", "border", "border-1", "border-primary", "rounded-0");
                textInput.placeholder = "Type choice label"
                textInput.name = "multi_choice[]";



                let fragment = document.createDocumentFragment();

                fragment.appendChild(div).appendChild(checkbox);
                fragment.appendChild(div).appendChild(textInput);
                fragment.appendChild(div).appendChild(delButton);

                $("#multi_choice_group").append(fragment);



                let currentFields = $(".multi_choice_field");
                let deleteButtons = $(".delete_multi_choice");

                for (let i = 0; i < currentFields.length; i++) {

                    deleteButtons[i].addEventListener('click', function() {

                        currentFields[i].remove();
                        deleteButtons[i].remove();

                    });


                }



            });





            $("#answer_category").change(function() {


                if (this.value == "1") {
                    $("#one_choice").removeClass("d-none");
                    $("#multiple_choice").addClass("d-none");

                }

                if (this.value == "2") {
                    $("#one_choice").addClass("d-none");
                    $("#multiple_choice").removeClass("d-none");
                }

                if (this.value == "3") {
                    $("#one_choice").addClass("d-none");
                    $("#multiple_choice").addClass("d-none");
                }


                console.log(this.value)


            });






        });
    </script>

</body>

</html>