<?php

namespace App\Http\Controllers\Sub\Frontend;

use App\Http\Controllers\Controller;
use Auth;

/**
 * Created by PhpStorm.
 * User: whiskey
 * Date: 06.02.15
 * Time: 0:52
 *
 * Class LogoutController
 * @package Application\Controllers
 */
class LogoutController extends Controller {

    public function index()
    {
        setcookie('token', 'w', time()-1000, '/', '.'.config('app.DOMAIN'));
        setcookie('user',  'w', time()-1000, '/', '.'.config('app.DOMAIN'));

        Auth::logout();

        return response()->json(['success' => true]);
    }
}