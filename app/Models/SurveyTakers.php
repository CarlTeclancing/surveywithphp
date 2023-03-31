<?php

namespace Surveyplus\App\Models;

class SurveyTakers extends BaseModel
{

    public string $table = "survey_taker";



    public function save(array $data)
    {

        $this->stmt = $this->conn->prepare("INSERT INTO $this->table (email, survey_id, email_verification, activation_code) VALUES (:email, :survey_id, :email_verification, :activation_code)");


        $this->stmt->bindParam(":email", $data["email"]);
        $this->stmt->bindParam(":survey_id", $data["survey_id"]);
        $this->stmt->bindParam(":email_verification", $data["email_verification"]);
        $this->stmt->bindParam(":activation_code", $data["activation_code"]);

        $execute = $this->stmt->execute();

        if (!$execute) {
            return false;
        }

        // Last saved taker id
        $lastID =  $this->conn->lastInsertId();

        return $lastID;
    }



    public function updateEmailVerification(array $data, string $email)
    {


        $email_verification = $data["email_verification"];

        $this->stmt = $this->conn->prepare("UPDATE $this->table SET email_verification = $email_verification  WHERE email = '$email' ");


        if (!$this->stmt->execute()) {
            return false;
        }

        return true;
    }



    public function updateActivationCode(array $data, string $email)
    {


        $activation_code = $data["activation_code"];

        $this->stmt = $this->conn->prepare("UPDATE $this->table SET activation_code = '$activation_code'  WHERE email = '$email' ");


        if (!$this->stmt->execute()) {
            return false;
        }

        return true;
    }
}
