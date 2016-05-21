<?php

namespace App\Http\Controllers;

use App\Repositories\ComicRepository;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Cache;
use Config;
use View;

/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class HomeController extends Controller
{
    /** @var Client */
    private $client;

    /** @var ComicRepository */
    private $comicRepository;

    /** HomeController constructor. */
    public function __construct()
    {
        $ts = time();
        $hash = md5($ts . Config::get('marvel.private_key') . Config::get('marvel.public_key'));

        $this->client = new Client([
            'base_uri' => Config::get('marvel.base_uri'),
            'query'    => [
                'apikey' => Config::get('marvel.public_key'),
                'ts'     => $ts,
                'hash'   => $hash,
            ],
        ]);

        $this->comicRepository = new ComicRepository($this->client);
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
            list($comics, $query, $total) = $this->comicRepository->search(
                $request->input('query'),
                Config::get('homepage.per_page_comics'),
                $offset
            );

            $comics = new LengthAwarePaginator($comics, $total, Config::get('homepage.per_page_comics'));
        } else {
            $comics = $this->comicRepository->random(Config::get('homepage.random_comics_limit'));
        }

        return View::make('client.comics', ['comics' => $comics, 'query' => $query]);
    }

    /**
     * @param int $id
     *
     * @return mixed
     */
    public function comic($id)
    {
        $comic = $this->comicRepository->comic($id);

        return View::make('client.comic', $comic);
    }

    /**
     * @param Request $request
     *
     * @return mixed
     */
    public function characters(Request $request)
    {
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        if (is_null($currentPage)) {
            $currentPage = 1;
        }

        $characters = Cache::get('characters');
        $characters_collection = new Collection($characters);

        $items_per_page = 8;

        $current_page_results = $characters_collection
            ->slice(($currentPage - 1) * $items_per_page, $items_per_page)
            ->all();

        $paginatedResults = new LengthAwarePaginator(
            $current_page_results,
            count($characters_collection),
            $items_per_page
        );

        return view('client.characters', ['paginated_results' => $paginatedResults, 'characters' => $characters]);
    }
}
