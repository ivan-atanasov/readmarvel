<?php

namespace App\Repositories;

use App\Entities\StaticPage;
use App\Repositories\Contracts\StaticPageRepositoryInterface;

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
}
