<?php


namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;

/**
 * Class CheckAdminAuth
 *
 * @package App\Http\Middleware
 */
class CheckAdminAuth
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
        return (Auth::check() && Auth::user()->isAdmin()) ? $next($request) : redirect('/admin/login');
    }
}
