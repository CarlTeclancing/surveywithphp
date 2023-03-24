<?php

use Surveyplus\App\Controllers\SurveyController;
use Surveyplus\App\Controllers\ProfileController;
use Surveyplus\App\Controllers\AnswerCategoryController;

$pageTitle = "Add Questions"; ?>

<?php require "../../vendor/autoload.php"; ?>

<?php require DASHBOARD_PATH . "/partials/header.php" ?>

<?php

$user_id = $_SESSION["user_id"];

$surveys = new SurveyController();
$answer_categories = new AnswerCategoryController();

$profiles =  new ProfileController();

$profile = $profiles->all_active_profiles($user_id);

$all_surveys = $surveys->show_user_survey($profile["id"]);

$all_answer_categories = $answer_categories->show_all();

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
                                <li class="breadcrumb-item active">Add a questions to your survey</li>
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


                        <form action="<?= DASHBOARD_URL . "/includes/question/create.inc.php" ?>" method="POST">


                            <div class="form-group mb-4">
                                <label for="name" class="mb-2 fw-bold">Name</label>
                                <input type="text" class="form-control border border-1 border-primary rounded-0" placeholder="Type your Questions Title" name="name">
                            </div>

                            <div class="form-group mb-4">
                                <label for="survey" class="mb-2 fw-bold">Survey</label>
                                <select name="survey" class="form-select border border-1 border-primary rounded-0">
                                    <option selected disabled>Select a Survey</option>
                                    <?php if (isset($all_surveys) && !empty($all_surveys)) : ?>
                                        <?php foreach ($all_surveys as $survey) : ?>
                                            <option value="<?= $survey["id"] ?>">
                                                <?= $survey["name"] ?>
                                                <?php if ($survey["published"] == 1) : ?>
                                                    <span>->Published</span>
                                                <?php else : ?>
                                                    <span>->Not Published</span>
                                                <?php endif ?>
                                            </option>
                                        <?php endforeach ?>
                                    <?php else : ?>
                                        <option selected disabled>No Survey Found</option>
                                    <?php endif ?>
                                </select>
                            </div>


                            <div class="form-group mb-4">
                                <label for="answer_category" class="mb-2 fw-bold">Answer Type</label>
                                <select onchange="questionItems()" name="answer_category" id="answer_category" class="form-select border border-1 border-primary rounded-0">

                                    <option selected disabled>Select and Answer type</option>

                                    <?php if (isset($all_answer_categories) && !empty($all_answer_categories)) : ?>
                                        <?php foreach ($all_answer_categories as $answer_category) : ?>
                                            <option value="<?= $answer_category["id"] ?>"><?= ucwords($answer_category["name"]) ?></option>

                                        <?php endforeach ?>
                                    <?php else : ?>
                                        <option selected disabled>No Answer Category Found</option>
                                    <?php endif ?>
                                </select>
                            </div>


                            <!-- Question description -->

                            <div class="container" id="question_items" style="padding: 1rem;">


                                <div id="one_choice" class="d-none">

                                    <button type="button" id="add_one_choice" class="btn btn-primary mb-3 text-white">Click to Add Choices</button>

                                    <div class="container p-0 mb-3" id="one_choice_group" style="margin-top: 1rem;">

                                    </div>

                                </div>



                                <div id="multiple_choice" class="d-none">

                                    <button type="button" id="add_multi_choice" class="btn btn-primary mb-3 text-white"> Click to Add Multiple Choices</button>

                                    <div class="container p-0 mb-3" id="multi_choice_group" style="margin-top: 1rem;">


                                    </div>

                                </div>


                            </div>


                            <div class="form-group">
                                <button type="submit" class="btn btn-primary rounded-0 w-100">Add Question to Survey</button>
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