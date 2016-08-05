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
     * @inheritdoc
     */
    public function all()
    {
        return StaticPage::all();
    }

    /**
     * @inheritdoc
     */
    public function create(User $user, array $data)
    {
        $data['created_by'] = $data['last_updated_by'] =$user->id;

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
}
