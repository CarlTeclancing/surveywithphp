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

    $linkToVerify = "/" . $link . "/";
    
    if($_SERVER['REQUEST_URI'] != $linkToVerify){
        return false;
    }

    return true;
}



