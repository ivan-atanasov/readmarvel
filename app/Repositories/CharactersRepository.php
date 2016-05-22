<?php

namespace App\Repositories;

use App\Repositories\Contracts\CharactersRepository as CharactersRepositoryInterface;
use GuzzleHttp\Client;
use Cache;
use Config;

/**
 * Class CharactersRepository
 * @package App\Repositories
 */
class CharactersRepository implements CharactersRepositoryInterface
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
     * @param int $limit
     * @param int $offset
     *
     * @return array
     */
    public function list($limit = 20, $offset = 0)
    {
        if (Cache::has('characters_list')) {
            $characters = Cache::get('characters_list');
            $total = $characters['total'];
        } else {
            $query = $this->apiClient->getConfig('query');
            $query['offset'] = $limit * $offset;
            $query['limit'] = $limit;

            $response = $this->apiClient->get(
                Config::get('marvel.base_uri') . Config::get('marvel.endpoints.characters'),
                ['query' => $query]
            );
            $response = json_decode($response->getBody(), true);
            $characters = $response['data']['results'];
            $total = $response['data']['total'];

            Cache::tags(['characters'])->put('characters_list', $characters, Config::get('marvel.cache_time'));
        }

        return [array_slice($characters, 0, $limit), $total];
    }
}
