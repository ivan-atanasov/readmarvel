<?php

namespace App\Http\Controllers\Frontend;

use App\Repositories\CharactersRepository;
use App\Repositories\ComicRepository;
use App\Repositories\MarvelListRepository;
use App\Repositories\SeriesRepository;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Pagination\LengthAwarePaginator;
use Config;
use View;

/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class HomeController extends BaseController
{
    /** @var Client */
    private $client;

    /** @var SeriesRepository */
    private $seriesRepository;

    /** @var CharactersRepository */
    private $charactersRepository;

    /** @var MarvelListRepository */
    private $marvelListRepository;

    /** HomeController constructor. */
    public function __construct()
    {
        $this->client = $this->initializeApiClient();
        $this->seriesRepository = new SeriesRepository($this->client);
        $this->charactersRepository = new CharactersRepository($this->client);
        $this->marvelListRepository = new MarvelListRepository();
    }

    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $comics = $this->seriesRepository->random(Config::get('homepage.random_comics_limit'));

        return View::make('frontend.index', ['comics' => $comics]);
    }

    /**
     * @param Request $request
     *
     * @return mixed
     */
    public function comics(Request $request)
    {
        $query = '';
        if ($request->has('query')) {
            $offset = $request->has('page') ? $request->input('page') : 0;
            list($comics, $query, $total) = $this->seriesRepository->search(
                $request->input('query'),
                Config::get('homepage.per_page_comics'),
                $offset
            );

            $comics = new LengthAwarePaginator($comics, $total, Config::get('homepage.per_page_comics'));
        } else {
            $comics = $this->seriesRepository->random(Config::get('homepage.random_comics_limit'));
        }

        return View::make('frontend.comics', ['comics' => $comics, 'query' => $query]);
    }

    /**
     * @param int $id
     *
     * @return mixed
     */
    public function comic($id)
    {
        $comic = $this->seriesRepository->comic($id);

        return View::make('frontend.comic', ['comic' => $comic]);
    }
    
    /**
     * @param Request $request
     *
     * @return mixed
     */
    public function characters(Request $request)
    {
        $offset = $request->has('page') ? $request->input('page') : 0;
        list($results, $total) = $this->charactersRepository->list(
            Config::get('homepage.per_page_comics'),
            $offset
        );

        $characters = new LengthAwarePaginator($results, $total, Config::get('homepage.per_page_comics'));

        return View::make('frontend.characters', ['characters' => $characters]);
    }

    /**
     * Connects to the Marvel API
     * @return Client
     */
    private function initializeApiClient()
    {
        $ts = time();
        $hash = md5($ts . Config::get('marvel.private_key') . Config::get('marvel.public_key'));

        return new Client([
            'base_uri' => Config::get('marvel.base_uri'),
            'query'    => [
                'apikey' => Config::get('marvel.public_key'),
                'ts'     => $ts,
                'hash'   => $hash,
            ],
        ]);
    }
}
