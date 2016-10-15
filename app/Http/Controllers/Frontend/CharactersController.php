<?php

namespace App\Http\Controllers\Frontend;

use App\Repositories\CharacterRepository;
use Config;
use View;

/**
 * Class CharactersController
 * @package Apc\NamespaceCollision\A\Http\Controllers\Frontend
 */
class CharactersController extends BaseController
{
    /** @var CharacterRepository */
    protected $characterRepository;

    /**
     * SeriesController constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->characterRepository = new CharacterRepository($this->client);
    }

    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function list()
    {
        $characters = $this->characterRepository->random(Config::get('homepage.random_characters_limit'));

        return View::make('frontend/characters.list', ['characters' => $characters]);
    }
}
