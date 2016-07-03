<?php

namespace App\Http\Controllers\Frontend;

use App\Repositories\SeriesRepository;
use App\Http\Requests;
use Config;
use View;

/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class HomeController extends BaseController
{
    /** @var SeriesRepository */
    private $seriesRepository;

    /**
     * HomeController constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->seriesRepository = new SeriesRepository($this->client);
    }

    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $comics = $this->seriesRepository->random(Config::get('homepage.random_comics_limit'));

        return View::make('frontend.index', ['comics' => $comics]);
    }
}
