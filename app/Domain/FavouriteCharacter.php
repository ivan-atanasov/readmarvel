<?php
namespace App\Domain;

use Carbon\Carbon;
use DB;

/**
 * Class Favourite
 * @package App\Domain\Characters
 */
class FavouriteCharacter
{
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
}
