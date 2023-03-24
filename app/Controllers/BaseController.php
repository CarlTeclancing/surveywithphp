<?php

namespace Surveyplus\App\Controllers;

abstract class BaseController
{
    /**
     * Show single data with id
     *
     * @return array
     */
    abstract public function show(int $id) : array;


    /**
     * Show all data
     *
     * @return array
     */
    abstract public function show_all() : array;

}