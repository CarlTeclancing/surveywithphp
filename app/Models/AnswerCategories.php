<?php

namespace Surveyplus\App\Models;


final class AnswerCategories extends BaseModel 
{

    public string $table = "answer_category";


    public function get(int $answer_category_id = null , int $limit = null) 
    {
        if($answer_category_id != null){

            $answer_categories = $this->select("SELECT *  FROM $this->table WHERE id = $answer_category_id")->findAll();

            foreach($answer_categories as $answer_category ){
                return $answer_category;
            }
            

        }


        if($limit != null)
        {
            $answer_categories = $this->select("SELECT *  FROM $this->table LIMIT $limit")->findAll();
            return $answer_categories;
        }

        $answer_categories = $this->select("SELECT *  FROM $this->table")->findAll();
        return $answer_categories;
    }



}  