<?php

namespace App\Repositories;

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
    /** @var Client */
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
        if (Cache::has('homepage_comics')) {
            $comics = Cache::get('homepage_comics');
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

            Cache::tags(['comics'])->put('homepage_comics', $comics, Config::get('marvel.cache_time'));
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

            Cache::tags(['comics'])->put("search_{$offset}_{$search}", $comics, Config::get('marvel.cache_time'));
        }

        return [array_slice($comics['results'], 0, $limit), $search, $total];
    }

    /**
     * @param int $id
     *
     * @return mixed
     */
    public function comic($id)
    {
        if (Cache::has('comic_' . $id)) {
            $data = Cache::get('comic_' . $id);
        } else {
            $response = $this->apiClient->get(
                Config::get('marvel.base_uri') . Config::get('marvel.endpoints.comics') . '/' . $id
            );
            $response = json_decode($response->getBody(), true);

            $comic = $response['data']['results'][0];
            $data['comic'] = $comic;

            if (!empty($comic['series'])) {
                $series = $this->apiClient->get($comic['series']['resourceURI']);
                $series = json_decode($series->getBody(), true);

                $data['series'] = $series['data']['results'][0];
            }

            Cache::tags(['comics'])->put('comic_' . $id, $data, Config::get('marvel.cache_time'));
        }

        return $data;
    }
}
