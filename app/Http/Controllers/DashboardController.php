<?php

namespace Animociel\Http\Controllers;

use Animociel\Events\User\UserFilledProfile;
use Animociel\Events\User\UserUpdatedProfile;
use Animociel\Http\Requests\StoreProfileRequest;
use Animociel\Http\Requests\UpdateAccountRequest;
use Animociel\Http\Requests\UpdateProfileRequest;
use Animociel\Jobs\CreateStripeCustomerForUser;
use Animociel\Jobs\UpdateStripeCustomerForUser;
use Animociel\Profile;
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

    public function index(Guard $auth)
    {
        /** @var User $user */
        $user = $auth->user();
        $profile = $user->profile;
        $petsCount = $user->pets()->count();
        $maxPetsCount = $user->subscription()->quantity;

        return view('dashboard.index')->with(compact('user', 'profile', 'petsCount', 'maxPetsCount'));
    }

    public function editProfile(Guard $auth)
    {
        $profile = $auth->user()->profile;

        return view('dashboard.edit')->with(compact('profile'));
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
        
        return redirect()->intended('/dashboard/edit');
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

        return redirect()->route('dashboard.edit');
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

        event(new UserUpdatedProfile($user));

        return redirect()->route('dashboard.edit.account');
    }
}
