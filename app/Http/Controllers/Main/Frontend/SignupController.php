<?php

namespace App\Http\Controllers\Main\Frontend;

use App\Http\Controllers\Controller;
use App\User;
use Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Input;


/**
 * Class SignupController
 * @package Application\Controllers
 *
 * Created by PhpStorm.
 * User: whiskey
 * Date: 31.01.15
 * Time: 3:56
 */
class SignupController extends Controller
{

    public function ajaxLogin()
    {
        $login = Input::get('login', '');
        $pass = Input::get('pass', '');

        if ($login == '' || $pass == '')
            return false;

        if (Auth::attempt(['email' => $login, 'password' => $pass]))
            return response()->json(['success' => true, 'redirect' => config('app.url')]);
        else
            return response()->json(['success' => false]);
    }
}