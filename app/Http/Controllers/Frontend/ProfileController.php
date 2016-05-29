<?php

namespace App\Http\Controllers\Frontend;

use App\Entities\UserProfile;
use App\Helpers\ImageHelper;
use App\Http\Requests\UserProfileRequest;
use App\Repositories\UserProfileRepository;
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

        $avatar = '';
        if (isset($user->profile) && strlen($user->profile->avatar)) {
            $avatar = ImageHelper::path(
                UserProfile::IMAGE_RESOURCE,
                $user->profile->id,
                ImageHelper::MEDIUM,
                $user->profile->avatar
            );
        }

        return View::make('frontend/profile.edit', ['profile' => $user->profile, 'avatar' => $avatar]);
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
}
