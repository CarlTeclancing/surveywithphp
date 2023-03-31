<?php

require "../../vendor/autoload.php";

session_start();

use Surveyplus\App\Controllers\SurveyController;


if(isset($_GET["survey"]) && !empty($_GET["survey"]))
{
    $surveyID = $_GET["survey"];

    $surveys = new SurveyController();

    $updateSurvey = $surveys->updateToDraft($surveyID);

    if(!$updateSurvey){
        header("Location:" . DASHBOARD_URL . "/survey/index.php?type=survey&error=notupdatedtodraft");
        exit(0);
    }

    header("Location:" . DASHBOARD_URL . "/survey/index.php?type=survey&success=updatedtodraft");
    exit(0);
}
else{

    header("Location: " . base_url());
    exit(0);
}



