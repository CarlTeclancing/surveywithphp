<?php

namespace Surveyplus\App\Config;
use Surveyplus\App\Config\DevEnv;

class App
{

   protected DevEnv $env;

    // You can set the following in the env file

    /** @var string $baseUrl The base url of the website */
    private static string $baseUrl = "http://localhost/surveyplusweb";


    /** @var string $baseUrlSegment The segment directly after the base url */
    private static string $baseUrlSegment = "surveyplusweb";


    /** @var string $senderEmail Email Indicated as sender when emails are sent */
    private static string $senderEmail = "no-reply@rabbitmaid.com";


    /**
     * Loads ENV variables in file that calls it
     *
     * @param string $path
     * @return void
     */
    public function loadEnv(string $path)
    {
        $env = new DevEnv($path);
        $env->load();
    }

    // Prioritize the variables saved in env file
    public static function getBaseUrl()
    {
        if(array_key_exists("BASE_URL", $_SERVER)){

            return getenv("BASE_URL");
        }

        return self::$baseUrl;
    }


    public static function getBaseUrlSegment()
    {

        if(array_key_exists("BASE_URL_SEGMENT", $_SERVER)){

            return getenv("BASE_URL_SEGMENT");
        }

        return self::$baseUrlSegment;
    }


    public static function getSenderEmail()
    {
        if(array_key_exists("SENDER_EMAIL", $_SERVER)){

            return getenv("SENDER_EMAIL");
        }

        return self::$senderEmail;
    }
    



}
