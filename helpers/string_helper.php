<?php


if(!function_exists("minimize")){

    /**
     * Reduces string length if greater than number of characters
     *
     * @param string $str The string
     * @param integer $num_chars Number of characters
     * @return string minimized string
     */
    function minimize(string $str, int $num_chars = 120)
    {   
        if(strlen($str) > $num_chars){     
            return substr($str, 0 , $num_chars) . " ...";
        }

        return $str;
    }

}



if(!function_exists("generateRandomCode"))
{

    function generateRandomCode()
    {
        return bin2hex(random_bytes(16));
    }

}




