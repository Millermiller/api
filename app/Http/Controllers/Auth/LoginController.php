<?php


namespace App\Http\Controllers\Auth;


use App\Helpers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Scandinaver\User\Domain\Exception\UserNotFoundException;
use Scandinaver\User\UI\Command\LoginCommand;

/**
 * Class LoginAction
 *
 * @package App\Http\Controllers\Auth
 */
class LoginController extends Controller
{

    /**
     * @param  Request  $request
     *
     * @return JsonResponse
     * @throws ValidationException|BindingResolutionException
     */
    public function __invoke(Request $request): JsonResponse
    {
        $this->validate($request, [
            'login'    => 'required',
            'password' => 'required',
        ], [
            'required' => 'Поле :attribute должно быть заполнено.',
        ]);

        $login_type = filter_var($request->input('login'), FILTER_VALIDATE_EMAIL) ? 'email' : 'login';

        $request->merge([$login_type => $request->input('login')]);

        try {//TODO: убрать success из ответов
            $this->commandBus->execute(new LoginCommand($request->only($login_type, 'password')));

            $tokenResult = Auth::user()->createToken('Personal Access Token');
            $tokenResult->token->save();

            return response()->json(['access_token' => $tokenResult->accessToken]);
        } catch (UserNotFoundException $e) {
            return response()->json('Неверный логин или пароль', 403);
        }
    }
}