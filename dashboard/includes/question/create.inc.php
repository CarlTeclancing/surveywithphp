<?php

require "../../../vendor/autoload.php";

use Surveyplus\App\Controllers\QuestionController;

session_start();

if(isset($_POST) && $_SERVER["REQUEST_METHOD"] == "POST")
{

    // debug_array($_POST);

    $questions = new QuestionController();


    $name = isset($_POST['name']) ? clean_input($_POST['name']) : "";
    $survey_id = isset($_POST['survey']) ? clean_input($_POST['survey']) : null;
    $answer_category_id = isset($_POST['answer_category']) ? clean_input($_POST['answer_category']) : null;

    $multi_choice = isset($_POST["multi_choice"]) ? $_POST["multi_choice"] : null;
    $one_choice = isset($_POST["one_choice"]) ? $_POST["one_choice"] : null;



    // Check for empty fields
    if(empty($name) || empty($survey_id) || empty($answer_category_id))
    {
        header("Location:" . DASHBOARD_URL . "/question/create.php?error=emptyfield");
        exit(0);
    }


    $data = [
        "name" => $name,
        "survey_id" => $survey_id,
        "answer_category_id" => $answer_category_id
    ];


    // Check answer type and place description if needed

    if($answer_category_id == 1)
    {
        $data["description"] = json_encode($one_choice);
    }
    else if($answer_category_id == 2)
    {
        $data["description"] = json_encode($multi_choice);
    }else
    {
        $data["description"] = NULL;
    }


    $save = $questions->create($data);

    if(!$save)
    {
        header("Location:" . DASHBOARD_URL . "/question/create.php?type=question&error=savefailed");
        exit(0);
    }

    header("Location:" . DASHBOARD_URL . "/question/create.php?type=question&success=saved");
    exit(0);
    
   


}else{

    header("Location:" . DASHBOARD_URL . "/question/create.php");
    exit(0);
}