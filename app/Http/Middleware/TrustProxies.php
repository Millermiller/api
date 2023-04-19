<?php


namespace App\Http\Middleware;

use Illuminate\Http\Request;

/**
 * Class TrustProxies
 *
 * @package App\Http\Middleware
 */
class TrustProxies
{
    /**
     * The trusted proxies for this application.
     *
     * @var array
     */
    protected $proxies;

    /**
     * The headers that should be used to detect proxies.
     *
     * @var int
     */
    // protected $headers = Request::HEADER_X_FORWARDED_ALL;
}
