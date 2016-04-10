<?php

namespace Animociel\Http\Controllers;

use Animociel\Http\Requests;
use Animociel\User;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;

class CreditCardController extends Controller
{
    /** @var User */
    protected $user;

    public function __construct(Guard $auth)
    {
        $this->middleware('auth');

        $this->user = $auth->user();
    }

    public function edit()
    {
        return view('dashboard.billing.card')->withUser($this->user);
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'stripeToken' => 'required'
        ]);

        $this->user->updateCard($request->stripeToken);

        session()->flash('message', 'Votre carte de crédit a été modifiée.');

        return redirect()->back();
    }
}
