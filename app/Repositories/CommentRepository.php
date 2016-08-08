<?php

namespace App\Repositories;

use App\Entities\Comment;

/**
 * Class CommentRepository
 * @package App\Repositories
 */
class CommentRepository
{
    /**
     * @param array $data
     *
     * @return Comment
     */
    public function add(array $data)
    {
        return Comment::create($data);
    }
}
