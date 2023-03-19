<?php

namespace Surveyplus\App\Controllers;

abstract class BaseController
{
    /**
     * Show data
     *
     * @return array
     */
    abstract public function show() : array;

}