<?php

namespace Surveyplus\App\Models;


final class Users extends BaseModel 
{
    /** @var string Table name for this model */
    public string $table = "user";


    public function get() 
    {
        $users = $this->select("SELECT *  FROM $this->table")->findAll();
        return $users;
    }


    public function save(array $data)
    {
  
        $this->stmt = $this->conn->prepare("INSERT INTO $this->table (email, password, isAdmin) VALUES (:email, :password, :isAdmin)");

        // Bind parameters to prepared indicators

        $this->stmt->bindParam(":email", $data["email"]);
        $this->stmt->bindParam(":password", $data["password"]);
        $this->stmt->bindParam(":isAdmin", $data["isAdmin"]);


        $this->stmt->execute();
    }

    /** Verify if user with email already exist in database */
    public function find(string $email){
        $users = $this->select("SELECT * FROM $this->table WHERE email = '$email'")->findAll();
        return $users;
    }

    

}  