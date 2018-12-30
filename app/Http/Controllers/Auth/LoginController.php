<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    public function __construct()
    {
        //
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
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

        $login_type = filter_var($request->input('login'), FILTER_VALIDATE_EMAIL )
            ? 'email'
            : 'login';

        $request->merge([
            $login_type => $request->input('login')
        ]);

        if (Auth::attempt($request->only($login_type, 'password'))) {
           // Requester::loginForumUser(['username' => $request->input('login'), 'password' => $request->input('password')]);
            return response()->json(['success' => true, 'link' => $_SERVER['HTTP_REFERER']]);
        }
        else{
            return response()->json(['success' => false, 'message' => 'Неверный логин или пароль']);
        }
    }
}
