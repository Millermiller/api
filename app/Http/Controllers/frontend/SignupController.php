<?php

/**
 * Class SignupController
 * @package Application\Controllers
 *
 * Created by PhpStorm.
 * User: whiskey
 * Date: 31.01.15
 * Time: 3:56
 */

namespace Application\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Scandinaver\Classes\Controller;
use Scandinaver\Classes\User;
use Scandinaver\Exceptions\UserAutorizationException;
use Scandinaver\Exceptions\UserRegistrationException;
use Scandinaver\Exceptions\DBExcteption;

class SignupController extends Controller{

    public function ajaxLogin()
    {
        if($this->request->isXmlHttpRequest())
        {
            $login = $this->request->get('login', '');
            $pass  = $this->request->get('pass', '');
            $this->answer = ['success' => true, 'redirect' => HOST];

            if($login == '' || $pass == '')
                return false;

            try{
               User::autorize($login, $pass);
            }
            catch (UserAutorizationException $e){
                $this->answer = ['success' => false, 'msg' => $e->getMessage()];
            }

            $this->send();
        }
    }

    public function ajaxRegistration()
    {
        if($this->request->isXmlHttpRequest())
        {
            $this->answer['success'] = true;

            $params = array(
                'email' => $this->request->get('email'),
                'pass'  => $this->request->get('pwdreg'),
                'pass2'  => $this->request->get('pwdreg2'),
                'login' => $this->request->get('login'),
                'role'  => 'user'
            );

            try{
               User::registration($params);

            }catch (UserRegistrationException $e){
                $this->answer = ['success' => false,
                                'msg' => $e->getMessage(),
                                'code' => $e->getCode()]; // 1 - login, 2 - pass
            }
            catch (UserAutorizationException $e){
                $this->answer = ['success' => false,
                                'msg' => 'Произошла ошибка, но мы уже знаем об этом. Попробуйте авторизоваться позже',
                                'code' => 3,
                                'description' => $e->getMessage()];
            }
            catch (DBExcteption $e){
                $this->answer = ['success' => false,
                                'msg' => 'Произошла ошибка, но мы уже знаем об этом. Попробуйте авторизоваться позже',
                                'code' => 3,
                                'description' => $e->getMessage()];
            }
            $this->send();
        }
    }

    public function ajaxCheckRegisterData()
    {
        if($this->request->isXmlHttpRequest())
        {
            $role  = $this->request->get('role');
            $value = $this->request->get('value');
            $this->answer['success'] = false;

            if($role == 'reg-login'){
                try{
                    \Application\Models\User::where('login', $value)->firstOrFail();
                }catch(ModelNotFoundException $e) {
                    $this->answer['success'] = true;
                }
            }

            if($role == 'reg-email'){
                try{
                    \Application\Models\User::where('email', $value)->firstOrFail();
                }catch(ModelNotFoundException $e) {
                    $this->answer['success'] = true;
                }
            }

            $this->send();
        }
    }
}