<?php

namespace App\Http\Controllers\Frontend;

use App\Repositories\MarvelListRepository;
use App\Repositories\SeriesRepository;
use Illuminate\Support\Facades\View;
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

        return View::make('frontend.series', ['series' => $series, 'lists' => $lists]);
    }
}
