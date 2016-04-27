<?php

namespace Animociel\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param  string|null $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (null !== Auth::guard($guard)->user()) {
            Auth::guard($guard)->user()->load('subscriptions', 'profile');
        }

        if (Auth::guard($guard)->guest()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->guest('login');
            }
        }

        if (!Auth::guard($guard)->user()->has_filled_profile &&
            !str_contains($request->route()->getName(), 'dashboard')
        ) {
            return redirect()->route('dashboard.edit');
        }

        return $next($request);
    }
}
