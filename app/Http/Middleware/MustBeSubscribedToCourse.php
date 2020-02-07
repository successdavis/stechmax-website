<?php

namespace App\Http\Middleware;

use Closure;

class MustBeSubscribedToCourse
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
        if (!auth()->check() || ! $request->course->isSubscribedBy(auth()->user())) {
            return redirect('/studyroom/' . $request->course->slug)->with('flash', 'You have no active subscription to this course', 'failed');
        }
        return $next($request);
    }
}
