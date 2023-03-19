<?php

namespace Surveyplus\App\Controllers;

use Surveyplus\App\Models\Genders;

class GenderController extends BaseController
{
    public Genders $genders;


    public function __construct()
    {
        $this->genders = new Genders();
    }

    /**
     * Get all existing genders in database
     *
     * @return array All genders
     */
    public function show(): array
    {
        return $this->genders->get();
    }

    

}
