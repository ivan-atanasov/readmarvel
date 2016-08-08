<?php

namespace App\Repositories;


use App\Entities\MarvelList;
use App\Entities\MarvelListItem;
use App\Helpers\ImageHelper;
use App\Helpers\StringHelper;
use App\User;
use Carbon\Carbon;
use Config;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Class MarvelListRepository
 * @package App\Repositories
 */
class MarvelListRepository
{
    /**
     * @param array $data
     *
     * @return MarvelList
     */
    public function add(array $data)
    {
        $list = new MarvelList();
        $list->user_id = $data['user_id'];
        $list->title = $data['title'];
        $list->hash = StringHelper::listHash($data['title']);
        $list->comment = $data['comment'];
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
            ->orderBy('id', 'desc')
            ->get();
    }

    /**
     * @param array $data
     *
     * @return MarvelListItem
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
     * @param int   $itemId
     * @param array $data
     *
     * @return mixed
     */
    public function updateItemInList(int $itemId, array $data)
    {
        $data['started_at'] = empty($data['started_at']) ? null :
            Carbon::createFromFormat(Config::get('app.date_format'), $data['started_at']);

        $data['finished_at'] = empty($data['finished_at']) ? null :
            Carbon::createFromFormat(Config::get('app.date_format'), $data['finished_at']);

        $item = $this->item($itemId);
        $data['series_id'] = $item->series_id;

        return $item->update($data);
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
     * @param string $hash
     *
     * @return mixed
     */
    public function findByHash(string $hash)
    {
        return MarvelList::where('hash', '=', $hash)->first();
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
     * @param int          $id
     * @param UploadedFile $avatar
     *
     * @return mixed
     */
    public function updateAvatar(int $id, UploadedFile $avatar)
    {
        $list = $this->find($id);

        $list->avatar = ImageHelper::crop($avatar, MarvelList::IMAGE_RESOURCE, $id);
        $list->save();

        return $list;
    }

    /**
     * @param User $user
     * @param int  $seriesId
     *
     * @return array
     */
    public function listsContainingItemByUser(User $user, int $seriesId)
    {
        $listsContainingItem = [];
        $userItems = $user->listItems();
        if ($userItems->count()) {
            $listsContainingItem = $userItems->where('series_id', '=', $seriesId)->pluck('list_id')->toArray();
        }

        return $listsContainingItem;
    }

    /**
     * @param int $itemId
     *
     * @return int
     */
    public function deleteItemFromList(int $itemId)
    {
        return MarvelListItem::destroy($itemId);
    }

    /**
     * @param int $itemId
     *
     * @return mixed
     */
    public function item(int $itemId)
    {
        return MarvelListItem::find($itemId);
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
