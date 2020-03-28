<?php


namespace App\Http\Controllers\Auth;

use App\Helpers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use ReflectionException;
use Scandinaver\User\Application\Commands\LogoutCommand;

/**
 * Created by PhpStorm.
 * User: whiskey
 * Date: 06.02.15
 * Time: 0:52
 * Class LogoutController
 *
 * @package App\Http\Controllers\Sub\Frontend
 */
class LogoutController extends Controller
{

    /**
     * @return JsonResponse
     * @throws ReflectionException
     */
    public function logout(): JsonResponse
    {
        $this->commandBus->execute(new LogoutCommand(Auth::user()));

        return response()->json(null, 200);
    }
}