<?php

namespace App\Services;
use App\User;
use \GuzzleHttp\Client;

/**
 * Created by PhpStorm.
 * User: user
 * Date: 12.07.2015
 * Time: 16:44
 */
class Requester {

    public static function sendRegInfo($uid)
    {
        //ICELANDIC.SCANDINAVER.ORG//
        $client = new Client([
            'base_uri' => Options::$icelandic,
            'curl' => [CURLOPT_SSL_VERIFYPEER => false, CURLOPT_SSL_VERIFYHOST => false]
        ]);

        $response = $client->request('POST', '/api/setNewUser', ['form_params' => ['uid' => $uid]]);

        if($response->getBody()->getContents() == 'success')
            l(' на ' .Options::$icelandic. ' отправлены данные о регистрации пользователя '.$uid, 'success');
        else
            l($response, 'danger');

        return true;
    }

    public static function sendRemoveUser($id)
    {
        //ICELANDIC.SCANDINAVER.ORG//
        $client = new Client([
            'base_uri' => Options::$icelandic,
            'curl' => [CURLOPT_SSL_VERIFYPEER => false, CURLOPT_SSL_VERIFYHOST => false]
        ]);

        $response = $client->delete('/api/removeUser/'.$id);
        $response = json_decode($response->getBody());
        l(' на ' .Options::$icelandic. ' отправлены данные об удалении пользователя '.$id, 'success');

        if($response->success == '3')
            l(' ' .Options::$icelandic. ' пользователь ' . $id . ' удален ', 'success');
    }

    public static function createForumUser($params)
    {
        $client = new Client([
            'base_uri' => Options::$_forum,
            'curl' => [CURLOPT_SSL_VERIFYPEER => false, CURLOPT_SSL_VERIFYHOST => false]
        ]);

        $response = $client->request('POST', '/api/adduser.php', [
            'form_params' => [
                'username' => $params['login'],
                'email' => $params['email'],
                'password' => $params['openpass'],
                ]
        ]);

        if($response->getBody()->getContents() == 'success')
            l('forum user created email - '.$params['email'],'success');
        else
            l($response, 'danger');

        return true;
    }

    /**
     * @param User $user
     * @param $newemail
     * @return bool
     */
    public static function updateForumUser(User $user, $newemail)
    {
        $client = new Client([
            'base_uri' => Options::$_forum,
            'curl' => [CURLOPT_SSL_VERIFYPEER => false, CURLOPT_SSL_VERIFYHOST => false]
        ]);

        $response = $client->request('POST', '/api/updateuser.php', [
            'form_params' => [
                'username' => $user->login,
                'email'    => $user->email,
                'newemail' => $user->email,
                'password' => $user->password,
                'avatar'   => ($user->avatar) ? Options::$_main_site.$user->avatar : null,
            ]
        ]);

        if($response->getBody()->getContents() == 'success')
            l('forum user updated email - '.$user->email,'success');
        else
            l($response, 'danger');


        return true;
    }

    public static function loginForumUser($params)
    {
        $client = new Client([
            'base_uri' => Options::$_forum,
            'curl' => [CURLOPT_SSL_VERIFYPEER => false, CURLOPT_SSL_VERIFYHOST => false]
        ]);

        $response = $client->request('POST', '/index.php?login/login', [
            'form_params' => [
                '_xfToken'=> '1518553156,7fbce47c7ede95773cee960ebcb2fa9d',
                'login' => $params['username'],
                'password' => $params['password'],

            ]
        ]);
       // print($response->getBody()->getContents());die();
        $cookies = $response->getHeader('set-cookie');
        d($cookies);
        foreach ($cookies as $cookie) {
            $newCookie =\GuzzleHttp\Cookie\SetCookie::fromString($cookie);
            setcookie($newCookie->getName(), $newCookie->getValue(), time() + (365 * 86400), '/', '.'.Options::$site);
        }

        return true;
    }
}