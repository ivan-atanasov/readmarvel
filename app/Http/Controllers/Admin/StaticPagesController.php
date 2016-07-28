<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\StaticPageRepository;
use View;

/**
 * Class StaticPagesController
 * @package App\Http\Controllers\Admin
 */
class StaticPagesController extends HomeController
{
    /** @var StaticPageRepository */
    protected $staticPageRepository;

    public function __construct(StaticPageRepository $staticPageRepository)
    {
        $this->staticPageRepository = $staticPageRepository;
    }

    public function index()
    {
        $staticPages = $this->staticPageRepository->all();

        return View::make('admin/static_pages/index');
    }
}
