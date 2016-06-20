<?php

namespace app\Repositories\Contracts;

/**
 * Interface SeriesRepositoryInterface
 * @package app\Repositories\Contracts
 */
interface SeriesRepositoryInterface
{
    /**
     * @param int $count
     *
     * @return array
     */
    public function random(int $count);

    /**
     * @param int $id
     *
     * @return array
     */
    public function find($id);

    /**
     * @param string $query
     * @param int    $limit
     * @param int    $offset
     *
     * @return array [comics, search, total]
     */
    public function search(string $query, int $limit = 20, int $offset = 0);
}
