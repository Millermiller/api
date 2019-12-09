<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

/**
 * Class CheckDomain
 * @package App\Http\Middleware
 */
class CheckDomain
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(request('subdomain') === 'www')
           return redirect(config('app.SITE'));

        if(request('subdomain') === 'is')
            config(['app.lang' => 1]);

        if(request('subdomain') === 'sw')
            config(['app.lang' => 2]);

        $request->route()->forgetParameter('subdomain');

        return $next($request);
    }
}
