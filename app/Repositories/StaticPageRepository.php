<?php

namespace App\Repositories;

use App\Entities\StaticPage;
use App\Repositories\Contracts\StaticPageRepositoryInterface;
use App\User;
use Cache;

/**
 * Class StaticPageRepository
 * @package App\Repositories
 */
class StaticPageRepository implements StaticPageRepositoryInterface
{
    /**
     * @inheritdoc
     */
    public function all()
    {
        return StaticPage::with(['user'])->get();
    }

    /**
     * @inheritdoc
     */
    public function create(User $user, array $data)
    {
        $data['created_by'] = $data['last_updated_by'] = $user->id;

        return StaticPage::create($data);
    }

    /**
     * @inheritdoc
     */
    public function find(int $id)
    {
        return StaticPage::find($id);
    }

    /**
     * @inheritdoc
     */
    public function update(User $user, int $id, array $data)
    {
        $data['last_updated_by'] = $user->id;

        $page = $this->find($id);

        return $page->update($data);
    }

    /**
     * @inheritdoc
     */
    public function delete(int $id)
    {
        return StaticPage::destroy($id);
    }

    /**
     * @inheritdoc
     */
    public function fundByUrlSlug(string $urlSlug)
    {
        return StaticPage::where('url_slug', '=', $urlSlug)->first();
    }

    /**
     * @inheritdoc
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
