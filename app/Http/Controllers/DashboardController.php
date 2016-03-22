<?php

namespace PetNecro\Http\Controllers;

use Illuminate\Contracts\Auth\Guard;
use PetNecro\Http\Requests\StoreProfileRequest;
use PetNecro\Http\Requests\UpdateAccountRequest;
use PetNecro\Http\Requests\UpdateProfileRequest;
use PetNecro\User;

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
        //return redirect()->route('dashboard.edit');
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
        $auth->user()->profile()->create($request->all());

        return redirect()->intended('/dashboard/edit');
    }

    public function update(UpdateProfileRequest $request, Guard $auth)
    {
        $auth->user()->profile()->update($request->except('_method', '_token'));

        return redirect()->route('dashboard.edit');
    }

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

        return redirect()->route('dashboard.edit.account');
    }
}
