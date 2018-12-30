<?php

namespace App\Http\Controllers\Main\Backend;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;
use Mail;

/**
 * Class IndexController
 * @package Application\Controllers\Admin
 * Created by PhpStorm.
 * User: whiskey
 * Date: 23.11.14
 * Time: 18:07
 */
class VueController extends Controller
{
    public function index()
    {
        return view('main.backend.vue');
    }

    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->input('login'), 'password' => $request->input('password')])) {
            return redirect('/admin');
        } else {
            return view('main.backend.login', ['error' => true]);
        }
    }

    public function logout()
    {
        setcookie('token', 'w', time() - 1000, '/', '.' . config('app.DOMAIN'));
        setcookie('user',  'w', time() - 1000, '/', '.' . config('app.DOMAIN'));

        Auth::logout();

        return response()->json(['success' => true, 'url' => config('app.SITE') . '/admin']);
    }

    /**
     *
     */
    public function testmail()
    {
        //Mail::send('mails.registration', [], function ($message){
        //    $message->from('support@scandinaver.org', 'Sender');
        //    $message->to('day_at_the_way@mail.ru')->subject('Test message');
        //});
    }
}