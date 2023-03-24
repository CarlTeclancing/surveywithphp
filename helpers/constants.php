<?php

/** @var BASE_PATH The root absolute path of this project*/
define("BASE_PATH", dirname(__DIR__, 1));

/** @var BASE_URL The base url of this project */
define("BASE_URL", "http://localhost/surveyplus-php-main");

/** @var BASE_URL_SEGMENT The base url path. Online this can be set to "" */
define("BASE_URL_SEGMENT", "surveyplus-php-main");

/** @var DASHBOARD_URL The dashboard url of this project */
define("DASHBOARD_URL", BASE_URL . "/dashboard");

/** @var DASHBOARD_PATH The dashboard absolute path of this project */
define("DASHBOARD_PATH", BASE_PATH . "/dashboard");

/** @var APP_PATH The path to the app folder of this project */
const APP_PATH = BASE_PATH . "/app";
