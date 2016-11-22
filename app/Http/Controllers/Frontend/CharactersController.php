<?php

namespace App\Http\Controllers\Frontend;

use App\Domain\FavouriteCharacter;
use App\Repositories\CharacterRepository;
use Config;
use Auth;
use View;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Class CharactersController
 * @package Apc\NamespaceCollision\A\Http\Controllers\Frontend
 */
class CharactersController extends BaseController
{
    /** @var CharacterRepository */
    protected $characterRepository;
    /**
     * @var FavouriteCharacter
     */
    private $favouriteCharacter;

    /**
     * CharactersController constructor.
     *
     * @param FavouriteCharacter  $favouriteCharacter
     * @param CharacterRepository $characterRepository
     */
    public function __construct(FavouriteCharacter $favouriteCharacter, CharacterRepository $characterRepository)
    {
        $this->characterRepository = $characterRepository;
        $this->favouriteCharacter = $favouriteCharacter;
    }

    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function list()
    {
        $characters = $this->characterRepository->random(Config::get('homepage.random_characters_limit'));

        return View::make('frontend/characters.list', ['characters' => $characters]);
    }

    /**
     * @param int $id
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function show(int $id)
    {
        $character = $this->characterRepository->find($id);
        $isFavourited = false;
        if (Auth::check()) {
            $isFavourited = $this->favouriteCharacter->isFavouritedByUser(Auth::user()->id, $id);
        }

        return View::make('frontend/characters.page', ['character' => $character, 'isFavourited' => $isFavourited]);
    }

    /**
     * @param Request $request
     *
     * @return mixed
     */
    public function search(Request $request)
    {
        $query = '';
        if ($request->has('query')) {
            $offset = $request->has('page') ? $request->input('page') - 1 : 0;
            list($characters, $query, $total) = $this->characterRepository->search(
                $request->input('query'),
                Config::get('homepage.per_page_comics'),
                $offset
            );

            $characters = new LengthAwarePaginator($characters, $total, Config::get('homepage.per_page_comics'));
        } else {
            $characters = $this->characterRepository->random(Config::get('homepage.random_characters_limit'));
        }

        return View::make('frontend/characters.list', ['characters' => $characters, 'query' => $query]);
    }
}
