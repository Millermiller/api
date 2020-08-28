<?php


namespace App\Listeners;

use app\Events\PasswordReset;
use GuzzleHttp\Exception\GuzzleException;
use Scandinaver\Common\Domain\Services\Requester;

/**
 * Class PasswordResetListener
 *
 * @package App\Listeners
 */
class PasswordResetListener
{

    public function __construct()
    {
        //
    }

    public function handle(PasswordReset $event): void
    {
        Requester::updateForumUser([
            'password' => $event->password,
            'login'    => $event->user->login,
            'email'    => $event->user->email,
        ], $event->user->email);
    }
}
