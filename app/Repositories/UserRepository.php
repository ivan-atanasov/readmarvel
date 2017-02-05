<?php

namespace App\Repositories;


use App\User;

class UserRepository
{
    public function all()
    {
        return User::get();
    }
}
