<?php

/**
 * Class LoginController
 * @package Application\Controllers
 *
 * Created by PhpStorm.
 * User: whiskey
 * Date: 31.01.15
 * Time: 3:42
 */

namespace Application\Controllers;

use Scandinaver\Classes\Controller;
use Scandinaver\Classes\User;

class LoginController extends Controller{

    public function index()
    {
        $this->view->setLayout('main')
                    ->setTemplate('login')
                    ->render();
    }

    public function login()
    {
        if($_POST['login'])
        {
            $login = $_POST['login'];
            $pass = md5($_POST['pass']);

            if(User::autorize($login, $pass)){
               header('Location: http://'.HOST.'localhost/cards/assets');
            }
        }
    }
}