<?php

require "../../vendor/autoload.php";

use Surveyplus\App\Controllers\ProfileController;

if (isset($_POST) && $_SERVER['REQUEST_METHOD'] == "POST") {
    session_start();

    $first_name = clean_input($_POST['first_name']);
    $last_name = clean_input($_POST['last_name']);
    $username = clean_input($_POST['username']);
    $dob = clean_input($_POST['date_of_birth']);
    $signature = clean_input($_POST['signature']);
    $role_id = 2;
    $gender_id = clean_input($_POST['gender']);



    if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) {
        $user_id = $_SESSION["user_id"];
    } else {
        $user_id = null;
    }

    if (!empty($username)) {
        $handle = "@" . str_replace(" ", "_", strtolower($username));
    } else {
        $handle = null;
    }

    // Check for empty fields
    if (empty($first_name) || empty($last_name) || empty($username) || empty($dob) || empty($signature) || empty($handle) || empty($role_id) || empty($gender_id)) {

        header("Location:" . base_url("create_profile.php?error=emptyfield"));
        exit(0);
    }



    $profile = new ProfileController();

    // Verify if username already exists
    if ($profile->username_exists($username)) {
        header("Location:" . base_url("create_profile.php?error=usernameexists"));
        exit(0);
    }

    // Data to save in db
    $data = [
        "first_name" => $first_name,
        "last_name" => $last_name,
        "username" => $username,
        "dob" => $dob,
        "handle" => $handle,
        "signature" => $signature,
        "user_id" => $user_id,
        "role_id" => $role_id,
        "gender_id" => $gender_id
    ];

    // If at least one profile is active, set the others created by thesame user to inactive

    if($profile->active_profiles($user_id)){

        $data["isActive"]  = 0;

    }else{
        $data["isActive"] = 1;
    }


    $save = $profile->create($data);


    if (!$save) {

        header("Location:" . base_url("create_profile.php?error=profilenotcreated"));
        exit(0);
    }

    // Set profile information in session
    $_SESSION['full_name'] = $data["first_name"] . " " . $data["last_name"];
    $_SESSION["handle"] = $data["handle"];

    header("Location:" . base_url("dashboard/index.php?success=profilecreated"));
    exit(0);
} else {

    header("Location:" . base_url());
    exit(0);
}
