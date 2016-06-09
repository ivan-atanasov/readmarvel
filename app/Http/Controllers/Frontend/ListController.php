<?php

namespace App\Http\Controllers\Frontend;


use App\Http\Requests\MarvelListItemRequest;
use App\Http\Requests\MarvelListRequest;
use App\Repositories\MarvelListRepository;
use Illuminate\Http\Request;

/**
 * Class ListController
 * @package App\Http\Controllers\Frontend
 */
class ListController extends BaseController
{
    /** @var MarvelListRepository */
    protected $marvelListRepository;

    public function __construct(MarvelListRepository $marvelListRepository)
    {
        $this->marvelListRepository = $marvelListRepository;
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
        $data['list_id'] = $request->get('marvel_list');
        $this->marvelListRepository->addItemToList($data);

        return \Redirect::back();
    }
}
