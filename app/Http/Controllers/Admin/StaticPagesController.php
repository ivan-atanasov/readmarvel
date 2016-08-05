<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\StaticPageRepository;
use Illuminate\Http\Request;
use Redirect;
use View;
use App\Http\Requests\StaticPageRequest;

/**
 * Class StaticPagesController
 * @package App\Http\Controllers
 */
class StaticPagesController extends HomeController
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
     * Display a listing of the resource
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $staticPages = $this->staticPageRepository->all();

        return View::make('admin/static_pages/index')
            ->with('pages', $staticPages);
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return View::make('admin.static_pages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StaticPageRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StaticPageRequest $request)
    {
        $this->staticPageRepository->create(\Auth::user(), $request->toArray());

        return Redirect::route('admin.static.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $page = $this->staticPageRepository->find($id);

        return View::make('admin.static_pages.edit')->with('page', $page);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  StaticPageRequest $request
     * @param  int               $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(StaticPageRequest $request, int $id)
    {
        $this->staticPageRepository->update(\Auth::user(), $id, $request->toArray());

        return Redirect::route('admin.static.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->staticPageRepository->delete($id);

        return Redirect::route('admin.static.index');
    }
}
