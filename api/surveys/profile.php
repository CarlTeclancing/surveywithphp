<?php

session_start();

require "../../vendor/autoload.php";

header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json");

use Surveyplus\App\Controllers\SurveyController;

if(!isset($_SESSION["profile_id"]))
{
    http_response_code(403);
    echo json_encode("403 Forbidden");
    
    exit(0);
}


$surveys = new SurveyController();
$profileID = $_SESSION["profile_id"];

$allSurveys = $surveys->getSurveyStatisticsForProfile($profileID);


// debug_array($allSurveys);

if(is_array($allSurveys) && count($allSurveys) > 0){

    echo json_encode($allSurveys);

}else{
    echo json_encode([]); // set an empty array
}


exit(0);
