<?php

namespace App\Http\Controllers\Main\Frontend;

use App\Http\Controllers\Controller;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;

/**
 * Created by PhpStorm.
 * User: whiskey
 * Date: 19.02.15
 * Time: 23:08
 *
 * Class ApiController
 * @package Application\Controllers
 *
 */
class ApiController extends Controller {

    public function login($login, $password)
    {
        l('login: '.$login. ' pass: '.$password);

        $this->answer = ['success' => true];

        try{
            $user =  User::autorize($login, $password);
            l('mobile user: '.$login.';  connect succesful');
            $this->answer = [
                'success' => true,
                'user' => $user,
                'languages' => $this->languages()
            ];
        }
        catch (UserAutorizationException $e){
            l('mobile user: '.$login.';  connect failed');
            $this->answer = ['success' => false, 'msg' => $e->getMessage()];
        }
        return response()->json();
    }

    private function languages()
    {
        return [
            [
                'name' => 'Исландский',
                'flag' => 'https://scandinaver.org/img/is_round.png',
                'letter' => 'ic'
            ],
            [
                'name' => 'Шведский',
                'flag' => 'https://scandinaver.org/img/sw_round.png',
                'letter' => 'sw'
            ],
        ];
    }

    public function assets($lang, $uid)
    {
        $server_uri = '';

        switch($lang){
            case 'ic':
                $server_uri = 'https://icelandic.scandinaver.org';
        }

        try{
            $client = new Client();

            /** @var Response $response */
            $response = $client->request('GET', $server_uri.'/api/assets/'.$uid);
            return response()->json(json_decode($response->getBody()));

        }catch (Exception $e){

        }
    }

    public function remind()
    {
        if(!empty($_POST['email'])) {

            $email = Input::get('email');

            if($user = \Application\Models\User::where('email', $email)->first())
            {
                $link = $user->generateLink();
                //echo  $link;
                $sender = new Mailer();
                $sender->sendRestoreMail(array('username' => $user->login, 'email' => $user->email, 'link' => $link));
                $sender->sendRestoreMailToAdmin(array('username' =>  $user->login, 'email' => $user->email));
                l('пользователь id: '.$user->id.' login: '.$user->login.', email: '.$user->email.' запросил восстановление пароля');
                //mail('day_at_the_way@mail.ru', 'test', $link);
                $this->answer['success'] = true;
                $this->answer['message'] = 'На ваш email отправлено письмо с инструкциями.';
                echo json_encode($this->answer);
            }
            else
            {
                $this->answer['success'] = true;
                $this->answer['message'] = 'Пользователь с указанным email не найден';
                echo json_encode($this->answer);
            }
        }
        else
        {
            $this->answer['success'] = false;
            $this->answer['message'] = 'это провал! вероятно, вы не ввели email';
            echo json_encode($this->answer);
        }
    }

    public function users()
    {
        $this->answer = User::all();
        return response()->json();
    }

    public function setSession($uid, $token)
    {
        $this->answer['success'] = false;

        $session = new Session(['user_id' => $uid, 'token' => $token]);
        if($session->save())
            $this->answer = ['success' => true];

        return response()->json();
    }
} 