<?php

namespace App\Http\Controllers\Frontend;

use App\Repositories\MarvelListRepository;
use View;

/**
 * Class PublicListsController
 * @package App\Http\Controllers\Frontend
 */
class PublicListsController extends BaseController
{
    /** @var MarvelListRepository */
    protected $marvelListRepository;

    /**
     * PublicListsController constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->marvelListRepository = new MarvelListRepository($this->client);
    }

    /**
     * @param string $hash
     *
     * @return $this
     */
    public function show(string $hash)
    {
        $list = $this->marvelListRepository->findByHash($hash);

        return View::make('frontend.lists.list')->with('list', $list);
    }
}
