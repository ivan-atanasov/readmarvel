<?php

namespace App\Repositories\Contracts;

/**
 * Interface ComicRepository
 * @package App\Repositories\Contracts
 */
interface ComicRepository
{
    /**
     * @param int $count
     *
     * @return mixed
     */
    public function random($count = 10);

    /**
     * @param string  $query
     * @param         $limit
     * @param int     $offset
     *
     * @return mixed
     */
    public function search($query, $limit = 20, $offset = 0);

    /**
     * @param int $id
     *
     * @return mixed
     */
    public function comic($id);
}
