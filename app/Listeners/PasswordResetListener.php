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
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param PasswordReset $event
     *
     * @return void
     * @throws GuzzleException
     */
    public function handle(PasswordReset $event): void
    {
        Requester::updateForumUser([
            'password' => $event->password,
            'login'    => $event->user->login,
            'email'    => $event->user->email,
        ], $event->user->email);
    }
}
