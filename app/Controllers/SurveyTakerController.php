<?php

namespace Surveyplus\App\Controllers;
use Surveyplus\App\Models\SurveyTakers;

class SurveyTakerController
{

    public SurveyTakers $surveytakers;

    public function __construct()
    {
        $this->surveytakers = new SurveyTakers();
    }


    /**
     * Store user and return his last insert id
     *
     * @param array $data
     * @return int last insert id
     */
    public function create(array $data)
    {
       $insert =  $this->surveytakers->save($data);

       return $insert;
    }



    public function isUniqueEmail(string $email)
    {
        $emails = $this->surveytakers->select("SELECT * FROM survey_taker WHERE email = '$email'")->findAll();

        if(count($emails) > 0){
            return false;
        }

        return true;
    }

    public function getSurveyTakerID (string $email)
    {
        $surveyTakerID = $this->surveytakers->select("SELECT id FROM survey_taker WHERE email = '$email'")->findAll();

        if(count($surveyTakerID) > 0){
            return $surveyTakerID;
        }

        return false;
    }


    public function emailNotVerified(string $email)
    {

        $emails = $this->surveytakers->select("SELECT * FROM survey_taker WHERE email = '$email' AND email_verification = 0")->findAll();

        if(count($emails) > 0){
            return true;
        }

        return false;

    }


    public function getActivationCode(string $email)
    {
        $activationCode = $this->surveytakers->select("SELECT activation_code FROM survey_taker WHERE email = '$email' AND email_verification = 0")->findAll();

        if(count($activationCode) > 0){

            foreach($activationCode as $code)
            {
                return $code["activation_code"];

            }
        }

        return false;

    }


    public function updateVerification(array $data, string $email)
    {
        $update = $this->surveytakers->updateEmailVerification($data, $email);
        return $update;
    }

    public function updateActivationCode(array $data, string $email)
    {
        $update = $this->surveytakers->updateActivationCode($data, $email);
        return $update;
    }
}
