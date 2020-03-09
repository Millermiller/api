<?php

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Validation\ValidationException;
use Scandinaver\User\Domain\Services\UserService;
use Session;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * @var UserService
     */
    protected $userService;

    /**
     * RegisterController constructor.
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Validation\Validator
     */
    protected function validator(array $data)
    {
        Validator::extend('login', function($attribute, $value, $parameters)
        {
            return preg_match('/^[a-zA-Z0-9_-]+$/u', $value);
        });

        return Validator::make($data, [
            'login' => 'required|string|login|max:255|unique:App\Entities\User,login',
            'email' => 'required|string|email|max:255|unique:App\Entities\User,email',
            'password' => 'required|string|min:6|confirmed',
        ],
            [
                'required' => 'Обязательное поле',
                'login' => 'Только латинские символы и цифры',
                'confirmed' => 'Пароли не совпадают',
                'unique' => 'Пользователь уже зарегистрирован',
                'min' => 'Минимум :min символов',
                'email' => 'Укажите корректный email',
            ]);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param Request $request
     * @return Response
     * @throws ValidationException
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);

        Session::flash('message', 'Добро пожаловать, '.$user->getLogin().'.');
        Session::flash('alert-class', 'success');

        return $this->registered($request, $user)
            ?:  response()->json(['success' => false, 'message' => 'Произошла ошибка']);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Entities\User
     */
    protected function create(array $data)
    {
        return $this->userService->registration($data);
    }

    /**
     * The user has been registered.
     *
     * @param Request $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {
        return response()->json(['success' => true, 'link' => $_SERVER['HTTP_REFERER']]);
    }
}
