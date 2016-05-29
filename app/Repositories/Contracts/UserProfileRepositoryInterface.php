<?php

namespace App\Repositories\Contracts;

/**
 * Interface UserProfileRepositoryInterface
 * @package App\Repositories\Contracts
 */
interface UserProfileRepositoryInterface
{
    /**
     * Returns the profile for the given user id
     *
     * @param int $userId
     *
     * @return mixed
     */
    public function find(int $userId);

    /**
     * If the given user already has a profile in the profiles table it is updated
     * Otherwise the profile is created
     *
     * @param int   $userId
     * @param array $data
     *
     * @return mixed
     */
    public function updateOrCreate(int $userId, array $data);
}
