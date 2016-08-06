<?php

namespace App\Http\ViewComposers;

use App\Repositories\StaticPageRepository;
use Illuminate\View\View;

/**
 * Class FooterComposer
 * @package App\Http\ViewComposers
 */
class FooterComposer
{
    /** @var StaticPageRepository */
    protected $staticPageRepository;

    /**
     * @param  StaticPageRepository $staticPageRepository
     */
    public function __construct(StaticPageRepository $staticPageRepository)
    {
        $this->staticPageRepository = $staticPageRepository;
    }

    /**
     * Bind data to the view.
     *
     * @param  View $view
     *
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('pages', $this->staticPageRepository->urlList());
    }
}
