<?php

namespace Surveyplus\App\Controllers;

use Surveyplus\App\Models\Questions;

class QuestionController 
{
    public Questions $questions;


    public function __construct()
    {
        $this->questions = new Questions();
    }

    /**
     * Get a particular question in he database
     * @param integer $question_id
     * @return array A question qith id question_id
     */
    public function show(int $question_id, int $profile_id): array
    {
        return $this->questions->get($question_id, $profile_id);
    }



    public function show_all(int $profile_id): array
    {
        return $this->questions->get(null, $profile_id);
    }


    public function show_survey_question(int $profile_id) : array
    {
        return $this->questions->join($profile_id);
    }

    public function show_survey_single_question(int $profile_id, int $survey_id) : array
    {
        return $this->questions->join($profile_id, $survey_id);
    }


    public function create(array $data)
    {
        if($this->questions->save($data)){
            return true;
        }

        return false;
    }


    public function modify(array $data, int $question_id) : bool
    {
        if($this->questions->update($data, $question_id)){
            return true;
        }

        return false;
    }

    
    public function delete(int $question_id)
    {
        $delete_question= $this->questions->delete($question_id);

        if($delete_question){
            return true;
        }

        return false;
    }
}
