<?php

namespace App\Repositories;


use App\Entities\MarvelList;
use App\Entities\MarvelListItem;
use App\Helpers\ImageHelper;
use App\Helpers\StringHelper;
use App\User;
use App\Repositories\Contracts\MarvelListRepository as MarvelListRepositoryInterface;
use Carbon\Carbon;
use Config;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Class MarvelListRepository
 * @package App\Repositories
 */
class MarvelListRepository implements MarvelListRepositoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function add(array $data)
    {
        $data['hash'] = StringHelper::hash($data['title']);
        $list = MarvelList::create($data);

        if (isset($data['avatar'])) {
            $list->avatar = ImageHelper::crop($data['avatar'], MarvelList::IMAGE_RESOURCE, $list->id);
            $list->save();
        }

        return $list;
    }

    /**
     * {@inheritdoc}
     */
    public function allForUser(User $user, array $except = [])
    {
        return MarvelList::where('user_id', '=', $user->id)
            ->whereNotIn('id', $except)
            ->orderBy('id', 'desc')
            ->get();
    }

    /**
     * {@inheritdoc}
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
     * {@inheritdoc}
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
     * {@inheritdoc}
     */
    public function find(int $id)
    {
        return MarvelList::find($id);
    }

    /**
     * {@inheritdoc}
     */
    public function findByHash(string $hash)
    {
        return MarvelList::where('hash', '=', $hash)->first();
    }

    /**
     * {@inheritdoc}
     */
    public function items(int $id)
    {
        $list = $this->find($id);

        return $list->items;
    }

    /**
     * {@inheritdoc}
     */
    public function updateAvatar(int $id, UploadedFile $avatar)
    {
        $list = $this->find($id);

        $list->avatar = ImageHelper::crop($avatar, MarvelList::IMAGE_RESOURCE, $id);
        $list->save();

        return $list;
    }

    /**
     * {@inheritdoc}
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
     * {@inheritdoc}
     */
    public function deleteItemFromList(int $itemId)
    {
        return MarvelListItem::destroy($itemId);
    }

    /**
     * {@inheritdoc}
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
