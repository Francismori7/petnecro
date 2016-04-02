<?php

namespace Animociel\Http\Controllers;

use Animociel\Http\Requests;

class SubscriptionController extends Controller
{
    public function index()
    {
        return view('dashboard.billing.subscription');
    }
}
