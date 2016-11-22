<?php

namespace App\Repositories;


use App\Entities\UserProfile;
use App\Helpers\ImageHelper;
use App\User;
use Illuminate\Http\UploadedFile;

/**
 * Class UserProfileRepository
 * @package App\Repositories
 */
class UserProfileRepository
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
        $profile->real_name = trim($data['real_name']);
        $profile->about_me = $data['about_me'];
        $profile->save();

        if (isset($data['avatar'])) {
            $profile->avatar = ImageHelper::crop($data['avatar'], UserProfile::IMAGE_RESOURCE, $userId);
        }

        return $profile->save();
    }

    /**
     * @param int          $userId
     * @param UploadedFile $avatar
     *
     * @return UserProfile|mixed
     */
    public function updateAvatar(int $userId, UploadedFile $avatar)
    {
        $profile = $this->find($userId);

        if (!isset($profile)) {
            $profile = new UserProfile(['user_id' => $userId]);
        }

        $profile->avatar = ImageHelper::crop($avatar, UserProfile::IMAGE_RESOURCE, $userId);
        $profile->save();

        return $profile;
    }

    /**
     * @param User   $user
     * @param string $newPassword
     *
     * @return bool
     */
    public function updatePassword(User $user, string $newPassword)
    {
        $user->password = \Hash::make($newPassword);
        return $user->save();
    }

    /**
     * @param string $nickname
     *
     * @return mixed
     */
    public function findByNickname(string $nickname)
    {
        return User::where('nickname', '=', $nickname)->first();
    }
}
