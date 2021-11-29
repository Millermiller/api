<?php


namespace App\Helpers;

use Scandinaver\Core\Domain\Contract\UserInterface;

/**
 * Class Auth
 *
 * @package App\Helpers
 */
class Auth
{

    public static function user(): ?UserInterface
    {
        return \Auth::user();
    }
}