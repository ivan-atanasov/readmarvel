<?php

namespace App\Repositories;

use App\User;
use GuzzleHttp\Client;
use Config;
use Cache;

/**
 * Class CharacterRepository
 * @package App\Repositories
 */
class CharacterRepository
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
        if (Cache::tags(['random_characters'])->has('homepage_characters')) {
            $characters = Cache::tags(['random_characters'])->get('homepage_characters');
        } else {
            $query = $this->apiClient->getConfig('query');
            $query['offset'] = random_int(0, 1000);
            $query['limit'] = $count * 2;

            $response = $this->apiClient->get(
                Config::get('marvel.base_uri') . Config::get('marvel.endpoints.characters'),
                ['query' => $query]
            );
            $response = json_decode($response->getBody(), true);
            $characters = $response['data']['results'];

            Cache::tags(['random_characters'])
                ->put('homepage_characters', $characters, Config::get('marvel.cache_time'));
        }

        shuffle($characters);

        return array_slice($characters, 0, $count);
    }

    /**
     * @param int $id
     *
     * @return mixed
     */
    public function find(int $id)
    {
        if (Cache::tags(['characters'])->has('characters_' . $id)) {
            $characters = Cache::tags(['characters'])->get('characters_' . $id);

            return $characters;
        }

        $response = $this->apiClient->get(
            Config::get('marvel.base_uri') . Config::get('marvel.endpoints.characters') . '/' . $id
        );
        $response = json_decode($response->getBody(), true);
        $characters = $response['data']['results'][0];

        Cache::tags(['characters'])->put('characters_' . $id, $characters, Config::get('marvel.cache_time'));

        return $characters;
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

        if (Cache::tags(['search_characters'])->has("{$offset}_{$search}")) {
            $comics = Cache::tags(['search_characters'])->get("{$offset}_{$search}");
            $total = $comics['total'];
        } else {
            $query = $this->apiClient->getConfig('query');
            $query['offset'] = $offset * $limit;
            $query['nameStartsWith'] = $search;

            $response = $this->apiClient->get(
                Config::get('marvel.base_uri') . Config::get('marvel.endpoints.characters'),
                ['query' => $query]
            );
            $response = json_decode($response->getBody(), true);
            $comics = $response['data'];
            $total = $response['data']['total'];

            Cache::tags(['search_characters'])->put("{$offset}_{$search}", $comics, Config::get('marvel.cache_time'));
        }

        return [array_slice($comics['results'], 0, $limit), $search, $total];
    }

    public function findByUser(User $user)
    {

    }
}
