<?php

namespace App\Repositories;

use App\User;
use Illuminate\Database\Eloquent\Collection;

class UserRepository
{
    /**
     * @return Collection
     */
    public function all()
    {
        return User::get();
    }
}
