<?php

namespace Animociel\Http\Controllers;

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
        $maxPetsCount = $user->maximum_pets;

        return view('dashboard.index')->with(compact('user', 'profile', 'petsCount', 'maxPetsCount'));
    }

    public function edit(Guard $auth)
    {
        $profile = $auth->user()->profile;
        return view('dashboard.edit')->with(compact('profile'));
    }

    public function editAccount(Guard $auth)
    {
        return view('dashboard.editAccount');
    }

    public function store(StoreProfileRequest $request, Guard $auth)
    {
        /** @var User $user */
        $user = $auth->user();

        $user->profile()->create($request->all());

        $this->dispatch(new CreateStripeCustomerForUser($user));
        
        return redirect()->intended('/dashboard/edit');
    }

    public function update(UpdateProfileRequest $request, Guard $auth)
    {
        /** @var User $user */
        $user = $auth->user();
        $user->profile()->update($request->except('_method', '_token'));
        
        $this->dispatch(new UpdateStripeCustomerForUser($user));

        return redirect()->route('dashboard.edit');
    }

    public function updateAccount(UpdateAccountRequest $request, Guard $auth)
    {
        /** @var User $user */
        $user = $auth->user();

        $user->fill($request->except('_method', '_token', 'password'));

        $this->dispatch(new UpdateStripeCustomerForUser($user));

        if ($request->has('password')) {
            $user->fill([
                'password' => bcrypt($request->input('password')),
            ]);
        }

        $user->save();

        return redirect()->route('dashboard.edit.account');
    }
}
