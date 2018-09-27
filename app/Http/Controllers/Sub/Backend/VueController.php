<?php

namespace App\Http\Controllers\Sub\Backend;

use App\Http\Controllers\Controller;
use Auth;
use Exception;
use Illuminate\Http\Request;

/**
 * Created by PhpStorm.
 * User: Миллер
 * Date: 29.05.2017
 * Time: 19:05
 *
 * Class VueController
 * @package Application\Controllers\Admin
 */
class VueController extends Controller
{
    public function index()
    {
        return view('sub.backend.vue');
    }

    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->input('login'), 'password' => $request->input('password')])) {
            return redirect('/admin');
        } else {
            return view('backend.login', ['error' => true]);
        }
    }

    public function logout()
    {
        setcookie('token', 'w', time() - 1000, '/', '.' . config('app.DOMAIN'));
        setcookie('user',  'w', time() - 1000, '/', '.' . config('app.DOMAIN'));

        Auth::logout();

        return response()->json(['success' => true, 'url' => config('app.SITE') . '/admin']);
    }
}