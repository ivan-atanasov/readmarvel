<?php

namespace App\Repositories;

use App\Entities\StaticPage;
use App\User;
use Cache;

/**
 * Class StaticPageRepository
 * @package App\Repositories
 */
class StaticPageRepository
{
    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all()
    {
        return StaticPage::with(['user'])->get();
    }

    /**
     * @param User  $user
     * @param array $data
     *
     * @return StaticPage
     */
    public function create(User $user, array $data)
    {
        if (Cache::tags(['static_pages'])->has('full_url_list')) {
            Cache::tags(['static_pages'])->forget('full_url_list');
        }
        $data['created_by'] = $data['last_updated_by'] = $user->id;

        return StaticPage::create($data);
    }

    /***
     * @param int $id
     *
     * @return mixed
     */
    public function find(int $id)
    {
        return StaticPage::find($id);
    }

    /**
     * @param User  $user
     * @param int   $id
     * @param array $data
     *
     * @return mixed
     */
    public function update(User $user, int $id, array $data)
    {
        if (Cache::tags(['static_pages'])->has('full_url_list')) {
            Cache::tags(['static_pages'])->forget('full_url_list');
        }

        $data['last_updated_by'] = $user->id;

        $page = $this->find($id);

        return $page->update($data);
    }

    /**
     * @param int $id
     *
     * @return int
     */
    public function delete(int $id)
    {
        return StaticPage::destroy($id);
    }

    /**
     * @param string $urlSlug
     *
     * @return mixed
     */
    public function findByUrlSlug(string $urlSlug)
    {
        return StaticPage::where('url_slug', '=', $urlSlug)->first();
    }

    /**
     * @return mixed
     */
    public function urlList()
    {
        if (!Cache::tags(['static_pages'])->has('full_url_list')) {
            $all = StaticPage::get(['id', 'title', 'url_slug']);
            Cache::tags(['static_pages'])->put('full_url_list', $all, \Config::get('marvel.cache_time'));

            return $all;
        }

        return Cache::tags(['static_pages'])->get('full_url_list');
    }
}
