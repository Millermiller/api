<?php


namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;

/**
 * Class AddUserName
 *
 * @package App\Http\Middleware
 */
class AddUserName
{
    /**
     * Handle an incoming request.
     *
     * @param Request  $request
     * @param Closure $next
     *
     * @return Closure
     */
    public function handle($request, Closure $next): Closure
    {
        $request->request->add(['name' => Auth::user()->getLogin()]);

        return $next($request);
    }
}
