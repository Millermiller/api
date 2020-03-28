<?php


namespace App\Http\Middleware;

use Closure;
use Request;

/**
 * Class TouchUser
 *
 * @package App\Http\Middleware
 */
class TouchUser
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next): Closure
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
