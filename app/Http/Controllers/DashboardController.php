<?php

namespace Animociel\Http\Controllers;

use Animociel\Events\User\UserFilledProfile;
use Animociel\Events\User\UserUpdatedAccount;
use Animociel\Events\User\UserUpdatedProfile;
use Animociel\Http\Requests\StoreProfileRequest;
use Animociel\Http\Requests\UpdateAccountRequest;
use Animociel\Http\Requests\UpdateProfileRequest;
use Animociel\User;
use Illuminate\Contracts\Auth\Guard;

class DashboardController extends Controller
{
    /**
     * DashboardController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('dashboard.index');
    }

    public function editProfile(Guard $auth)
    {
        /** @var User $user */
        $user = $auth->user();
        $profile = $user->profile;

        return view('dashboard.edit')->with(compact('user', 'profile'));
    }

    public function editAccount(Guard $auth)
    {
        return view('dashboard.editAccount');
    }

    /**
     * Create a profile for the current user.
     *
     * @event Animociel\Events\UserFilledProfile
     * @param StoreProfileRequest $request
     * @param Guard $auth
     * @return mixed
     */
    public function storeProfile(StoreProfileRequest $request, Guard $auth)
    {
        /** @var User $user */
        $user = $auth->user();

        $user->profile()->create($request->all());

        event(new UserFilledProfile($user));

        return redirect()->intended('/dashboard/edit/profile');
    }

    /**
     * User has requested to update his profile details.
     *
     * @param UpdateProfileRequest $request
     * @param Guard $auth
     * @return mixed
     */
    public function updateProfile(UpdateProfileRequest $request, Guard $auth)
    {
        /** @var User $user */
        $user = $auth->user();

        $user->profile()->update($request->except('_method', '_token'));

        event(new UserUpdatedProfile($user));

        return redirect()->route('dashboard.edit.profile');
    }

    /**
     * User has requested to update his account details.
     *
     * @param UpdateAccountRequest $request
     * @param Guard $auth
     * @return mixed
     */
    public function updateAccount(UpdateAccountRequest $request, Guard $auth)
    {
        /** @var User $user */
        $user = $auth->user();

        $user->fill($request->except('_method', '_token', 'password'));

        if ($request->has('password')) {
            $user->fill([
                'password' => bcrypt($request->input('password')),
            ]);
        }

        $user->save();

        event(new UserUpdatedAccount($user));

        return redirect()->route('dashboard.edit.account');
    }
}
