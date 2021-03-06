<?php


namespace Scandinaver\Common\Domain\Service;

use GuzzleHttp\Client;
use GuzzleHttp\Cookie\SetCookie;
use GuzzleHttp\Exception\GuzzleException;

/**
 * Class Requester
 *
 * @package Scandinaver\Common\Domain\Service
 */
class Requester
{
    /**
     *  создание пользователя на форуме
     *
     * @param $params
     *
     * @throws GuzzleException
     */
    public static function createForumUser($params)
    {
        $client = new Client(
            [
                'base_uri' => config('app.FORUM'),
                'curl'     => [
                    CURLOPT_SSL_VERIFYPEER => FALSE,
                    CURLOPT_SSL_VERIFYHOST => FALSE,
                ],
            ]
        );

        $response = $client->request(
            'POST',
            '/api/adduser.php',
            [
                'form_params' => [
                    'username' => $params['login'],
                    'email'    => $params['email'],
                    'password' => $params['password'],
                ],
            ]
        );

        if ($response->getBody()->getContents() == 'success') {
            activity('admin')->log(
                'Пользователь '.$params['login'].' зарегистрирован на форуме'
            );
        }
        else {
            activity('admin')->log(
                'Пользователь '.$params['login'].' - ошибка регистрации на форуме'
            );
        }
    }

    /**
     * обновление пользователя на форуме
     *
     * @param  array  $data
     * @param         $oldemail
     *
     * @return bool
     * @throws GuzzleException
     * @internal param User $user
     */
    public static function updateForumUser(array $data, $oldemail)
    {
        $client = new Client(
            [
                'base_uri' => config('app.FORUM'),
                'curl'     => [
                    CURLOPT_SSL_VERIFYPEER => FALSE,
                    CURLOPT_SSL_VERIFYHOST => FALSE,
                ],
            ]
        );

        $response = $client->request(
            'POST',
            '/api/updateuser.php',
            [
                'form_params' => [
                    'username' => (isset($data['login'])) ? $data['login'] : NULL,
                    'email'    => (isset($data['email'])) ? $data['email'] : NULL,
                    'oldemail' => $oldemail,
                    'password' => (isset($data['password'])) ? $data['password'] : NULL,
                ],
            ]
        );

        if ($response->getBody()->getContents() == 'success') {
            activity('admin')->log(
                'forum user updated email - '.$data['email']
            );
        }
        else {
            activity('admin')->log($response->getBody());
        }

        return TRUE;
    }

    /**
     * создание аватарки пользователя на форуме
     *
     * @param  User  $user
     *
     * @return bool
     * @throws GuzzleException
     */
    public static function updateForumUserAvatar(User $user)
    {
        $client = new Client(
            [
                'base_uri' => config('app.FORUM'),
                'curl'     => [
                    CURLOPT_SSL_VERIFYPEER => FALSE,
                    CURLOPT_SSL_VERIFYHOST => FALSE,
                ],
            ]
        );

        $response = $client->request(
            'POST',
            '/api/updateuserphoto.php',
            [
                'form_params' => [
                    //  'email'    => $user->email,
                    //  'avatar'   => config('app.SITE').'/uploads/u/'.$user->photo,
                ],
            ]
        );

        // if($response->getBody()->getContents() == 'success')
        //  activity('admin')->log('forum user updated email - '.$user->email);
        // else
        //  activity('admin')->log($response->getBody());


        return TRUE;
    }

    /**
     * @param $params
     *
     * @return bool
     * @throws GuzzleException
     */
    public static function loginForumUser($params)
    {
        $client = new Client(
            [
                'base_uri' => config('app.FORUM'),
                'curl'     => [
                    CURLOPT_SSL_VERIFYPEER => FALSE,
                    CURLOPT_SSL_VERIFYHOST => FALSE,
                ],
            ]
        );

        $response = $client->request(
            'POST',
            '/index.php?login/login',
            [
                'form_params' => [
                    '_xfToken' => '1518553156,7fbce47c7ede95773cee960ebcb2fa9d',
                    'login'    => $params['username'],
                    'password' => $params['password'],
                ],
            ]
        );
        // print($response->getBody()->getContents());die();
        $cookies = $response->getHeader('set-cookie');
        //  d($cookies);
        foreach ($cookies as $cookie) {
            $newCookie = SetCookie::fromString($cookie);
            setcookie(
                $newCookie->getName(),
                $newCookie->getValue(),
                time() + (365 * 86400),
                '/',
                '.'.config('app.DOMAIN')
            );
        }

        return TRUE;
    }
}