<?php


/**
 * Return the base url of the site
 * @param string|null $link
 * @return string The base url
 */
function base_url(string $link = null)
{
    return BASE_URL .'/'. strtolower($link);
}


/**
 * Check if the current url has uri
 *
 * @param string $link The uri to verify
 * @return boolean
 */
function url_is(string $link){

    $base_url_segment = BASE_URL_SEGMENT;

    // checks if segment is empty or ""
    /**
     * This constant is empty when using a domain name like surveyplus.com
     * if working on localhost/surveyplus, the base url segment is "surveyplus"
     */
    if(empty($base_url_segment)){

        if(str_contains($link, ".php")){

            $linkToVerify = $link;
    
        }else{
    
            $linkToVerify =  $link . "/";
        }

        
    }else{

        if(str_contains($link, ".php")){
    
            $linkToVerify = "/" . $link;
    
        }else{
    
            $linkToVerify =  "/" . $link . "/";
        }
    }


   
    if($_SERVER['REQUEST_URI'] != $linkToVerify){
        return false;
    }

    return true;
}



if(!function_exists("survey"))
{
    /**
     * Generate a survey link
     *
     * @param string $handle User handle
     * @param integer $survey_id The Survey ID
     * @param string $name  Survey Title
     * @return string
     */
    function survey(string $handle, int $survey_id, string $name, int $profile_id) : string
    {
        $query = http_build_query(["handle" => $handle, "id" => $survey_id, "profile" => $profile_id, "slug" => strtolower(str_replace(" ", "-", $name))]);

        return base_url("survey.php?") . $query;

    }
}


if(!function_exists("paginateSurvey"))
{
    function paginateSurvey(string $handle, int $survey_id, string $name, int $profile_id, int $page)
    {
        $query = http_build_query(["handle" => $handle, "id" => $survey_id, "profile" => $profile_id, "slug" => strtolower(str_replace(" ", "-", $name)),  "page" => $page]);

        return base_url("survey.php?") . $query;
    }
}





