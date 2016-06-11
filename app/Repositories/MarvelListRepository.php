<?php

namespace App\Repositories;


use App\Entities\MarvelList;
use App\Entities\MarvelListItem;
use App\Helpers\ImageHelper;
use App\User;
use App\Repositories\Contracts\MarvelListRepository as MarvelListRepositoryInterface;
use Carbon\Carbon;
use Config;

/**
 * Class MarvelListRepository
 * @package App\Repositories
 */
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
     * @param User  $user
     * @param array $except
     *
     * @return mixed
     */
    public function allForUser(User $user, array $except = [])
    {
        return MarvelList::where('user_id', '=', $user->id)
            ->whereNotIn('id', $except)
            ->orderBy('id', 'desc')->get();
    }

    /**
     * @param array $data
     *
     * @return static
     */
    public function addItemToList(array $data)
    {
        $data['started_at'] = empty($data['started_at']) ? null :
            Carbon::createFromFormat(Config::get('app.date_format'), $data['started_at']);

        $data['finished_at'] = empty($data['finished_at']) ? null :
            Carbon::createFromFormat(Config::get('app.date_format'), $data['finished_at']);

        return MarvelListItem::create($data);
    }

    /**
     * @param int $id
     *
     * @return mixed
     */
    public function find(int $id)
    {
        return MarvelList::find($id);
    }

    /**
     * @param int $id
     *
     * @return mixed
     */
    public function items(int $id)
    {
        $list = $this->find($id);

        return $list->items;
    }

    /**
     * @param int $id
     * @param     $avatar
     *
     * @return mixed
     */
    public function updateAvatar(int $id, $avatar)
    {
        $list = $this->find($id);

        $list->avatar = ImageHelper::crop($avatar, MarvelList::IMAGE_RESOURCE, $id);
        $list->save();

        return $list;
    }


    /**
     * @param User $user
     * @param int  $itemId
     *
     * @return array
     */
    public function listsContainingItemByUser(User $user, int $itemId)
    {
        $listsContainingItem = [];
        $userItems = $user->listItems();
        if ($userItems->count()) {
            $listsContainingItem = $userItems->where('series_id', '=', $itemId)->pluck('list_id')->toArray();
        }

        return $listsContainingItem;
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
            ],
            [
                'title'   => 'I will read...',
                'comment' => 'All comic books that you plan on reading in the future',
            ],
            [
                'title'   => 'I am reading...',
                'comment' => 'All comic books that you are currently reading',
            ],
            [
                'title'   => 'I started but dropped...',
                'comment' => 'All comic books that you started reading, but you dropped for some reason',
            ],
        ];
    }
}
