<?php

require "../vendor/autoload.php";

use Surveyplus\App\Controllers\UserController;

if(isset($_POST) && $_SERVER['REQUEST_METHOD'] == "POST")
{
    $email = clean_input($_POST['email']);
    
    $password = $_POST['password'];
    $password_confirmation = $_POST['password_confirmation'];

    // Check for empty fields
    if(empty($email) || empty($password) || empty($password_confirmation)){
        header("Location:" . base_url("signup.php?error=emptyfield"));
        exit();
    }


    // Check if password confirmation does not correspond with password
    if($password_confirmation != $password){
        header("Location:" . base_url("signup.php?error=pwdconfirm"));
        exit();
    }


    $dbPassword = password_hash($password, PASSWORD_DEFAULT);


    $users = new UserController();

    // Data to save in db
    $data = [
        "email" => $email,
        "password" => $dbPassword,
        "isAdmin" => 0
    ];

    $users->create($data);
    
    header("Location:" . base_url("signup.php?success=created"));
    exit();
    

    // debug_array($_POST);
}
