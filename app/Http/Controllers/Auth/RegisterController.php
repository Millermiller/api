<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
        //$this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'login' => 'required|string|alpha_num|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ],
            [
                'required' => 'Обязательное поле',
                'alpha_num' => 'Только латинские буквы и цифры',
                'confirmed' => 'Пароли не совпадают',
                'unique' => 'Пользователь уже зарегистрирован',
                'min' => 'Минимум :min символов',
                'email' => 'Укажите корректный email',
            ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user =  User::create([
            'login' => $data['login'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        //send verification mail to user
        //---------------------------------------------------------
        $data['verification_code']  = $user->verification_code;

        Mail::send('emails.welcome', $data, function($message) use ($data)
        {
            $message->from('no-reply@site.com', "Site name");
            $message->subject("Welcome to site name");
            $message->to($data['email']);
        });

        return $user;
    }

    public function check()
    {
        $role = Input::get('role');
        $value = Input::get('value');

        $answer['success'] = false;

        if ($role == 'reg-login') {
            try {
                User::where('login', $value)->firstOrFail();
            } catch (ModelNotFoundException $e) {
                $answer['success'] = true;
            }
        }

        if ($role == 'reg-email') {
            try {
                User::where('email', $value)->firstOrFail();
            } catch (ModelNotFoundException $e) {
                $answer['success'] = true;
            }
        }

        return response()->json($answer);
    }
}
