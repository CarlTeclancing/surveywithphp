<?php

namespace Surveyplus\App\Models;


final class Users extends BaseModel 
{
    /** @var string Table name for this model */
    public string $table = "user";


    public function get() 
    {

        $query = "SELECT 
                u.id as userID, 
                u.email as email,
                DATE(u.createdOn) as createdDate, 
                TIME(u.createdOn) as createdTime,
                p.handle as handle,
                p.dob as dateOfBirth,
                g.name as gender
            FROM $this->table u
            JOIN profile p
                ON u.id = p.user_id
            JOIN gender g
                ON p.gender_id = g.id
            WHERE p.isActive = 1
            ORDER BY u.id DESC";

        $users = $this->select($query)->findAll();
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


   /**
    * Get all users or user with an email
    *
    * @param string|null $email
    * @return mixed
    */
    public function find(string $email = null) : mixed
    {
        
        if(isset($email))
        {
            $users = $this->select("SELECT * FROM $this->table WHERE email = '$email'")->findAll();

            foreach($users as $user)
            {
                return $user;
            }
        }
        else{

            $users = $this->select("SELECT * FROM $this->table ORDER BY id DESC'")->findAll();
            return $users;

        }


        return false;

    }



    public function find_all(string $email)
    {
        $users = $this->select("SELECT * FROM $this->table WHERE email = '$email'")->findAll();
        return $users;
    }

    

}  