<?php

namespace Animociel\Http\Controllers;

use Animociel\AvailableSubscription;
use Animociel\Http\Requests;
use Animociel\User;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Stripe\Plan;

class SubscriptionController extends Controller
{
    /**
     * SubscriptionController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Guard $auth)
    {
        /** @var User $user */
        $user = $auth->user();

        $user->newSubscription('default', 'monthly')->quantity(3)->create();

        return view('dashboard.billing.subscription')->with(compact('user'));
    }
    
    public function update(Request $request) {
        
    }
}
