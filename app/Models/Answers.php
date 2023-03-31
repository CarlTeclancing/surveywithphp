<?php

namespace Surveyplus\App\Models;


class Answers extends BaseModel
{

    public string $table = "answer";




    public function save(array $data, int $surveyTaker)
    {

        $this->stmt = $this->conn->prepare("INSERT INTO $this->table (description, answer_category_id, question_id, survey_taker_id) VALUES (:description, :answer_category_id, :question_id, :survey_taker_id)");

        // Loop through and bind parameters to prepared indicators

        foreach ($data as $key => $value) {

            // count the number of values encpde tje value answer and bind
        
            for($i = 0 ; $i <= count($value) ; $i++)
            {

                $answerToSave = json_encode($value["answer"]);
    
                $this->stmt->bindParam(":description", $answerToSave);
                $this->stmt->bindParam(":answer_category_id", $value["answer_type"]);
                $this->stmt->bindParam(":question_id", $key);
                $this->stmt->bindParam(":survey_taker_id", $surveyTaker);

                // executing here will make it add more than needed
            }
            
            // execute for each existing value bind above
            $execute = $this->stmt->execute();
        }


        if (!$execute) {
            return false;
        }

        $lastID =  $this->conn->lastInsertId();

        return $lastID;
    }


    public function getProfileAnswers(int $profile_id) 
    {
        $answers = $this->select("SELECT  a.id as answer_id, q.id as question_id, s.profile_id as profile  FROM $this->table a JOIN question q ON a.question_id = q.id JOIN survey s ON q.survey_id = s.id WHERE s.profile_id = $profile_id  ORDER BY a.id DESC")->findAll();
        return $answers;
    }


    public function answerStats()
    {
        $answerData = $this->select("SELECT COUNT(id) as answers , MONTHNAME(createdOn) as month FROM $this->table WHERE survey_taker_id IS NOT NULL GROUP BY month ORDER BY id ASC")->findAll(); 
        return $answerData;

    }


    public function profileAnswerStats(int $profile_id) 
    {
        $answers = $this->select("SELECT  COUNT(a.id) as answers, MONTHNAME(a.createdOn) as month FROM $this->table a JOIN question q ON a.question_id = q.id JOIN survey s ON q.survey_id = s.id WHERE s.profile_id = $profile_id GROUP BY month  ORDER BY a.id DESC")->findAll();
        return $answers;
    }



}
