<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfEmailAlreadyConfirm
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (! Auth::guard($guard)->check() || $request->user()->confirmed || $request->user()->phone_confirmed) {
            return redirect('/courses')->with('flash', 'Sorry you cannot visit this page');
        }
        return $next($request);
    }
}
