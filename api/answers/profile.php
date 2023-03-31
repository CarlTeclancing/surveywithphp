<?php

session_start();

require "../../vendor/autoload.php";

header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json");

use Surveyplus\App\Controllers\AnswerController;


    
    if(!isset($_SESSION["profile_id"]))
    {
        http_response_code(403);
        echo json_encode("403 Forbidden");
        
        exit(0);
    }
    
    
    $answers = new AnswerController();
    $profileID = $_SESSION["profile_id"];
    
    $allAnswers = $answers->getAnswerStatisticsForProfile($profileID);
    
    // debug_array($allAnswers);
    
    if(is_array($allAnswers) && count($allAnswers) > 0){
    
        echo json_encode($allAnswers);
    }else{
        echo json_encode([]); // set an empty array
    }
    
    
    exit(0);


