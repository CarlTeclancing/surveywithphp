<?php

require "../../vendor/autoload.php";

use Surveyplus\App\Controllers\SurveyTakerController;
session_start();

if (isset($_POST) && $_SERVER["REQUEST_METHOD"] == "POST") {


    $survey_id = $_POST["survey"];
    $profileID = $_POST["profile"];
    $handle = $_POST["handle"];
    $slug = $_POST["slug"];


    $surveyTaker = new SurveyTakerController();

    $email = $_POST["email"];

 

  


    




    if (!isset($email) || empty($email)) {
        $query = http_build_query(["survey" => $survey_id,  "profile" => $profileID, "handle" => $handle, "slug" => $slug, "error" => "emailrequired"]);

        header('Location: ' . base_url("check_email.php") . "?" . $query);
        exit(0);
    }

    // check if email not verified 
    # if not verified, verify survey taker
    if ($surveyTaker->emailNotVerified($email)) {


            $envActivationCode = generateRandomCode();
            // execute function
        
            $envActivationQuery = http_build_query(["survey" => $survey_id,  "profile" => $profileID, "handle" => $handle, "slug" => $slug, "email" => $email, "code" => $envActivationCode]);
        
            $envActivationLink = base_url("email_verification.php?") . $envActivationQuery;
        
        
            // Send email to user and ask to verify
        
            $subject = "Surveyplus Email Address Verification";
        
            $message = <<<MESSAGE
                        
                        Hello from survey+,
                        Please click the following link to verify your email address:
                        $envActivationLink
        
                        MESSAGE;
        
            $header = "From: " . SENDER_EMAIL_ADDRESS;
        
        
            // send email
            mail($email, $subject, $message, $header);

            // save activation code in database with user info\

            $surveyUserData = [
                "activation_code" => $envActivationCode
            ];


            $updateTaker = $surveyTaker->updateActivationCode($surveyUserData, $email);

            $query = http_build_query(["survey" => $survey_id,  "profile" => $profileID, "handle" => $handle, "slug" => $slug, "success" => "verifyemail"]);
            header('Location: ' . base_url("check_email.php") . "?" . $query);
            exit(0);
        

    }

    // Check if users email is unique (mostly for already veified survey takers) redirect them to the survey and set session

    if (!$surveyTaker->isUniqueEmail($email)) {

        $_SESSION["survey_taker"] = $email;

        $query = http_build_query(["survey" => $survey_id,  "profile" => $profileID, "handle" => $handle, "slug" => $slug,  "success" => "emailalreadyverified"]);
        header('Location: ' . base_url("check_email.php") . "?" . $query);
        exit(0);

    }


    
    $activationCode = generateRandomCode();
    // execute function
   
    $activationQuery = http_build_query(["survey" => $survey_id,  "profile" => $profileID, "handle" => $handle, "slug" => $slug, "email" => $email, "code" => $activationCode]);

    $activationLink = base_url("email_verification.php?") . $activationQuery;


    // Send email to user and ask to verify

    $subject = "Surveyplus Email Address Verification";

    $message = <<<MESSAGE
                
                Hello from survey+,
                Please click the following link to verify your email address:
                $activationLink

                MESSAGE;

    $header = "From: " . SENDER_EMAIL_ADDRESS;


    // send email
    mail($email, $subject, $message, $header);

    // save activation code in database with user info\

    $surveyUserData = [
        "email" => $email,
        "survey_id" => $survey_id,
        "email_verification" => 0,
        "activation_code" => $activationCode
    ];


    // Save survey user and get last saved id
    $saveTaker = $surveyTaker->create($surveyUserData);



    $query = http_build_query(["survey" => $survey_id,  "profile" => $profileID, "handle" => $handle, "slug" => $slug, "success" => "verifyemail"]);
    header('Location: ' . base_url("check_email.php") . "?" . $query);
    exit(0);

} else {


    header("Location:" . base_url());
    exit(0);
}
