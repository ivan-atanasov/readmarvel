<?php

namespace App\Repositories;

use App\Entities\Comment;
use App\Repositories\Contracts\CommentRepositoryInterface;

/**
 * Class CommentRepository
 * @package App\Repositories
 */
class CommentRepository implements CommentRepositoryInterface
{
    /**
     * @param array $data
     *
     * @return static
     */
    public function add(array $data)
    {
        return Comment::create($data);
    }
}
