<?php

namespace App\Http\Controllers\Frontend;

use App\Repositories\MarvelListRepository;
use App\Repositories\SeriesRepository;
use Illuminate\Pagination\LengthAwarePaginator;
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
     *
     * @param MarvelListRepository $marvelListRepository
     * @param SeriesRepository     $seriesRepository
     */
    public function __construct(MarvelListRepository $marvelListRepository, SeriesRepository $seriesRepository)
    {
        $this->seriesRepository = $seriesRepository;
        $this->marvelListRepository = $marvelListRepository;
    }

    /**
     * @return mixed
     */
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
        
        $comments = $this->seriesRepository->comments($id);

        return View::make(
            'frontend/series.page', 
            ['series' => $series, 'lists' => $lists, 'comments' => $comments]);
    }

    /**
     * @param Request $request
     *
     * @return mixed
     */
    public function search(Request $request)
    {
        $query = '';
        if ($request->has('query')) {
            $offset = $request->has('page') ? $request->input('page') - 1 : 0;
            list($series, $query, $total) = $this->seriesRepository->search(
                $request->input('query'),
                Config::get('homepage.per_page_comics'),
                $offset
            );

            $series = new LengthAwarePaginator($series, $total, Config::get('homepage.per_page_comics'));
        } else {
            $series = $this->seriesRepository->random(Config::get('homepage.random_comics_limit'));
        }

        return View::make('frontend/series.list', ['series' => $series, 'query' => $query]);
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
