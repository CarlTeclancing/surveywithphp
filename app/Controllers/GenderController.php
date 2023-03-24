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
     * Get a particular gender with id
     * @param integer $gender_id
     * @return array Gender with $gender_id
     */
    public function show(int $gender_id): array
    {
        return $this->genders->get($gender_id);
    }


    public function show_all(): array
    {
        return $this->genders->get();
    }

    

}
