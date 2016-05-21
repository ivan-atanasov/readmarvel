<?php

namespace App\Repositories\Contracts;


interface CharactersRepository
{
    /**
     * Lists all available characters
     * 
     * @param int $limit
     * @param int $offset
     *
     * @return mixed
     */
    public function list($limit = 20, $offset = 0);
}
