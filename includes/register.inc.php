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
        exit(0);
    }


    // Check if password confirmation does not correspond with password
    if($password_confirmation != $password){
        header("Location:" . base_url("signup.php?error=pwdconfirm"));
        exit(0);
    }


    $dbPassword = password_hash($password, PASSWORD_BCRYPT);


    $users = new UserController();

    // Data to save in db
    $data = [
        "email" => $email,
        "password" => $dbPassword,
        "isAdmin" => 0
    ];

    $save = $users->create($data);

    if(!$save){
        header("Location:" . base_url("signup.php?error=notcreated"));
        exit(0);
    }
    
    header("Location:" . base_url("signup.php?success=created"));
    exit(0);
    

    // debug_array($_POST);
}else{

    header("Location:" . base_url());
    exit(0);

}
