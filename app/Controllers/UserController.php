<?php

namespace Surveyplus\App\Controllers;

use Surveyplus\App\Models\Users;

class UserController 
{
    public Users $users;

    public function __construct()
    {
        $this->users = new Users();
    }

    public function show()
    {
        return $this->users->getUsers();
    }


    public function create(array $data)
    {
        $this->users->save($data);
    }

}