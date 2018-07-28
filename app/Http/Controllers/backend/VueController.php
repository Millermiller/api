<?php

/**
 * Class IndexController
 * @package Application\Controllers\Admin
 * Created by PhpStorm.
 * User: whiskey
 * Date: 23.11.14
 * Time: 18:07
 */

namespace Application\Controllers\Admin;

use Application\Models\Log;
use Application\Models\Message;
use Application\Models\User;
use Application\Services\Mail\Mailer;
use Exception;
use PHPMailer\PHPMailer\PHPMailer;
use Scandinaver\Classes\App;
use Scandinaver\Classes\Controller;

class VueController extends Controller
{
    function index()
    {
        if (\Scandinaver\Classes\User::$_admin) {
            $this->setView('vue')->setHtmlTemplate('index')->render();
        } else {
            if ($this->request->get('login')) {

                $login = $this->request->get('login');
                $pass = $this->request->get('pass');
                try {
                    \Scandinaver\Classes\User::autorize($login, $pass);
                    $this->redirect('admin');
                } catch (Exception $e) {
                    $this->redirect('admin');
                    l("Попытка входа в админку. login: $login, pass: " . $this->request->get('pass'));
                }
            } else {
                $this->setView('login')->setTemplate('index')->render();
            }
        }
    }

    function logout()
    {
        App::$session->clear();

        setcookie('token','w', time() - 1000, '/', '.' . env('DOMAIN'));
        setcookie('u',    'w', time() - 1000, '/', '.' . env('DOMAIN'));
        setcookie('user', 'w', time() - 1000, '/', '.' . env('DOMAIN'));

        \Scandinaver\Classes\User::$auth = false;
        \Scandinaver\Classes\User::$role = 'user';

        $this->answer['success'] = true;
        $this->answer['url'] = 'https://' . HOST . '/admin';
        $this->send();
    }

    public function dashboard()
    {
        // $last_day_users = User::where('created_at', '>', Carbon::yesterday())->count();
        // $message_count = Message::all()->count();
        // $unread = Message::find(['readed' => 0]);

        $this->send([
            'users'      => User::all()->count(),
            'log'        => array_values(Log::all()->sortByDesc('id')->forPage(1, 50)->toArray()),
            'messages'   => array_values(Message::all()->sortByDesc('created_at')->toArray())
        ]);
    }

    public function deleteLog($id)
    {
        $this->send([
            'success' => Log::destroy($id),
            'log' => array_values(Log::all()->sortByDesc('id')->forPage(1, 50)->toArray())
        ]);
    }

    public function deleteMessage($id)
    {
        $this->send([
            'success'  => Message::destroy($id),
            'messages' => array_values(Message::all()->sortByDesc('created_at')->toArray())
        ]);
    }

    public function readMessage($id)
    {
        $this->send(['success' =>  Message::find($id)->update(['readed' => 1])]);
    }

    public function sendmail()
    {
        $mailer = new Mailer();

        $this->send(['success' =>   $mailer->reg()]);
    }
}