<?php

namespace Surveyplus\App\Middleware;

use Surveyplus\App\Models\Profiles;

final class CheckLoggedInUser
{

    private $profiles;

    public function __construct()
    {
        $this->profiles = new Profiles();
     
    }


    /**
     * Accessible to users only
     *
     * @return redirect Redirect to the login page
     */
    public function userOnly()
    {
        
        if(!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])){

            return header("Location:" . base_url("login.php"));
        }

    }


    public function guestOnly()
    {
        if(isset($_SESSION['user_id']) || !empty($_SESSION['user_id'])){

            return header("Location:" . DASHBOARD_URL);
        }
    }


    /**
     * Create profile incase of no profile
     *
     * @return redirect Redirect to the create profile page
     */
    public function createProfile()
    {
        $numberOfProfiles = count($this->profiles->find_all($_SESSION['user_id']));
        
        // Check if user has any saved profile else let him create a profile
        if($numberOfProfiles == 0){

            return header("Location:" . base_url("create_profile.php"));

        }
    }



}