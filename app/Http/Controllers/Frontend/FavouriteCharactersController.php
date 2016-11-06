<?php
namespace App\Http\Controllers\Frontend;

use App\Domain\FavouriteCharacter;
use Illuminate\Http\JsonResponse;
use Auth;

/**
 * Class FavouriteCharactersController
 * @package App\Http\Controllers\Frontend
 */
class FavouriteCharactersController extends BaseController
{
    /**
     * @var FavouriteCharacter
     */
    private $favourite;

    /**
     * FavouriteCharactersController constructor.
     *
     * @param FavouriteCharacter $favourite
     */
    public function __construct(FavouriteCharacter $favourite)
    {
        parent::__construct();

        $this->favourite = $favourite;
    }

    /**
     * @param int $characterId
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function favourite(int $characterId)
    {
        $result = $this->favourite->favourite(Auth::user()->id, $characterId);

        return JsonResponse::create(['isFavourited' => $result]);
    }

    /**
     * @param int $characterId
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function unfavourite(int $characterId)
    {
        $result = $this->favourite->unfavourite(Auth::user()->id, $characterId);

        return JsonResponse::create(['isUnfavourited' => $result]);
    }
}
