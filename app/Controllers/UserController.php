<?php

namespace Surveyplus\App\Controllers;

// use Surveyplus\App\Models\Users;
// use Surveyplus\App\Models\Profiles;

use Surveyplus\App\Models\{Users, Profiles};

class UserController
{
    public Users $users;
    public Profiles $profiles;

    public function __construct()
    {
        $this->users = new Users();
        $this->profiles = new Profiles();
    }

    public function show()
    {
        return $this->users->get();
    }


    public function create(array $data)
    {
        // Only save if email count in db is 0
        if (count($this->users->find_all($data['email'])) == 0) {

            $this->users->save($data);
            return true;
        }

        return false;
    }


    public function auth(string $email, string $password)
    {
            $users = $this->users->find_all($email);


           // debug_array($users);

            if (count($users) == 0) {
                return false;
            }

            foreach($users as $user)
            {
                
                $dbUserId = $user['id'];
                $dbEmail = $user['email'];
                $dbPassword = $user['password'];
                $isAdmin = $user['isAdmin'];
                
            }
       
        

        $verifyPassword = password_verify($password, $dbPassword);


        if ($verifyPassword && ($dbEmail == $email)) {

            session_start();
            $_SESSION['user_id'] = $dbUserId;
            $_SESSION['isAdmin'] = $isAdmin;

            // Get users active profile data
            $profiles = $this->profiles->find($dbUserId, 1);

            // Add info to session
            foreach ($profiles as $profile) {
                $_SESSION["profile_id"] = $profile["id"];
                $_SESSION['full_name'] = $profile["first_name"] . " " . $profile["last_name"];
                $_SESSION["handle"] = $profile["handle"];
            }

            return true;
        }



        return false;

        // debug_array($user);    
    }
}
