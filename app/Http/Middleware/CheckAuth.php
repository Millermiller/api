<?php

namespace App\Http\Middleware;

use App\User;
use Auth;
use Carbon\Carbon;
use Closure;

use DB;
use Illuminate\Support\Facades\Cookie;

class CheckAuth
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
        return (Auth::check()) ? $next($request) : redirect('/login');
    }
}
