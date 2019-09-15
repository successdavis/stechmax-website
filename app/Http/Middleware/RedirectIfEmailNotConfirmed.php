<?php

namespace App\Http\Middleware;

use Closure;

class RedirectIfEmailNotConfirmed
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(! $request->user()->confirmed && ! $request->user()->phone_confirmed) {
            return redirect(route('register.confirm_email'))->with('flash', 'You must first confirm your email addresss');
        }
        return $next($request);
    }
}
