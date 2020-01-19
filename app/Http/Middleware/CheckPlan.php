<?php

namespace App\Http\Middleware;

use App\Helpers\Auth;
use Carbon\Carbon;
use Closure;
use Scandinaver\User\Domain\Services\UserService;

class CheckPlan
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (\Auth::check()) {
            $this->userService->updatePlan(Auth::user());
        }
        return $next($request);
    }
}
