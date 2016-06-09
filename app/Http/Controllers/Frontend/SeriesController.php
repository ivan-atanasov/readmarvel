<?php

namespace App\Http\Controllers\Frontend;

use App\Repositories\MarvelListRepository;
use App\Repositories\SeriesRepository;
use Illuminate\Support\Facades\View;

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
     * @param SeriesRepository     $seriesRepository
     * @param MarvelListRepository $marvelListRepository
     */
    public function __construct(SeriesRepository $seriesRepository, MarvelListRepository $marvelListRepository)
    {
        $this->seriesRepository = $seriesRepository;
        $this->marvelListRepository = $marvelListRepository;
    }


    /**
     * @param int $id
     *
     * @return mixed
     */
    public function show(int $id)
    {
        $series = $this->seriesRepository->series($id);

        $lists = [];
        if (\Auth::check()) {
            $lists = $this->marvelListRepository->all(\Auth::user());
        }

        return View::make('frontend.series', ['series' => $series, 'lists' => $lists]);
    }
}
