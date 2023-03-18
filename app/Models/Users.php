<?php

namespace Surveyplus\App\Models;


final class Users extends BaseModel 
{

    public string $table = "user";


    public function getUsers() 
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

    

}  