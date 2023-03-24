<?php

require "../../vendor/autoload.php";

use Surveyplus\App\Controllers\SurveyController;

session_start();

if(isset($_GET["survey"]) && isset($_GET["action"]) && $_GET["action"] == "delete")
{
    $survey_id = $_GET["survey"];

    $survey = new SurveyController();

    $is_published = $survey->is_published($survey_id);

    if($is_published){
        header("Location:" . DASHBOARD_URL . "/survey/index.php?type=survey&error=deletenotallowed");
        exit(0);
    }


   try{

    $delete = $survey->delete($survey_id);

   }
   catch(PDOException $e)
   {
        header("Location:" . DASHBOARD_URL . "/survey/index.php?type=survey&error=surveyhasquestions");
        exit(0);
   }

    if(!$delete)
    {
        header("Location:" . DASHBOARD_URL . "/survey/index.php?type=survey&error=deletefailed");
        exit(0);
    }

    header("Location:" . DASHBOARD_URL . "/survey/index.php?type=survey&success=deleted");
    exit(0);

}