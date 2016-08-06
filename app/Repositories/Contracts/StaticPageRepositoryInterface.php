<?php

namespace App\Repositories\Contracts;


use App\Entities\StaticPage;
use App\User;

interface StaticPageRepositoryInterface
{
    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all();

    /**
     * @param User  $user
     * @param array $data
     *
     * @return \App\Entities\StaticPage
     */
    public function create(User $user, array $data);

    /**
     * @param int $id
     *
     * @return StaticPage
     */
    public function find(int $id);

    /**
     * @param User  $user
     * @param int   $id
     * @param array $data
     *
     * @return bool|int
     */
    public function update(User $user, int $id, array $data);

    /**
     * @param int $id
     *
     * @return int
     */
    public function delete(int $id);

    /**
     * @param string $urlSlug
     *
     * @return mixed
     */
    public function fundByUrlSlug(string $urlSlug);

    /**
     * @return mixed
     */
    public function urlList();
}
