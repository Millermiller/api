<?php

namespace App\Http\Controllers\Main\Frontend;

use App\Http\Controllers\Controller;
use Auth;

/**
 * Class LogoutController
 * @package Application\Controllers
 *
 * Created by PhpStorm.
 * User: whiskey
 * Date: 06.02.15
 * Time: 0:52
 */
class LogoutController extends Controller {

    public function logout(){

        Auth::logout();

        return redirect()->route('frontend::home');
    }
}