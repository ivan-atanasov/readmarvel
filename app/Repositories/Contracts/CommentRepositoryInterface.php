<?php

namespace App\Repositories\Contracts;


/**
 * Interface CommentRepository
 * @package App\Repositories\Contracts
 */
interface CommentRepositoryInterface
{
    /**
     * @param array $data
     *
     * @return mixed
     */
    public function add(array $data);
}
