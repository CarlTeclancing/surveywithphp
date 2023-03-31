<?php

namespace Surveyplus\App\Controllers;

use Surveyplus\App\Models\Surveys;

class SurveyController
{

    public Surveys $surveys;

    public function __construct()
    {
        $this->surveys = new Surveys();
    }

    public function show(int $survey_id, int $user_id): array
    {
        return $this->surveys->get($survey_id, $user_id);
    }


    public function show_all(int $user_id, int $limit = null): array
    {
        return $this->surveys->get(null, $user_id, null, $limit);
    }


    public function show_view(int $survey_id, bool $published, int $profile_id): array|bool
    {
        return $this->surveys->get_for_view($survey_id, $published, $profile_id);
    }

    /**
     * Show Users for specific condition
     *
     * @param integer $user_id
     * @param integer|null $published
     * 
     * @return array
     */
    public function show_user_survey(int $profile_id, bool $published = null): array
    {
        return $this->surveys->get(null, $profile_id, $published);
    }


    public function create(array $data)
    {
        if ($this->surveys->save($data)) {
            return true;
        }

        return false;
    }


    // Get survey to modify
    public function edit(int $survey_id, int $profile_id)
    {
        $survey = $this->surveys->get($survey_id, $profile_id);

        return $survey;
    }


    // Modify 
    public function modify(array $data, int $survey_id)
    {
        if ($this->surveys->update($data, $survey_id)) {
            return true;
        }

        return false;
    }


    public function is_published(int $survey_id)
    {
        $published_surveys = $this->surveys->visibility($survey_id, 1);

        if (count($published_surveys) > 0) {
            return true;
        }

        return false;
    }

    public function delete(int $survey_id)
    {
        $delete_survey = $this->surveys->delete($survey_id);

        if ($delete_survey) {
            return true;
        }

        return false;
    }

    public function getSurveyStatistics()
    {

        $stats = $this->surveys->surveyStats();

        if (count($stats) > 0) {
            return $stats;
        }

        return false;
    }



    public function getSurveyStatisticsForProfile(int $profileID)
    {


        $stats = $this->surveys->profileSurveyStats($profileID);

        if (count($stats) > 0) {
            return $stats;
        }


        return false;
    }

    public function showAllPublished(bool $isPublished, array $paginate = null)
    {
        $publishedSurveys = $this->surveys->get(null, null, $isPublished, null, $paginate);

        if (count($publishedSurveys) > 0) {
            return $publishedSurveys;
        }

        return false;
    }


    public function searchAllPublished(bool $isPublished, array $paginate = null, array $search)
    {
        $publishedSurveys = $this->surveys->search($isPublished, $paginate, $search);

        if (count($publishedSurveys) > 0) {
            return $publishedSurveys;
        }

        return false;
    }


    public function updateToDraft(int $surveyID)
    {
        return $this->surveys->updateToDraft($surveyID);
    }



}
