<?php
namespace App\Domain;

use App\Repositories\CharacterRepository;
use Carbon\Carbon;
use DB;
use GuzzleHttp\Client;

/**
 * Class Favourite
 * @package App\Domain\Characters
 */
class FavouriteCharacter
{
    /**
     * @var Client
     */
    private $client;

    /**
     * @return Client
     */
    public function getClient(): Client
    {
        return $this->client;
    }

    /**
     * @param Client $client
     *
     * @return $this
     */
    public function setClient(Client $client)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * @param int $userId
     * @param int $characterId
     *
     * @return bool
     */
    public function favourite(int $userId, int $characterId)
    {
        return DB::table('users_to_characters')->insert([
            'user_id'      => $userId,
            'character_id' => $characterId,
            'created_at'   => Carbon::now(),
            'updated_at'   => Carbon::now(),
        ]);
    }

    /**
     * @param int $userId
     * @param int $characterId
     *
     * @return bool
     */
    public function unfavourite(int $userId, int $characterId)
    {
        return DB::table('users_to_characters')->where('user_id', '=', $userId)
            ->where('character_id', '=', $characterId)
            ->delete();
    }

    /**
     * @param int $userId
     * @param int $characterId
     *
     * @return int
     */
    public function isFavouritedByUser(int $userId, int $characterId)
    {
        return DB::table('users_to_characters')->where('user_id', '=', $userId)
            ->where('character_id', '=', $characterId)
            ->count();
    }

    /**
     * @param int $userId
     *
     * @return array
     */
    public function forUser(int $userId)
    {
        $favouriteCharacters = DB::table('users_to_characters')
            ->where('user_id', '=', $userId)
            ->get(['character_id']);

        $characterRepository = new CharacterRepository($this->getClient());
        $characters = [];
        foreach ($favouriteCharacters as $characterId) {
            $characters[] = $characterRepository->find($characterId->character_id);
        }

        return $characters;
    }
}
