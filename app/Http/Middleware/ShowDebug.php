<?php


namespace App\Http\Middleware;

use Closure;
use Debugbar;
use Request;

/**
 * Class ShowDebug
 *
 * @package App\Http\Middleware
 */
class ShowDebug
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param  Closure  $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (in_array(Request::ip(), ['127.0.0.1', '77.242.99.149', '192.168.10.1'])) {
            Debugbar::enable();
        }
        else {
            Debugbar::disable();
        }

        return $next($request);
    }
}
