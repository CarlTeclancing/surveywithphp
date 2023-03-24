<?php

namespace Surveyplus\App\Models;


final class Genders extends BaseModel 
{

    public string $table = "gender";


    public function get() 
    {
        $genders = $this->select("SELECT *  FROM $this->table ORDER BY id DESC")->findAll();
        return $genders;
    }



}  