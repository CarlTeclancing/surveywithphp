<?php

namespace Surveyplus\App\Controllers;

use Surveyplus\App\Models\AnswerCategories;

class AnswerCategoryController
{
    public AnswerCategories $answer_categories;


    public function __construct()
    {
        $this->answer_categories = new AnswerCategories();
    }

    /**
     * Get a particular answer category with id  $answer_category_id
     * @param integer answer_category_id
     * @return array An answer category with id answer_category_id
     */
    public function show(int $answer_category_id): array
    {
        return $this->answer_categories->get($answer_category_id);
    }



    public function show_all(int $limit = null): array
    {
        return $this->answer_categories->get(null, $limit);
    }

    

}
