<?php

namespace App\Http\Controllers\Frontend;
use App\Repositories\StaticPageRepository;
use View;


/**
 * Class StaticPagesController
 * @package App\Http\Controllers\Frontend
 */
class StaticPagesController extends BaseController
{
    /** @var StaticPageRepository */
    protected $staticPageRepository;

    /**
     * StaticPagesController constructor.
     *
     * @param StaticPageRepository $staticPageRepository
     */
    public function __construct(StaticPageRepository $staticPageRepository)
    {
        $this->staticPageRepository = $staticPageRepository;
    }

    /**
     * @param string $urlSlug
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function show(string $urlSlug)
    {
        $page = $this->staticPageRepository->findByUrlSlug($urlSlug);

        return View::make('frontend.static_pages.index')->with('page', $page);
    }
}
