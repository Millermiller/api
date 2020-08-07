<?php


namespace App\Helpers;

use Illuminate\Contracts\Auth\Authenticatable;
use Scandinaver\User\Domain\Model\User;

/**
 * Class Auth
 *
 * @package App\Helpers
 */
class Auth
{
    /**
     * @return Authenticatable|User|null
     */
    public static function user()
    {
        return \Auth::user();
    }
}