<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AdminProfileRequest;
use App\Repositories\UserProfileRepository;
use View;

/**
 * Class ProfileController
 * @package App\Http\Controllers\Admin
 */
class ProfileController extends HomeController
{
    /** @var UserProfileRepository */
    protected $userProfileRepository;

    public function __construct(UserProfileRepository $userProfileRepository)
    {
        $this->userProfileRepository = $userProfileRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function changePassword()
    {
        return View::make('admin.profile.change_password');
    }

    /**
     * @param AdminProfileRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changePasswordPost(AdminProfileRequest $request)
    {
        if (!\Hash::check($request->get('old_password'), \Auth::user()->password)) {
            \Session::flash('messages', ['error' => \Lang::get('admin/profile.old_pass_wrong')]);

            return \Redirect::back();
        }

        $this->userProfileRepository->updatePassword(\Auth::user(), $request->get('new_password'));

        \Session::flash('messages', ['success' => \Lang::get('admin/profile.new_pass_success')]);

        return \Redirect::back();
    }
}
