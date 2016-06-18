<?php

namespace App\Http\Controllers\Frontend;

use App\Repositories\MarvelListRepository;
use App\Repositories\SeriesRepository;
use Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Config;
use Auth;

/**
 * Class SeriesController
 * @package App\Http\Controllers
 */
class SeriesController extends BaseController
{
    /** @var SeriesRepository */
    protected $seriesRepository;

    /** @var MarvelListRepository */
    protected $marvelListRepository;

    /**
     * SeriesController constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->seriesRepository = new SeriesRepository($this->client);
        $this->marvelListRepository = new MarvelListRepository($this->client);
    }

    public function list()
    {
        $series = $this->seriesRepository->random(Config::get('homepage.random_comics_limit'));

        return View::make('frontend/series.list', ['series' => $series]);
    }

    /**
     * @param int $id
     *
     * @return mixed
     */
    public function show(int $id)
    {
        $series = $this->seriesRepository->find($id);

        $lists = [];
        if (Auth::check()) {
            $listsContainingItem = $this->marvelListRepository->listsContainingItemByUser(Auth::user(), $id);
            $lists = $this->marvelListRepository->allForUser(Auth::user(), $listsContainingItem);
        }

        return View::make('frontend/series.page', ['series' => $series, 'lists' => $lists]);
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function seriesJson(Request $request)
    {
        $listItem = $this->marvelListRepository->item($request->get('itemId'));
        return Response::json($listItem);
    }
}
