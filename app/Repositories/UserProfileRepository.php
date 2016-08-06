<?php

namespace App\Repositories;


use App\Entities\UserProfile;
use App\Helpers\ImageHelper;
use App\Repositories\Contracts\UserProfileRepositoryInterface;
use App\User;
use Illuminate\Http\UploadedFile;

/**
 * Class UserProfileRepository
 * @package App\Repositories
 */
class UserProfileRepository implements UserProfileRepositoryInterface
{
    /**
     * @inheritdoc
     */
    public function find(int $userId)
    {
        return UserProfile::where('user_id', '=', $userId)->first();
    }

    /**
     * @inheritdoc
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
     * @inheritdoc
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
     * @inheritdoc
     */
    public function updatePassword(User $user, string $newPassword)
    {
        $user = \Auth::user();
        $user->password = \Hash::make($newPassword);
        return $user->save();
    }
}
