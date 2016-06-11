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
}
