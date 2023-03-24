<?php
require "../../../vendor/autoload.php";

use Surveyplus\App\Controllers\QuestionController;
use Surveyplus\App\Controllers\SurveyController;

session_start();

if(isset($_POST) && $_SERVER["REQUEST_METHOD"] == "POST")
{

    $questions = new QuestionController();
    $surveys = new SurveyController();

    $name = isset($_POST['name']) ? clean_input($_POST['name']) : "";
    $survey_id = isset($_POST['survey']) ? clean_input($_POST['survey']) : null;
    $answer_category_id = isset($_POST['answer_category']) ? clean_input($_POST['answer_category']) : null;

    $question_id = $_POST["question_id"];
    $user_id = $_SESSION["user_id"];

    $multi_choice = isset($_POST["multi_choice"]) ? $_POST["multi_choice"] : null;
    $one_choice = isset($_POST["one_choice"]) ? $_POST["one_choice"] : null;


    // Check for empty fields
    if(empty($name) || empty($survey_id) || empty($answer_category_id))
    {
        header("Location:" . DASHBOARD_URL . "/question/create.php?error=emptyfield");
        exit(0);
    }


    $survey = $surveys->show($survey_id, $user_id);

    if($survey["published"] == 1)
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




    $is_published = $surveys->is_published($survey_id);

    if($is_published){
        header("Location:" . DASHBOARD_URL . "/question/index.php?type=question&error=updatenotallowed");
        exit(0);
    }


    $update = $questions->modify($data, $question_id);


    if(!$update){
        header("Location:" . DASHBOARD_URL . "/question/index.php?type=question&error=updatedfailed");
        exit(0); 
    }

    header("Location:" . DASHBOARD_URL . "/question/index.php?type=question&success=updated");
    exit(0);




}else{

    header("Location:" . DASHBOARD_URL . "/question/");
    exit(0);
}