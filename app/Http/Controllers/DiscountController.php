<?php

namespace Animociel\Http\Controllers;

use Animociel\User;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Stripe\Coupon;
use Stripe\Error\InvalidRequest;

class DiscountController extends Controller
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
        return view('dashboard.billing.discount');
    }

    public function store(Request $request)
    {
        try {
            $coupon = Coupon::retrieve($request->coupon);
        } catch (InvalidRequest $error) {
            session()->flash('error', "Le coupon que vous avez entré n'existe pas!");

            return redirect()->back();
        }

        $this->user->applyCoupon($request->coupon);

        session()->flash('message', 'Le coupon a été ajouté avec succès!');

        return redirect()->back();
    }
}
