<?php

namespace App\Repositories;


use App\Entities\MarvelList;
use App\Entities\MarvelListItem;
use App\Helpers\ImageHelper;
use App\User;
use App\Repositories\Contracts\MarvelListRepository as MarvelListRepositoryInterface;

class MarvelListRepository implements MarvelListRepositoryInterface
{
    /**
     * @param array $data
     *
     * @return MarvelList
     */
    public function add(array $data)
    {
        $list = new MarvelList($data);
        $list->save();

        if (isset($data['avatar'])) {
            $list->avatar = ImageHelper::crop($data['avatar'], MarvelList::IMAGE_RESOURCE, $list->id);
            $list->save();
        }

        return $list;
    }

    /**
     * @param User $user
     *
     * @return mixed
     */
    public function all(User $user)
    {
        return MarvelList::where('user_id', '=', $user->id)->orderBy('id', 'desc')->get();
    }

    /**
     * @param array $data
     *
     * @return static
     */
    public function addItemToList(array $data)
    {
        return MarvelListItem::create($data);
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
