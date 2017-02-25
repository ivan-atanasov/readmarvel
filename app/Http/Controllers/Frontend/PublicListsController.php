<?php

namespace App\Http\Controllers\Frontend;

use App\Entities\MarvelList;
use App\Helpers\ImageHelper;
use App\Repositories\MarvelListRepository;
use View;

/**
 * Class PublicListsController
 * @package App\Http\Controllers\Frontend
 */
class PublicListsController extends BaseController
{
    /** @var MarvelListRepository */
    protected $marvelListRepository;

    /**
     * PublicListsController constructor.
     *
     * @param MarvelListRepository $marvelListRepository
     */
    public function __construct(MarvelListRepository $marvelListRepository)
    {
        $this->marvelListRepository = $marvelListRepository;
    }

    /**
     * @param string $hash
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function show(string $hash)
    {
        $list = [$this->marvelListRepository->findByHash($hash)];
        $this->getListsAvatars($list);
        $list = array_pop($list);

        $items = $this->marvelListRepository->items($list->id);

        return View::make('frontend.lists.list')
            ->with('items', $items)
            ->with('list', $list)
            ->with('public', true);
    }

    /**
     * @param array $lists
     */
    private function getListsAvatars(array &$lists)
    {
        /**
         * @var int   $key
         * @var array $list
         */
        foreach ($lists as $key => $list) {
            $avatar = ImageHelper::path(
                MarvelList::IMAGE_RESOURCE,
                $list['id'],
                ImageHelper::SMALL,
                $list['avatar']
            );

            if (file_exists(public_path() . $avatar)) {
                $lists[$key]['avatar'] = $avatar;
            }
        }
    }
}
