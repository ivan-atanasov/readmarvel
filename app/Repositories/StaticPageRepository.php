<?php

namespace App\Repositories;

use App\Entities\StaticPage;
use App\Repositories\Contracts\StaticPageRepositoryInterface;
use App\User;

/**
 * Class StaticPageRepository
 * @package App\Repositories
 */
class StaticPageRepository implements StaticPageRepositoryInterface
{
    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all()
    {
        return StaticPage::all();
    }

    /**
     * @param User  $user
     * @param array $data
     *
     * @return \App\Entities\StaticPage
     */
    public function create(User $user, array $data)
    {
        $data['created_by'] = $user->id;

        return StaticPage::create($data);
    }
}
