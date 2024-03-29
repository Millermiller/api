<?php

namespace App\Http;

use App\Http\Middleware\AddUserName;
use App\Http\Middleware\BinaryFileResponse;
use App\Http\Middleware\CheckAuth;
use App\Http\Middleware\CheckPlan;
use App\Http\Middleware\Cors;
use App\Http\Middleware\EncryptCookies;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Middleware\TouchUser;
use App\Http\Middleware\TrimStrings;
use App\Http\Middleware\TrustProxies;
use App\Http\Middleware\VerifyCsrfToken;
use Illuminate\Auth\Middleware\{Authenticate, AuthenticateWithBasicAuth, Authorize};
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Foundation\Http\Kernel as HttpKernel;
use Illuminate\Foundation\Http\Middleware\{CheckForMaintenanceMode, ConvertEmptyStringsToNull};
use Illuminate\Foundation\Http\Middleware\ValidatePostSize;
use Illuminate\Routing\Middleware\ThrottleRequests;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Laravel\Passport\Http\Middleware\CreateFreshApiToken;
use LaravelDoctrine\ORM\Middleware\SubstituteBindings;

/**
 * Class Kernel
 *
 * @package App\Http
 */
class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        CheckForMaintenanceMode::class,
        ValidatePostSize::class,
        TrimStrings::class,
        ConvertEmptyStringsToNull::class,
        // TrustProxies::class,
        // \App\Http\Middleware\ShowDebug::class,
        Cors::class,
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth'        => Authenticate::class,
        'auth.basic'  => AuthenticateWithBasicAuth::class,
        'bindings'    => SubstituteBindings::class,
        'can'         => Authorize::class,
        'guest'       => RedirectIfAuthenticated::class,
        'throttle'    => ThrottleRequests::class,
        'checkAuth'   => CheckAuth::class,
        'touchUser'   => TouchUser::class,
        'checkPlan'   => CheckPlan::class,
        'addUserName' => AddUserName::class,
        'cors'        => Cors::class,
        'file'        => BinaryFileResponse::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            EncryptCookies::class,
            AddQueuedCookiesToResponse::class,
            StartSession::class,
            AuthenticateSession::class,
            ShareErrorsFromSession::class,
            VerifyCsrfToken::class,
            SubstituteBindings::class,
            CreateFreshApiToken::class,
        ],

        'api' => [
            'throttle:60,1',
            'bindings',
            'cors',
        ],
    ];

    protected $commands = [
        'App\Console\Commands\CreateCommand',
        'App\Console\Commands\CreateCommandHandler',
        'App\Console\Commands\CreateCommandHandlerInterface',
    ];
}
