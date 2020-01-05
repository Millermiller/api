<?php


namespace App\Helpers;

use App\Entities\User;

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