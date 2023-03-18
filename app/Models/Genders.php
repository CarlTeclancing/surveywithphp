<?php

namespace Surveyplus\App\Models;


final class Genders extends BaseModel 
{

    public string $table = "gender";


    public function getGenders() 
    {
        $genders = $this->select("SELECT *  FROM $this->table")->findAll();
        return $genders;
    }



}  