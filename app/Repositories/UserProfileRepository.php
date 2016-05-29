<?php

namespace App\Repositories;


use App\Entities\UserProfile;
use App\Helpers\ImageHelper;
use App\Repositories\Contracts\UserProfileRepositoryInterface;

/**
 * Class UserProfileRepository
 * @package App\Repositories
 */
class UserProfileRepository implements UserProfileRepositoryInterface
{
    /**
     * @param int $userId
     *
     * @return mixed
     */
    public function find(int $userId)
    {
        return UserProfile::where('user_id', '=', $userId)->first();
    }

    /**
     * @param int   $userId
     * @param array $data
     *
     * @return bool
     */
    public function updateOrCreate(int $userId, array $data)
    {
        $profile = $this->find($userId);

        if (!isset($profile)) {
            $profile = new UserProfile();
        }

        $profile->user_id = $userId;
        $profile->real_name = $data['real_name'];
        $profile->about_me = $data['about_me'];
        $profile->save();

        if (isset($data['avatar'])) {
            $profile->avatar = ImageHelper::crop($data['avatar'], UserProfile::IMAGE_RESOURCE, $profile->id);
        }

        return $profile->save();
    }
}
