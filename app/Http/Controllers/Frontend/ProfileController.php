<?php

namespace App\Http\Controllers\Frontend;

use App\Entities\MarvelList;
use App\Entities\UserProfile;
use App\Helpers\ImageHelper;
use App\Http\Requests\UserProfileRequest;
use App\Repositories\MarvelListRepository;
use App\Repositories\UserProfileRepository;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use View;
use Auth;

class ProfileController extends BaseController
{
    /** @var UserProfileRepository */
    protected $userProfileRepository;

    /** @var MarvelListRepository */
    protected $marvelListRepository;

    /**
     * ProfileController constructor.
     *
     * @param UserProfileRepository $userProfileRepository
     * @param MarvelListRepository  $marvelListRepository
     */
    public function __construct(
        UserProfileRepository $userProfileRepository,
        MarvelListRepository $marvelListRepository)
    {
        $this->userProfileRepository = $userProfileRepository;
        $this->marvelListRepository = $marvelListRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $user = Auth::user();

        $avatars = [];
        if (isset($user->profile) && strlen($user->profile->avatar)) {
            $avatars = $this->getUserAvatars($user);
        }

        $lists = $this->marvelListRepository->all($user)->toArray();
        $this->getListsAvatars($lists);

        $viewData = [
            'profile' => $user->profile,
            'avatar'  => $avatars,
            'lists'   => $lists,
        ];

        return View::make('frontend/profile.layout', $viewData);
    }

    /**
     * @param UserProfileRequest $request
     *
     * @return mixed
     */
    public function update(UserProfileRequest $request)
    {
        $this->userProfileRepository->updateOrCreate(Auth::user()->id, $request->toArray());

        \Session::flash('messages', ['success' => \Lang::get('frontend/profile.updated_successfully')]);

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

    /**
     * @param User $user
     *
     * @return array
     */
    private function getUserAvatars(User $user)
    {
        return [
            'medium' => ImageHelper::path(
                UserProfile::IMAGE_RESOURCE,
                $user->id,
                ImageHelper::MEDIUM,
                $user->profile->avatar
            ),
            'large'  => ImageHelper::path(
                UserProfile::IMAGE_RESOURCE,
                $user->id,
                ImageHelper::LARGE,
                $user->profile->avatar
            ),
        ];
    }

    /**
     * @param array $lists
     */
    private function getListsAvatars(array &$lists)
    {
        /**
         * @var int   $key
         * @var array $list
         */
        foreach ($lists as $key => $list) {
            $lists[$key]['avatar'] = '';
            $avatar = ImageHelper::path(
                MarvelList::IMAGE_RESOURCE,
                $list['id'],
                ImageHelper::SMALL,
                $list['avatar']
            );

            if (file_exists(public_path() . $avatar)) {
                $lists[$key]['avatar'] = $avatar;
            }
        }
    }
}
