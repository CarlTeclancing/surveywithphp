<?php
require "../vendor/autoload.php";

if(isset($_POST) && $_SERVER['REQUEST_METHOD'] == "POST"){
 
        session_start();
        session_unset();

        $_SESSION['user_id'] = null;
        $_SESSION['isAdmin'] = null;
        $_SESSION['full_name'] = null;
        $_SESSION["handle"] = null;


        session_destroy();
        
        header("Location:" . base_url());
        exit(0);
}else{
    header("Location:" . base_url());
    exit(0);
}