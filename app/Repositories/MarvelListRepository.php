<?php

namespace App\Repositories;


use App\Entities\MarvelList;
use App\User;

class MarvelListRepository
{
    /**
     * @param array $data
     *
     * @return MarvelList
     */
    public function add(array $data)
    {
        $newList = new MarvelList($data);
        $newList->save();

        return $newList;
    }

    /**
     * @param User $user
     *
     * @return mixed
     */
    public function all(User $user)
    {
        return MarvelList::where('user_id', '=', $user->id)->get();
    }

    /**
     * @return array
     */
    public function defaultLists()
    {
        // @TODO change this with call to the db
        return [
            [
                'title'   => 'I have read...',
                'comment' => 'All comic books that you have read in the past',
                'avatar'  => '',
            ],
            [
                'title'   => 'I will read...',
                'comment' => 'All comic books that you plan on reading in the future',
                'avatar'  => '',
            ],
            [
                'title'   => 'I am reading...',
                'comment' => 'All comic books that you are currently reading',
                'avatar'  => '',
            ],
            [
                'title'   => 'I started but dropped...',
                'comment' => 'All comic books that you started reading, but you dropped for some reason',
                'avatar'  => '',
            ],
        ];
    }
}
