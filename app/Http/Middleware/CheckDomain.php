<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;

class CheckDomain
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
        if(request('subdomain') === 'is')
            config(['app.lang' => 'is']);

        $request->route()->forgetParameter('subdomain');

        return $next($request);
    }
}
