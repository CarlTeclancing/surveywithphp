<?php

require "../../../vendor/autoload.php";


use Surveyplus\App\Controllers\SurveyController;
use Surveyplus\App\Controllers\ProfileController;

session_start();

if(isset($_POST) && $_SERVER["REQUEST_METHOD"] == "POST")
{
    $user_id = $_SESSION["user_id"];

    $profiles = new ProfileController();
    $surveys = new SurveyController();

    $name = isset($_POST['name']) ? clean_input($_POST['name']) : "";
    $description = isset($_POST['description']) ? clean_input($_POST['description']) : "";
    $visbility = isset($_POST['visibility']) ? clean_input($_POST["visibility"]) : 0;
    $expires_on = isset($_POST['expires_on']) ? clean_input($_POST["expires_on"]) : NULL;
    $user_id = $_SESSION["user_id"];

    $survey_id = $_POST["survey_id"];


    // Check if survey you want to update is already published
    $is_published = $surveys->is_published($survey_id);

    if($is_published){
        header("Location:" . DASHBOARD_URL . "/survey/index.php?type=survey&error=updatenotallowed");
        exit(0);
    }

    // Check for empty fields
    if(empty($name) || empty($description) || empty($expires_on))
    {
        header("Location:" . DASHBOARD_URL . "/survey/create.php?error=emptyfield");
        exit(0);
    }



    $updated_on = date("Y-m-d H:i:s");


    // Check if published set date to now

    if($visbility == 1)
    {
        $published_date = date("Y-m-d H:i:s");

    }else{
        $published_date = NULL;
    }


    // Get current active profile id for user

    $profile = $profiles->all_active_profiles($user_id);


    $data = [
        "updatedOn" => $updated_on,
        "name" => $name,
        "description" => $description,
        "published" => $visbility,
        "publishedOn" => $published_date,
        "expiresOn" => $expires_on,
        "profile_id" => $profile["id"]
    ];

 


    $update = $surveys->modify($data, $survey_id);

    if(!$update)
    {
        header("Location:" . DASHBOARD_URL . "/survey/index.php?type=survey&error=updatefailed");
        exit(0);
    }

    header("Location:" . DASHBOARD_URL . "/survey/index.php?type=survey&success=updated");
    exit(0);



}else{

    header("Location:" . DASHBOARD_URL . "/survey/");
    exit(0);
}