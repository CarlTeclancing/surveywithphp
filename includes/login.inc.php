<?php

require "../vendor/autoload.php";

use Surveyplus\App\Controllers\UserController;

if(isset($_POST) && $_SERVER['REQUEST_METHOD'] == "POST")
{

    // debug_array($_POST);

    $email = clean_input($_POST['email']);
    $password = $_POST['password'];


    $users = new UserController();

    $auth = $users->auth($email, $password);

    
    if(!$auth){
       
        header("Location:" . base_url("login.php?error=authfailed"));
        exit(0);
    }
    
   
    header("Location:" . base_url("dashboard/index.php?success=loggedin"));
    exit(0);
    

}else{

    header("Location:" . base_url());
    exit(0);

}