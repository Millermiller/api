<?php

namespace App\Http\Controllers\Auth;

use ReflectionException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Scandinaver\User\Application\Query\LoginQuery;
use Scandinaver\User\Domain\Exceptions\UserNotFoundException;

/**
 * Class LoginController
 * @package App\Http\Controllers\Auth
 */
class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws ReflectionException
     * @throws ValidationException
     */
    public function login(Request $request)
    {
        $this->validate($request,
            [
                'login'    => 'required',
                'password' => 'required',
            ],
            [
                'required' => 'Поле :attribute должно быть заполнено.',
            ]
        );
        //TODO: повторяется
        $login_type = filter_var($request->input('login'), FILTER_VALIDATE_EMAIL ) ? 'email' : 'login';

        $request->merge([$login_type => $request->input('login')]);

        try{//TODO: убрать success из ответов
            $this->queryBus->execute(new LoginQuery($request->only($login_type, 'password')));
            return response()->json(['success' => true, 'link' => $_SERVER['HTTP_REFERER']]);
        }
        catch (UserNotFoundException $e){
            return response()->json(['success' => false, 'message' => 'Неверный логин или пароль']);
        }
    }
}
