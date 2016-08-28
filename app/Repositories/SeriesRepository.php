<?php

namespace App\Repositories;

use Cache;
use Config;
use GuzzleHttp\Client;

/**
 * Class SeriesRepository
 * @package App\Repositories
 */
class SeriesRepository
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
    public function random(int $count)
    {
        if (Cache::tags(['random_series'])->has('homepage_series')) {
            $series = Cache::tags(['random_series'])->get('homepage_series');
        } else {
            $query = $this->apiClient->getConfig('query');
            $query['offset'] = random_int(0, 1000);
            $query['limit'] = $count * 2;

            $response = $this->apiClient->get(
                Config::get('marvel.base_uri') . Config::get('marvel.endpoints.series'),
                ['query' => $query]
            );
            $response = json_decode($response->getBody(), true);
            $series = $response['data']['results'];

            Cache::tags(['random_series'])->put('homepage_series', $series, Config::get('marvel.cache_time'));
        }

        shuffle($series);

        return array_slice($series, 0, $count);
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function find($id)
    {
        if (Cache::tags(['series'])->has('series_' . $id)) {
            $series = Cache::tags(['series'])->get('series_' . $id);
        } else {
            $response = $this->apiClient->get(
                Config::get('marvel.base_uri') . Config::get('marvel.endpoints.series') . '/' . $id
            );
            $response = json_decode($response->getBody(), true);
            $series = $response['data']['results'][0];

            Cache::tags(['series'])->put('series_' . $id, $series, Config::get('marvel.cache_time'));
        }

        return $series;
    }

    /**
     * @param string $query
     * @param int    $limit
     * @param int    $offset
     *
     * @return array
     */
    public function search(string $query, int $limit = 20, int $offset = 0)
    {
        $search = strtolower($query);

//        if (Cache::tags(['search_series'])->has("{$offset}_{$search}")) {
//            $comics = Cache::tags(['search_series'])->get("{$offset}_{$search}");
//            $total = $comics['total'];
//        } else {
            $query = $this->apiClient->getConfig('query');
            $query['offset'] = $offset * $limit;
            $query['titleStartsWith'] = $search;

            $response = $this->apiClient->get(
                Config::get('marvel.base_uri') . Config::get('marvel.endpoints.series'),
                ['query' => $query]
            );
            $response = json_decode($response->getBody(), true);
            $comics = $response['data'];
            $total = $response['data']['total'];

            Cache::tags(['search_series'])->put("{$offset}_{$search}", $comics, Config::get('marvel.cache_time'));
//        }

        return [array_slice($comics['results'], 0, $limit), $search, $total];
    }

    /**
     * @param int $id
     *
     * @return array|static[]
     */
    public function comments(int $id)
    {
        return \DB::table('comments')
            ->join('users', 'users.id', '=', 'comments.user_id')
            ->where('series_id', '=', $id)
            ->orderBy('comments.created_at', 'desc')
            ->get(['users.name', 'users.email', 'comments.comment', 'comments.created_at']);
    }
}
