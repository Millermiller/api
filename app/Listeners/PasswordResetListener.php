<?php


namespace App\Listeners;

use app\Events\PasswordReset;

/**
 * Class PasswordResetListener
 *
 * @package App\Listener
 */
class PasswordResetListener
{

    public function __construct()
    {
        //
    }

    public function handle(PasswordReset $event): void
    {
        // Requester::updateForumUser([
        //     'password' => $event->password,
        //     'login'    => $event->user->login,
        //     'email'    => $event->user->email,
        // ], $event->user->email);
    }
}
