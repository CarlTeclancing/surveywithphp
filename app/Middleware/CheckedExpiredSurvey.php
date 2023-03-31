<?php

namespace Surveyplus\App\Middleware;

use Surveyplus\App\Controllers\SurveyController as SC;

class CheckExpiredSurvey
{

    protected SC $surveys;


    public function __construct()
    {
        $this->surveys = new SC();
    }

    public static function check()
    {
    
        // IF survey is expired, change state to draft clean expired date, publish date.


    }


    

}