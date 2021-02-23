<?php


namespace App\Http\Controllers\Auth;

use App\Helpers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Scandinaver\User\Domain\Exceptions\UserNotFoundException;
use Scandinaver\User\UI\Command\LoginCommand;
use Scandinaver\User\UI\Command\LogoutCommand;

/**
 * Class AuthController
 *
 * @package App\Http\Controllers\Auth
 */
class AuthController extends Controller
{
    use AuthenticatesUsers;

    /**
     * @param  Request  $request
     *
     * @return JsonResponse
     * @throws ValidationException
     */
    public function login(Request $request): JsonResponse
    {
        $this->validate($request, [
                'login'    => 'required',
                'password' => 'required',
            ], [
                'required' => 'Поле :attribute должно быть заполнено.',
            ]);
        //TODO: повторяется
        $login_type = filter_var($request->input('login'), FILTER_VALIDATE_EMAIL) ? 'email' : 'login';

        $request->merge([$login_type => $request->input('login')]);

        try {//TODO: убрать success из ответов
            $this->commandBus->execute(new LoginCommand($request->only($login_type, 'password')));

            $tokenResult = auth()->user()->createToken('Personal Access Token');
            $tokenResult->token->save();

            return response()->json(['access_token' => $tokenResult->accessToken]);
        } catch (UserNotFoundException $e) {
            return response()->json('Неверный логин или пароль', 403);
        }
    }

    /**
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        $this->commandBus->execute(new LogoutCommand(Auth::user()));

        return response()->json(NULL, 200);
    }
}
