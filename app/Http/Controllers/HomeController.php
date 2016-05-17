<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Cache;

/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class HomeController extends Controller
{
    /**
     * @var Client
     */
    private $client;

    /**
     * HomeController constructor.
     */
    public function __construct()
    {
        $ts = time();
        $hash = md5($ts . config('marvel.private_key') . config('marvel.public_key'));

        $this->client = new Client([
            'base_uri' => config('marvel.base_uri'),
            'query'    => [
                'apikey' => config('marvel.public_key'),
                'ts'     => $ts,
                'hash'   => $hash,
            ],
        ]);
    }

    /**
     * @param Request $request
     *
     * @return mixed
     */
    public function comics(Request $request)
    {
        $searchTerm = '';
        if ($request->has('query')) {

            $searchTerm = $request->input('query');

            $query = $this->client->getConfig('query');
            $query['titleStartsWith'] = $searchTerm;

            $response = $this->client->get('comics', ['query' => $query]);
            $response = json_decode($response->getBody(), true);

            $comics = $response['data']['results'];
        } else {
            $comics = Cache::get('comics');
            shuffle($comics);
            $comics = array_slice($comics, 0, 20);
        }

        return view('client.comics', ['comics' => $comics, 'query' => $searchTerm]);

    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function comic($id)
    {
        $pageData = [];

        $response = $this->client->get('comics/' . $id);
        $response = json_decode($response->getBody(), true);

        $comic = $response['data']['results'][0];
        $pageData['comic'] = $comic;

        if (!empty($comic['series'])) {

            $series_response = $this->client->get($comic['series']['resourceURI']);
            $series_response = json_decode($series_response->getBody(), true);

            $pageData['series'] = $series_response['data']['results'][0];
        }

        return view('client.comic', $pageData);
    }

    /**
     * @param Request $request
     *
     * @return mixed
     */
    public function characters(Request $request)
    {
        $characters = Cache::get('characters');

        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        if (is_null($currentPage)) {
            $currentPage = 1;
        }

        $characters_collection = new Collection($characters);

        $items_per_page = 8;

        $current_page_results = $characters_collection
            ->slice(($currentPage - 1) * $items_per_page, $items_per_page)
            ->all();

        $paginated_results = new LengthAwarePaginator(
            $current_page_results,
            count($characters_collection),
            $items_per_page
        );

        return view('client.characters', ['paginated_results' => $paginated_results, 'characters' => $characters]);

    }
}
