<?php

namespace Surveyplus\App\Models;


final class Surveys extends BaseModel 
{

    public string $table = "survey";


    /**
     * Get survey data
     *
     * @param integer|null $survey_id - Get survey wit id
     * @param integer|null $profile_id - Get with user id
     * @param bool|null $published - Get by state
     * @param integer|null $limit - Limit number of items to get
     * 
     * @return array
     */
    public function get(int $survey_id = null, int $profile_id = null, bool $published = null, int $limit = null) : array
    {
        if(isset($published) && isset($profile_id)){

            $is_published = ($published == true) ? $published = 1 : $published = 0;
            
            $surveys = $this->select("SELECT * FROM $this->table WHERE profile_id = $profile_id AND published = $is_published ORDER BY id DESC")->findAll();

            return $surveys; // Return all surveys with user id and check for published state
        }


        if($survey_id != null){

            $surveys = $this->select("SELECT * FROM $this->table WHERE id = $survey_id AND profile_id = $profile_id ORDER BY id DESC")->findAll();

            foreach($surveys as $survey){
                return $survey; // Return single survey incase id paramater is set
            }
        }

        if($profile_id != null && $limit != null)
        {
            $surveys = $this->select("SELECT * FROM $this->table WHERE profile_id = $profile_id ORDER BY id DESC LIMIT $limit")->findAll();
            return $surveys; // Return all surveys with user id limit 
        }

        if($profile_id != null){
            $surveys = $this->select("SELECT * FROM $this->table WHERE profile_id = $profile_id ORDER BY id DESC")->findAll();
            return $surveys; // Return all surveys with user id
        }


        


        $surveys = $this->select("SELECT * FROM $this->table ORDER BY id DESC")->findAll();
        return $surveys;
    }


    /**
     * Get survey and show to the survey taker
     *
     * @param integer $survey_id
     * @param boolean $published
     * @param integer $profile_id
     * @return array|false
     */
    public function get_for_view(int $survey_id, bool $published , int $profile_id) : array | bool
    
    {
        $is_published = ($published == true) ? $published = 1 : $published = 0;
        $surveys = $this->select("SELECT * FROM $this->table WHERE id = $survey_id AND profile_id = $profile_id AND published = $is_published ORDER BY id DESC")->findAll();

        foreach($surveys as $survey){
            return $survey; // Return single survey incase id paramater is set
        }

        return false;
    }


    public function save(array $data)
    {
        
        $this->stmt = $this->conn->prepare("INSERT INTO $this->table (name, description, published, publishedOn, expiresOn, profile_id) VALUES (:name, :description, :published, :publishedOn, :expiresOn, :profile_id)");

        // Bind parameters to prepared indicators
        $this->stmt->bindParam(":name", $data["name"]);
        $this->stmt->bindParam(":description", $data["description"]);
        $this->stmt->bindParam(":published", $data["published"]);
        $this->stmt->bindParam(":publishedOn", $data["publishedOn"]);
        $this->stmt->bindParam(":expiresOn", $data["expiresOn"]);
        $this->stmt->bindParam(":profile_id", $data["profile_id"]);

        if(!$this->stmt->execute())
        {
             return false;
        }

        return true;
    }




    public function update(array $data, int $survey_id)
    {


        $updated_on = $data["updatedOn"];
        $name = $data["name"];
        $description = $data["description"];
        $published = $data["published"];
        $publishedOn = $data["publishedOn"];
        $expiresOn = $data["expiresOn"];
        $profile_id = $data["profile_id"];
        
        $this->stmt = $this->conn->prepare("UPDATE $this->table SET updatedOn = '$updated_on', name = '$name', description = '$description', published = $published, publishedOn = '$publishedOn', expiresOn = '$expiresOn', profile_id = $profile_id WHERE id = $survey_id");


        if(!$this->stmt->execute())
        {
             return false;
        }

        return true;
    }

    

    public function visibility(int $survey_id, int $state)
    {
        $surveys = $this->select("SELECT *  FROM $this->table WHERE id = $survey_id AND published = $state")->findAll();
        
        return $surveys;
    }


    public function delete(int $survey_id)
    {
        $this->stmt = $this->conn->prepare("DELETE FROM $this->table WHERE id = $survey_id");

        if(!$this->stmt->execute())
        {
             return false;
        }
        return true;

    }



}  