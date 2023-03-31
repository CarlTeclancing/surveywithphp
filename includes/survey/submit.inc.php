<?php

require "../../vendor/autoload.php";

use Surveyplus\App\Controllers\QuestionController;
use Surveyplus\App\Controllers\AnswerController;
use Surveyplus\App\Controllers\SurveyTakerController;

session_start();

if (isset($_POST) && $_SERVER["REQUEST_METHOD"] == "POST") {



    $questions = new QuestionController();
    $answers = new AnswerController();
    $surveryTaker = new SurveyTakerController();

    // debug_array($_POST);


    $comment = isset($_POST["comment"]) ? clean_input($_POST["comment"]) : "";
    $survey_id = $_POST["survey_id"];
    $profile_id = $_POST["profile_id"];
    $handle = $_POST["handle"];
    $slug = $_POST["slug"];

    $email = $_SESSION["survey_taker"];



    // Empty arrays to hold values below
    $checkboxes = [];
    $radios = [];
    $textfields = [];

    $question_answers = [];

    $allSurveyTakerAnswers = [];

    $all_survey_questions = $questions->show_survey_single_question($profile_id, $survey_id);


    foreach ($all_survey_questions as $question) {

        // Put values in an associative manner in arrays
        // Also verify if all individual input fields are set and are not empty



        if ($question["answer_type_id"] == 1) {


            if (isset($_POST["radio_" . $question["id"]]) && !empty($_POST["radio_" . $question["id"]])) {

                $radioUnique = "radio_" . $question["id"];

                $radios[$radioUnique] = $_POST[$radioUnique];

                $question_answers[$question["id"]]["answer"][$radioUnique] =  $radios[$radioUnique];

                $question_answers[$question["id"]]["answer_type"] = $question["answer_type_id"];
            }
        }

        if ($question["answer_type_id"] == 2) {

            if (isset($_POST["checkbox_" . $question["id"]]) && !empty($_POST["checkbox_" . $question["id"]])) {

                $checkBoxUnique = "checkbox_" . $question["id"];

                $checkboxes[$checkBoxUnique] = $_POST[$checkBoxUnique];

                $question_answers[$question["id"]]["answer"][$checkBoxUnique] = $checkboxes[$checkBoxUnique];

                $question_answers[$question["id"]]["answer_type"] = $question["answer_type_id"];
            }
        }

        if ($question["answer_type_id"] == 3) {

            if (isset($_POST["textfield_" . $question["id"]]) && !empty($_POST["textfield_" . $question["id"]])) {

                $textFieldUnique = "textfield_" . $question["id"];

                $textfields[$textFieldUnique] = $_POST[$textFieldUnique];


                $question_answers[$question["id"]]["answer"][$textFieldUnique] =  $textfields[$textFieldUnique] = $_POST[$textFieldUnique];

                $question_answers[$question["id"]]["answer_type"] = $question["answer_type_id"];
            }
        }
    }





    // Get use with email saved in session

    $currentSurveyTaker = $surveryTaker->getSurveyTakerID($email);

    foreach ($currentSurveyTaker as $surveyTakerItem) {
        $surveryTakerID = $surveyTakerItem["id"];
    }

    // Save survey answer
    $saveAnswer = $answers->create($question_answers, $surveryTakerID);


    // Check if answer is not saved
    if (!$saveAnswer) {
        $query = http_build_query(["handle" => $handle, "id" => $survey_id, "profile" => $profile_id, "slug" => $slug, "error" => "unexpectederror"]);

        header('Location: ' . base_url("survey.php") . "?" . $query);
        exit(0);
    }


    // unset the survey taker

    session_unset();
    $_SESSION['survey_taker'] = null;
    session_destroy();

    // Redirect to homepage if sucessful
    header('Location: ' . BASE_URL . "/index.php?success=surveysubmitted");
    exit(0);


    // debug_array([$question_answers, $_POST], true);
} else {

    header("Location:" . base_url());
    exit(0);
}
