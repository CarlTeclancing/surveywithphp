<?php
require "../vendor/autoload.php";

if(isset($_POST) && $_SERVER['REQUEST_METHOD'] == "POST"){
 
        session_start();
        session_unset();
        session_destroy();
        
        header("Location:" . base_url());
        exit(0);
}else{
    header("Location:" . base_url());
    exit(0);
}