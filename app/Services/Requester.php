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

    /**
     *  создание пользователя на форуме
     * @param $params
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function createForumUser($params)
    {
        $client = new Client([
            'base_uri' => config('app.FORUM'),
            'curl' => [CURLOPT_SSL_VERIFYPEER => false, CURLOPT_SSL_VERIFYHOST => false]
        ]);

        $response = $client->request('POST', '/api/adduser.php', [
            'form_params' => [
                'username' => $params['login'],
                'email' => $params['email'],
                'password' => $params['password'],
            ]
        ]);

        if($response->getBody()->getContents() == 'success')
            activity()->log('Пользователь '.$params['login'].' зарегистрирован на форуме');
        else
            activity()->log('Пользователь '.$params['login'].' - ошибка регистрации на форуме');
    }

    /**
     * обновление пользователя на форуме
     * @param array $data
     * @param $oldemail
     * @return bool
     * @internal param User $user
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function updateForumUser(Array $data, $oldemail)
    {
        $client = new Client([
            'base_uri' => config('app.FORUM'),
            'curl' => [CURLOPT_SSL_VERIFYPEER => false, CURLOPT_SSL_VERIFYHOST => false]
        ]);

        $response = $client->request('POST', '/api/updateuser.php', [
            'form_params' => [
                'username' => (isset($data['login'])) ? $data['login'] : null,
                'email'    => (isset($data['email'])) ? $data['email'] : null,
                'oldemail' => $oldemail,
                'password' => (isset($data['password'])) ? $data['password'] : null,
            ]
        ]);

        if($response->getBody()->getContents() == 'success')
            activity()->log('forum user updated email - '.$data['email']);
        else
            activity()->log($response->getBody());

        return true;
    }

    /**
     * создание аватарки пользователя на форуме
     * @param User $user
     * @return bool
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function updateForumUserAvatar(User $user)
    {
        $client = new Client([
            'base_uri' => config('app.FORUM'),
            'curl' => [CURLOPT_SSL_VERIFYPEER => false, CURLOPT_SSL_VERIFYHOST => false]
        ]);

        $response = $client->request('POST', '/api/updateuserphoto.php', [
            'form_params' => [
                'email'    => $user->email,
                'avatar'   => config('app.SITE').'/uploads/u/'.$user->photo,
            ]
        ]);

        if($response->getBody()->getContents() == 'success')
            activity()->log('forum user updated email - '.$user->email);
        else
            activity()->log($response->getBody());


        return true;
    }

    /**
     * @param $params
     * @return bool
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function loginForumUser($params)
    {
        $client = new Client([
            'base_uri' => config('app.FORUM'),
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
      //  d($cookies);
        foreach ($cookies as $cookie) {
            $newCookie =\GuzzleHttp\Cookie\SetCookie::fromString($cookie);
            setcookie($newCookie->getName(), $newCookie->getValue(), time() + (365 * 86400), '/', '.'.config('app.DOMAIN'));
        }

        return true;
    }
}