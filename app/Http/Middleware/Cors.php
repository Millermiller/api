<?php


namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

/**
 * Class Cors
 *
 * @package App\Http\Middleware
 */
class Cors
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
        header("Access-Control-Allow-Origin: {$request->headers->get('Origin')}");

        $headers = [
            'Access-Control-Allow-Methods'     => 'POST, GET, OPTIONS, PUT, DELETE',
            'Access-Control-Allow-Headers'     => 'Content-Type, X-Auth-Token, Origin, x-xsrf-token, authorization',
            'Access-Control-Allow-Credentials' => 'true',
        ];

        if ($request->cookie('authfrontend._token.local')) {
            $request->headers->set('Authorization', 'Bearer ' . $request->cookie('authfrontend._token.local'));
        }

        if ($request->getMethod() == "OPTIONS") {

            return response()->make('OK', 200, $headers);
        }

        $response = $next($request);
        //foreach ($headers as $key => $value)
        //    $response->header($key, $value);
        return $response;
    }
}