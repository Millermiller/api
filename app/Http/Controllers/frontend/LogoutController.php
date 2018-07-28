<?php

/**
 * Class LogoutController
 * @package Application\Controllers
 *
 * Created by PhpStorm.
 * User: whiskey
 * Date: 06.02.15
 * Time: 0:52
 */

namespace Application\Controllers;

use Scandinaver\Classes\App;
use Scandinaver\Classes\Controller;
use Scandinaver\Classes\User;

class LogoutController extends Controller {

    public function logout(){
        App::$session->clear();

        setcookie('token', 'w', time()-1000, '/', '.'.env('DOMAIN'));
        setcookie('u', '    w', time()-1000, '/', '.'.env('DOMAIN'));
        setcookie('user',  'w', time()-1000, '/', '.'.env('DOMAIN'));

        User::$auth = false;
        User::$role = 'user';
        header ('Location: http://'.HOST.'/');
    }
}