<?php

/**
 * Created by PhpStorm.
 * User: whiskey
 * Date: 21.04.15
 * Time: 23:24
 *
 * Class RemindController
 * @package Application\Controllers
 */

namespace App\Http\Controllers\Main\Frontend;

use Application\Services\Mail\Mailer;
use Scandinaver\Classes\App;
use App\Http\Controllers\Controller;

class RemindController extends Controller{

    private $email = '';

    public function index()
    {
        if(!$_POST)
        {
            App::goHome();
        }
    }

    public function remind()
    {
        if($this->request->isXmlHttpRequest())
        {
                $email = Input::get('email');

                if ($user = \Application\Models\User::where('email', $email)->first()) {
                    $link = $user->generateLink();
                    //echo  $link;
                    $sender = new Mailer();
                    $sender->sendRestoreMail(array('username' => $user->login, 'email' => $user->email, 'link' => $link));
                    $sender->sendRestoreMailToAdmin(array('username' =>  $user->login, 'email' => $user->email));
                    l('пользователь id: '.$user->id.' login: '.$user->login.', email: '.$user->email.' запросил восстановление пароля');
                    //mail('day_at_the_way@mail.ru', 'test', $link);
                    $this->answer['success'] = true;
                    $this->answer['msg'] = 'На ваш email отправлено письмо с инструкциями.';
                } else {
                    $this->answer['success'] = false;
                    $this->answer['msg'] = 'Пользователь с указанным email не найден';
                }
            return response()->json();
        }
    }

    public function refresh()
    {
        d($this);
    }

    public function restore($id, $link)
    {
        $this->UM = $this->getModel('UsersModel');

        if($this->UM->checkRestoreLink($id, $link))
            $this->view->setLayout('restore')->add('uid',$id)->render();
        else
           $this->pageNotFound();
    }

    public function ajaxSetNewPass()
    {
        if($this->request->isXmlHttpRequest())
        {
            $pass = Input::get('pass');
            $uid  = Input::get('uid');

            $this->UM = $this->getModel('UsersModel');

            if($this->UM->updatePassword($uid, $pass))
            {
                l('user ID: '.$uid.' сменил пароль');
                $this->answer['success'] = true;
                $this->answer['msg'] = '<p>Пароль успешно изменен. <a href="/">Перейти на сайт</a>';
            }
            else {
                l('user ID: '.$uid.'  не сменил пароль');
                $this->answer['success'] = false;
                $this->answer['msg'] = '<p>Что-то пошло не так, но мы уже знаем об этом. Попробуйте повторить позже или напишите нам support@icelandreams.ru';
            }
            return response()->json();
        }
    }
}