<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;

class TouchUser
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
        if (\Auth::check()) {
            // The user is logged in...
            $user = \Auth::user();
           // $user->last_online = Carbon::now();
           // $user->save();
        }
        return $next($request);
    }
}
