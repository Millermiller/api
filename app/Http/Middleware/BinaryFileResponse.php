<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

/**
 * Class BinaryFileResponse
 *
 * @package App\Http\Middleware
 */
class BinaryFileResponse
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
        $response = $next($request);
        $headers = [
            'Cache-Control' => 'nocache, no-store, max-age=0, must-revalidate',
            'Pragma', 'no-cache',
            'Expires', 'Fri, 01 Jan 1990 00:00:00 GMT',
        ];

        foreach ($headers as $key => $value) {
            $response->headers->set($key, $value);
        }

        return $response;
    }
}
