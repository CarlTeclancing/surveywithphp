<?php

require "./vendor/autoload.php";


use Surveyplus\App\Middleware\CheckLoggedInUser;
use Surveyplus\App\Controllers\SurveyTakerController;

session_start();

if (!isset($_GET["survey"]) && !isset($_GET["email"]) && !isset($_GET["code"])) {
    $query = http_build_query(["error" => "emailverificationinvalid"]);

    header("Location: " . base_url("?") . $query);
    exit(0);
} else {


    $guestOnly = new CheckLoggedInUser();
    $guestOnly->guestOnly();

    $email = $_GET["email"];
    $survey = $_GET["survey"];
    $code = $_GET["code"];


    $profileID = $_GET["profile"];
    $handle = $_GET["handle"];
    $slug = $_GET["slug"];

    $surveyTaker = new SurveyTakerController();

    $verificationCode = $surveyTaker->getActivationCode($email);


    if ($code != $verificationCode) {
        $query = http_build_query(["survey" => $survey,  "profile" => $profileID, "handle" => $handle, "slug" => $slug,  "error" => "invalidcode"]);
        header('Location: ' . base_url("check_email.php") . "?" . $query);
        exit(0);
    }

    $data = [
        "email_verification" => 1
    ];

    $updateEmailVerification = $surveyTaker->updateVerification($data, $email);

    if (!$updateEmailVerification) {
        $query = http_build_query(["survey" => $survey,  "profile" => $profileID, "handle" => $handle, "slug" => $slug,  "error" => "unexpectederror"]);
        header('Location: ' . base_url("check_email.php") . "?" . $query);
        exit(0);
    }

    // Set survey taker in session
    $_SESSION["survey_taker"] = $email;

    $query = http_build_query(["survey" => $survey,  "profile" => $profileID, "handle" => $handle, "slug" => $slug,  "success" => "emailverified"]);
    header('Location: ' . base_url("check_email.php") . "?" . $query);
    exit(0);
}
