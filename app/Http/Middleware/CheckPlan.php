<?php

namespace App\Http\Middleware;

use App\Models\Plan;
use App\Services\UserService;
use Carbon\Carbon;
use Closure;

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
            $this->userService->updatePlan(\Auth::user());
        }
        return $next($request);
    }
}
