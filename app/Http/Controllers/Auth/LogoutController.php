<?php


namespace App\Http\Controllers\Auth;


use App\Helpers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\JsonResponse;
use Scandinaver\User\UI\Command\LogoutCommand;

/**
 * Class LogoutController
 *
 * @package App\Http\Controllers\Auth
 */
class LogoutController extends Controller
{

    /**
     * @return JsonResponse
     * @throws BindingResolutionException
     */
    public function __invoke(): JsonResponse
    {
        $this->commandBus->execute(new LogoutCommand(Auth::user()));

        return response()->json(NULL);
    }
}