<?php

namespace App\Repositories;

use App\Repositories\Contracts\SeriesRepositoryInterface;
use Cache;
use Config;
use GuzzleHttp\Client;

/**
 * Class SeriesRepository
 * @package App\Repositories
 */
class SeriesRepository implements SeriesRepositoryInterface
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
        if (Cache::tags(['series'])->has('homepage_series')) {
            $series = Cache::tags(['series'])->get('homepage_series');
        } else {
            $query = $this->apiClient->getConfig('query');
            $query['offset'] = 0;
            $query['limit'] = $count * 2;

            $response = $this->apiClient->get(
                Config::get('marvel.base_uri') . Config::get('marvel.endpoints.series'),
                ['query' => $query]
            );
            $response = json_decode($response->getBody(), true);
            $series = $response['data']['results'];

            Cache::tags(['series'])->put('homepage_series', $series, Config::get('marvel.cache_time'));
        }

        shuffle($series);

        return array_slice($series, 0, $count);
    }

    /**
     * @param int $id
     *
     * @return array
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
}
