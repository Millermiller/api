<?php

namespace App\Http\Controllers\Main\Frontend;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Support\Facades\Input;

/**
 * Class LoginController
 * @package Application\Controllers
 *
 * Created by PhpStorm.
 * User: whiskey
 * Date: 31.01.15
 * Time: 3:42
 */
class LoginController extends Controller
{

    /**
     *
     */
    public function login()
    {
        $login = Input::get('login');
        $pass = Input::get('pass');

        if (Auth::attempt(['email' => $login, 'password' => $pass])) {
            header('Location: ' . config('app.url'));
        }
    }
}