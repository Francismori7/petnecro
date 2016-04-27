<?php

namespace Animociel\Http\Controllers\Api;

use Animociel\Http\Controllers\Controller;
use Animociel\Http\Requests;
use Animociel\User;

class UserPetsController extends Controller
{
    /**
     * @var User
     */
    protected $user;

    public function __construct()
    {
        $this->middleware('auth');
        $this->user = auth()->user();
    }

    public function index()
    {
        $this->user->load('pets', 'subscriptions');

        return [
            'pets' => $this->user->pets,
            'maximum_pets' => $this->user->subscription()->quantity ?? 0,
        ];
    }
}
