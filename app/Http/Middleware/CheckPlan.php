<?php


namespace App\Http\Middleware;

use App\Helpers\Auth;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Scandinaver\User\Domain\Service\UserService;

/**
 * Class CheckPlan
 *
 * @package App\Http\Middleware
 */
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
     * @param  Request  $request
     * @param  Closure  $next
     *
     * @return Response
     */
    public function handle($request, Closure $next)
    {
        if (\Auth::check()) {
           // $this->userService->updatePlan(Auth::user());
        }

        return $next($request);
    }
}
