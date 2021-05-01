<?php


namespace App\Helpers;

use Illuminate\Contracts\Auth\Authenticatable;
use Scandinaver\Common\Domain\Contract\UserInterface;
use Scandinaver\User\Domain\Model\User;

/**
 * Class Auth
 *
 * @package App\Helpers
 */
class Auth
{
    /**
     * @return UserInterface
     */
    public static function user(): UserInterface
    {
        return \Auth::user();
    }
}