<?php


namespace App\Helpers;

use Scandinaver\User\Domain\User;

class Auth
{
    /**
     * @return \Illuminate\Contracts\Auth\Authenticatable|User|null
     */
    public static function user()
    {
        return \Auth::user();
    }
}