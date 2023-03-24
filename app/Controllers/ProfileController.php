<?php

namespace Surveyplus\App\Controllers;

use Surveyplus\App\Models\Profiles;

class ProfileController
{
    public Profiles $profiles;


    public function __construct()
    {
        $this->profiles = new Profiles();
    }
    



    public function create(array $data)
    {
        $this->profiles->save($data);
        return true;
    }

    

    public function username_exists(string $username){

        $profiles = $this->profiles->find_username($username);

        if(count($profiles) > 0){
            return true;
        }

        return false;
    }


    /**
     * Verify if any active profile already exist
     *
     * @param integer $user_id
     * @return void
     */
    public function active_profiles(int $user_id){
        
        $profiles = $this->profiles->find($user_id, 1);
        
        if(count($profiles) > 0){
            return true;
        }

        return false;
    }


    public function all_active_profiles(int $user_id) : array
    {
        $profiles = $this->profiles->find($user_id, 1);

        foreach($profiles as $profile){
            return $profile;
        }

      return false;
    }

}
