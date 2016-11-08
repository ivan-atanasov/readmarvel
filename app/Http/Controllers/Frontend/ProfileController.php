<?php

namespace App\Http\Controllers\Frontend;

use App\Domain\FavouriteCharacter;
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

/**
 * Class ProfileController
 * @package App\Http\Controllers\Frontend
 */
class ProfileController extends BaseController
{
    /** @var UserProfileRepository */
    protected $userProfileRepository;

    /** @var MarvelListRepository */
    protected $marvelListRepository;

    /** @var FavouriteCharacter */
    private $favouriteCharacter;

    /**
     * ProfileController constructor.
     *
     * @param UserProfileRepository $userProfileRepository
     * @param MarvelListRepository  $marvelListRepository
     */
    public function __construct(
        UserProfileRepository $userProfileRepository,
        MarvelListRepository $marvelListRepository
    ) {
        parent::__construct();

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

        $lists = $this->marvelListRepository->allForUser($user)->toArray();
        $this->getListsAvatars($lists);

        $favourite = new FavouriteCharacter();
        $favouriteCharacters = $favourite->setClient($this->client)->forUser($user->id);

        $viewData = [
            'profile'    => $user->profile,
            'avatar'     => $avatars,
            'lists'      => $lists,
            'characters' => $favouriteCharacters,
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
     * @param int $id
     *
     * @return mixed
     */
    public function viewList(int $id)
    {
        $list = [$this->marvelListRepository->find($id)->toArray()];
        $this->getListsAvatars($list);
        $list = array_pop($list);

        $items = $this->marvelListRepository->items($id);
        $lists = $this->marvelListRepository->allForUser(Auth::user());

        return View::make('frontend/profile.list', ['list' => $list, 'items' => $items, 'lists' => $lists]);
    }

    /**
     * @param int $id
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function publicProfile(int $id)
    {
        $profile = $this->userProfileRepository->find($id);
        $user = $profile->user;

        $avatars = [];
        if (isset($user->profile) && strlen($user->profile->avatar)) {
            $avatars = $this->getUserAvatars($user);
        }

        $lists = $this->marvelListRepository->allForUser($user)->toArray();
        $this->getListsAvatars($lists);

        $viewData = [
            'profile' => $user->profile,
            'avatar'  => $avatars,
            'lists'   => $lists,
        ];

        return View::make('frontend/profile.public', $viewData);
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
