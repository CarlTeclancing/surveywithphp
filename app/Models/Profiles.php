<?php

namespace Surveyplus\App\Models;

class Profiles extends BaseModel
{
    /** @var string Table name for this model */
    public string $table = "profile";


    /**
     *Find all profiles with user id
     *
     * @param integer $userId
     * @return array An array of profiles found
     */
    public function find_all(int $userId)
    {
        $profiles = $this->select("SELECT * FROM $this->table WHERE user_id = $userId ORDER BY id DESC")->findAll();
        return $profiles;
    }

    /**
     * Find active or inactive profiles with user id
     *
     * @param integer $userId
     * @param integer $state 1 for active and 0 for inactive
     * @return array An array of profiles
     */
    public function find(int $userId, int $state)
    {
        $profiles = $this->select("SELECT * FROM $this->table WHERE user_id = $userId AND isActive = $state")->findAll();
        return $profiles;
    }

    /**
     * Save a profile
     *
     * @param array $data
     * @return void
     */
    public function save(array $data)
    {

        $this->stmt = $this->conn->prepare("INSERT INTO $this->table (first_name, last_name, username, dob, handle, signature, isActive, user_id, role_id, gender_id) VALUES (:first_name, :last_name, :username, :dob, :handle, :signature, :isActive, :user_id, :role_id, :gender_id)");

        // Bind parameters to prepared indicators

        $this->stmt->bindParam(":first_name", $data["first_name"]);
        $this->stmt->bindParam(":last_name", $data["last_name"]);
        $this->stmt->bindParam(":username", $data["username"]);
        $this->stmt->bindParam(":dob", $data["dob"]);
        $this->stmt->bindParam(":handle", $data["handle"]);
        $this->stmt->bindParam(":signature", $data["signature"]);
        $this->stmt->bindParam(":isActive", $data["isActive"]);
        $this->stmt->bindParam(":user_id", $data["user_id"]);
        $this->stmt->bindParam(":role_id", $data["role_id"]);
        $this->stmt->bindParam(":gender_id", $data["gender_id"]);


        $this->stmt->execute();
    }


    /**
     * Find a username in database
     *
     * @param string $username
     * @return array An array of profiles found
     */
    public function find_username(string $username)
    {

        $profiles = $this->select("SELECT * FROM $this->table WHERE username = '$username' ORDER BY id DESC")->findAll();
        return $profiles;
    }
}
