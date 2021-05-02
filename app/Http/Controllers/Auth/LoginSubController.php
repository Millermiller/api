<?php


namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\{JsonResponse, Request};
use Illuminate\Validation\ValidationException;
use Scandinaver\Common\Domain\Contract\UserInterface;
use Scandinaver\User\Domain\Exception\UserNotFoundException;
use Scandinaver\User\UI\Command\LoginCommand;
use Scandinaver\User\UI\Query\UserStateQuery;

/**
 * Class LoginSubController
 *
 * @package App\Http\Controllers\Auth
 */
class LoginSubController extends Controller
{
    use AuthenticatesUsers;

    /**
     * @param  Request  $request
     *
     * @return JsonResponse
     * @throws ValidationException
     * @throws Exception
     */
    public function login(Request $request): JsonResponse
    {
        $this->validate($request, [
                'login'    => 'required',
                'password' => 'required',
            ]);

        $login_type = filter_var($request->input('login'), FILTER_VALIDATE_EMAIL) ? 'email' : 'login';

        $request->merge([$login_type => $request->input('login')]);

        try {
            /** @var UserInterface $user */
            $user  = $this->commandBus->execute(new LoginCommand($request->only($login_type, 'password')));
            $state = $this->commandBus->execute(new UserStateQuery($user));

            return response()->json(['token' => '', 'state' => $state], 200);
        } catch (UserNotFoundException $e) {
            return response()->json(['message' => 'Пользователь не найден, попробуйте еще раз.'], 401);
        }
    }
}