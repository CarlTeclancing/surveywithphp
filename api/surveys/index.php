<?php


require "../../vendor/autoload.php";

header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json");

use Surveyplus\App\Controllers\SurveyController;

$surveys = new SurveyController();


$allSurveys = $surveys->getSurveyStatistics();


// debug_array($allSurveys);

if($allSurveys){

    echo json_encode($allSurveys);
}


exit(0);
