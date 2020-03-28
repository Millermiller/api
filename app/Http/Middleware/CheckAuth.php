<?php


namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;

/**
 * Class CheckAuth
 *
 * @package App\Http\Middleware
 */
class CheckAuth
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        return (Auth::check()) ? $next($request) : redirect('/login');
    }
}
