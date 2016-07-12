<?php

namespace App\Http\Controllers\Frontend;


use App\Http\Requests\MarvelListItemRequest;
use App\Http\Requests\MarvelListRequest;
use App\Repositories\MarvelListRepository;
use App\Repositories\SeriesRepository;
use Illuminate\Http\Request;
use View;

/**
 * Class ListController
 * @package App\Http\Controllers\Frontend
 */
class ListController extends BaseController
{
    /** @var MarvelListRepository */
    protected $marvelListRepository;

    /** @var SeriesRepository */
    protected $seriesRepository;

    /**
     * ListController constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->marvelListRepository = new MarvelListRepository($this->client);
        $this->seriesRepository = new SeriesRepository($this->client);
    }

    /**
     * @param MarvelListRequest $marvelListRequest
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(MarvelListRequest $marvelListRequest)
    {
        $data = [
            'user_id' => \Auth::user()->id,
        ];
        $data = array_merge($data, $marvelListRequest->toArray());
        $this->marvelListRepository->add($data);

        \Session::flash('messages', ['success' => \Lang::get('frontend/profile.lists.added_success')]);

        return \Redirect::back();
    }

    /**
     * @param MarvelListItemRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addItemToList(MarvelListItemRequest $request)
    {
        $data = $request->toArray();
        $series = $this->seriesRepository->find($data['series_id']);
        $data['title'] = $series['title'];
        
        $this->marvelListRepository->addItemToList($data);

        return \Redirect::back();
    }

    /**
     * @param MarvelListItemRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateItemInList(MarvelListItemRequest $request)
    {
        $this->marvelListRepository->updateItemInList($request->get('item_id'), $request->toArray());

        return \Redirect::back();
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateListAvatar(Request $request)
    {
        $this->marvelListRepository->updateAvatar($request->get('list_id'), $request->file('avatar'));

        return \Redirect::back();
    }

    /**
     * @param Request $request
     *
     * @return int
     */
    public function deleteItemFromList(Request $request)
    {
        return $this->marvelListRepository->deleteItemFromList($request->get('resourceId'));
    }
}
