<?php

namespace App\Http\Controllers\Frontend;

use App\Entities\UserProfile;
use App\Helpers\ImageHelper;
use App\Http\Requests\UserProfileRequest;
use App\Repositories\UserProfileRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use View;
use Auth;

class ProfileController extends BaseController
{
    /**
     * @var UserProfileRepository
     */
    protected $userProfileRepository;

    /**
     * ProfileController constructor.
     *
     * @param UserProfileRepository $userProfileRepository
     */
    public function __construct(UserProfileRepository $userProfileRepository)
    {
        $this->userProfileRepository = $userProfileRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $user = Auth::user();

        $avatars = [];
        if (isset($user->profile) && strlen($user->profile->avatar)) {
            $avatars['medium'] = ImageHelper::path(
                UserProfile::IMAGE_RESOURCE,
                $user->id,
                ImageHelper::MEDIUM,
                $user->profile->avatar
            );

            $avatars['large'] = ImageHelper::path(
                UserProfile::IMAGE_RESOURCE,
                $user->id,
                ImageHelper::LARGE,
                $user->profile->avatar
            );
        }

        return View::make('frontend/profile.layout', ['profile' => $user->profile, 'avatar' => $avatars]);
    }

    /**
     * @param UserProfileRequest $request
     *
     * @return mixed
     */
    public function update(UserProfileRequest $request)
    {
        $this->userProfileRepository->updateOrCreate(Auth::user()->id, $request->toArray());

        return Redirect::back();
    }

    /**
     * @param Request $request
     */
    public function updateAvatar(Request $request)
    {
        $this->userProfileRepository->updateAvatar(Auth::user()->id, $request->file('avatar'));

        return Redirect::back();
    }
}
