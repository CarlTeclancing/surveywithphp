<?php

require "../../vendor/autoload.php";

session_start();

use Surveyplus\App\Controllers\QuestionController;

if(isset($_GET["question"]) && isset($_GET["action"]) && $_GET["action"] == "delete")
{
    $question_id = $_GET["question"];
    $user_id = $_SESSION["user_id"];

    $question = new QuestionController();

    $survey_question = $question->show($question_id, $user_id);
      

   

    if($survey_question["survey_id"] == 1){

        header("Location:" . DASHBOARD_URL . "/question/index.php?type=question&error=deletenotallowed");
        exit(0);
    }
    


    $delete = $question->delete($question_id);
    

    if(!$delete)
    {
        header("Location:" . DASHBOARD_URL . "/question/index.php?type=question&error=deletefailed");
        exit(0);
    }

    header("Location:" . DASHBOARD_URL . "/question/index.php?type=question&success=deleted");
    exit(0);

}