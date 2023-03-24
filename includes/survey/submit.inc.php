<?php

require "../../vendor/autoload.php";

use Surveyplus\App\Controllers\QuestionController;
use Surveyplus\App\Controllers\SurveyController;

session_start();

if (isset($_POST) && $_SERVER["REQUEST_METHOD"] == "POST") {

    $questions = new QuestionController();

    // debug_array($_POST);

    $email = clean_input($_POST["email"]);
    $comment = isset($_POST["comment"]) ? clean_input($_POST["comment"]) : "";
    $survey_id = $_POST["survey_id"];
    $profile_id = $_POST["profile_id"];

    // Empty arrays to hold values below
    $checkboxes = [];
    $radios = [];
    $textfields = [];


    $all_survey_questions = $questions->show_survey_single_question($profile_id, $survey_id);


    foreach ($all_survey_questions as $question) {

        // Put values in an associative manner in arrays
        // Also verify if all individual input fields are set and are not empty

        if ($question["answer_type_id"] == 1) {


            if (isset($_POST["radio_" . $question["id"]]) && !empty($_POST["radio_" . $question["id"]])) {
                $radios["radio_" . $question["id"]] = $_POST["radio_" . $question["id"]];
            }
        }

        if ($question["answer_type_id"] == 2) {

            if (isset($_POST["checkbox_" . $question["id"]]) && !empty($_POST["checkbox_" . $question["id"]])) {

                $checkboxes["checkbox_" . $question["id"]] = $_POST["checkbox_" . $question["id"]];
            }
        }

        if ($question["answer_type_id"] == 3) {

            if (isset($_POST["textfield_" . $question["id"]]) && !empty($_POST["textfield_" . $question["id"]])) {

                $textfields["textfield_" . $question["id"]] = $_POST["textfield_" . $question["id"]];
            }
        }
    }

    debug_array([$checkboxes, $radios, $textfields, $_POST], true);
}
