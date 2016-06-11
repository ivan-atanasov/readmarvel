<?php

namespace App\Repositories\Contracts;


use App\Entities\MarvelList;
use App\User;

interface MarvelListRepository
{
    /**
     * @param array $data
     *
     * @return MarvelList
     */
    public function add(array $data);

    /**
     * @param User $user
     *
     * @return mixed
     */
    public function allForUser(User $user);

    /**
     * @return array
     */
    public function defaultLists();
}
