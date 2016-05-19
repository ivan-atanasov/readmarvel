<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use Cache;
use Config;
use GuzzleHttp\Client;
use App\Repositories\Contracts\ComicRepository as ComicRepositoryInterface;

/**
 * Class ComicRepository
 * @package App\Repositories
 */
class ComicRepository implements ComicRepositoryInterface
{
    /**
     * @var Client
     */
    protected $apiClient;

    /**
     * ComicRepository constructor.
     *
     * @param $apiClient
     */
    public function __construct(Client $apiClient)
    {
        $this->apiClient = $apiClient;
    }

    /**
     * @param int $count
     *
     * @return array
     */
    public function random($count = 10)
    {
        if (Cache::has('comics')) {
            $comics = Cache::get('comics');
        } else {
            $query = $this->apiClient->getConfig('query');
            $query['offset'] = 0;
            $query['limit'] = $count * 2;

            $response = $this->apiClient->get(
                Config::get('marvel.base_uri') . Config::get('marvel.endpoints.comics'),
                ['query' => $query]
            );
            $response = json_decode($response->getBody(), true);
            $comics = $response['data']['results'];

            Cache::put('comics', $comics, Config::get('marvel.cache_time'));
        }

        shuffle($comics);

        return array_slice($comics, 0, $count);
    }

    /**
     * @param string  $query
     * @param         $limit
     * @param         $offset
     *
     * @return array [comics, search, total]
     */
    public function search($query, $limit = 20, $offset = 0)
    {
        $search = strtolower($query);

        if (Cache::has("search_{$offset}_{$search}")) {
            $comics = Cache::get("search_{$offset}_{$search}");
            $total = $comics['total'];
        } else {
            $query = $this->apiClient->getConfig('query');
            $query['offset'] = (int)$offset * $limit;
            $query['titleStartsWith'] = $search;

            $response = $this->apiClient->get(
                Config::get('marvel.base_uri') . Config::get('marvel.endpoints.comics'),
                ['query' => $query]
            );
            $response = json_decode($response->getBody(), true);
            $comics = $response['data'];
            $total = $response['data']['total'];

            Cache::put("search_{$offset}_{$search}", $comics, Config::get('marvel.cache_time'));
        }

        return [array_slice($comics['results'], 0, $limit), $search, $total];
    }
}
