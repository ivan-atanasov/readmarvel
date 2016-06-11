<?php

namespace App\Repositories\Contracts;
use Illuminate\Http\UploadedFile;

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

    /**
     * Updates the avatar for the given user's profile
     *
     * @param int $userId
     * @param UploadedFile $avatar
     *
     * @return mixed
     */
    public function updateAvatar(int $userId, UploadedFile $avatar);
}
