<?php

namespace App\Listeners;

use app\Events\PasswordReset;
use App\Services\Requester;

class PasswordResetListener
{
    /**
     * Create the event listener.
     *
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param PasswordReset $event
     * @return void
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function handle(PasswordReset $event)
    {
        Requester::updateForumUser([
            'password' => $event->password,
            'login' => $event->user->login,
            'email' => $event->user->email,
            ], $event->user->email);
    }
}
