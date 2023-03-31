<?php

namespace Surveyplus\App\Controllers;

use Surveyplus\App\Models\Answers;

class AnswerController
{
    protected Answers $answers;

    public function  __construct()
    {
        $this->answers = new Answers();
    }


    /**
     * Add answer to the database
     *
     * @param array $data
     * @return int The last Insert ID
     */
    public function create(array $data, int $surveyTaker)
    {
        $insert = $this->answers->save($data, $surveyTaker);

        return $insert;
    }


    public function showAll(int $profileID)
    {
        $answers = $this->answers->getProfileAnswers($profileID);

        if (count($answers) > 0) {
            return $answers;
        }

        return false;
    }


    public function getAnswerStatistics(int $profileID = null)
    {
        $stats = $this->answers->answerStats();

        if (count($stats) > 0) {
            return $stats;
        }

        return false;
    }



    public function getAnswerStatisticsForProfile(int $profileID)
    {
        $stats = $this->answers->profileAnswerStats($profileID);

        if (count($stats) > 0) {
            return $stats;
        }

        return false;
    }
}
