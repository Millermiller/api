<?php


namespace App\Http\Controllers\Auth;

use Exception;
use App\Http\Controllers\Controller;
use Illuminate\Http\{Request, JsonResponse};
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Scandinaver\User\Domain\Model\User;
use Scandinaver\User\Domain\Exceptions\UserNotFoundException;
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
     * @param Request $request
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
            /** @var User $user */
            $user  = $this->queryBus->execute(new LoginCommand($request->only($login_type, 'password')));
            $state = $this->queryBus->execute(new UserStateQuery($user));
            return response()->json(['token' => '', 'state' => $state], 200);
        } catch (UserNotFoundException $e) {
            return response()->json(['message' => 'Пользователь не найден, попробуйте еще раз.'], 401);
        }
    }
}