<?php

namespace App\Http\Controllers\Auth;

use App\Events\UserRegistered;
use App\Models\Asset;
use App\Models\Language;
use App\Models\Result;
use App\Models\Text;
use App\Models\TextResult;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
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
     * @return \Illuminate\Validation\Validator
     */
    protected function validator(array $data)
    {
        Validator::extend('login', function($attribute, $value, $parameters)
        {
            return preg_match('/^[a-zA-Z0-9_-]+$/u', $value);
        });

        return Validator::make($data, [
            'login' => 'required|string|login|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);

        Session::flash('message', 'Добро пожаловать, '.$user->login.'.');
        Session::flash('alert-class', 'success');

        return $this->registered($request, $user)
            ?:  response()->json(['success' => false, 'message' => 'Произошла ошибка']);
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

        $languages = Language::all();

        foreach($languages as $language){
            //создаем избранное
            $favourite = Asset::create([
                'title' => 'Избранное',
                'basic'=> false,
                'favorite' => true,
                'type' => Asset::TYPE_FAVORITES,
                'lang' => $language->name
            ]);
            //даем избранное пользователю
            Result::create([
                'asset_id' => $favourite->id,
                'user_id' => $user->id,
                'lang' => $language->name
            ]);

            //находим первый словарь слов
            $words = Asset::where(['lang' => $language->name, 'type' => Asset::TYPE_WORDS, 'level' => 1])->first();
            Result::create([
                'asset_id' => $words->id,
                'user_id' => $user->id,
                'lang' => $language->name
            ]);

            //находим первый словарь предложений
            $sentences = Asset::where(['lang' => $language->name, 'type' => Asset::TYPE_SENTENCES, 'level' => 1])->first();
            Result::create([
                'asset_id' => $sentences->id,
                'user_id' => $user->id,
                'lang' => $language->name
            ]);

            //находим первый текст
            $text = Text::where(['lang' => $language->name,'level' => 1])->first();
            TextResult::create([
                'text_id' => $text->id,
                'user_id' => $user->id,
                'lang' => $language->name
            ]);
        }

        event(new UserRegistered($user, $data));

        activity()->causedBy($user)->log('Зарегистрирован пользователь');

        return $user;
    }

    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {
        return response()->json(['success' => true, 'link' => $_SERVER['HTTP_REFERER']]);
    }
}
