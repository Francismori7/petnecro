<?php

namespace Animociel\Http\Controllers\Api;

use Animociel\User;
use Illuminate\Http\Request;

use Animociel\Http\Requests;
use Animociel\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * @var User
     */
    protected $user;

    public function __construct()
    {
        $this->user = auth()->user();
    }

    public function index() {
        if(auth()->guest()) {
            return ['user' => null];
        }

        $this->user->load('subscriptions', 'pets', 'profile');

        return ['user' => $this->user];
    }
}
