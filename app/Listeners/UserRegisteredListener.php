<?php

namespace App\Listeners;

use App\Events\UserRegistered;
use App\Jobs\CreateUserForum;
use App\Jobs\SendRegistrationEmail;
use App\Mail\Welcome;
use App\Services\Requester;
use GuzzleHttp\Exception\GuzzleException;
use Mail;

class UserRegisteredListener
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
     * @param  UserRegistered $event
     * @return void
     */
    public function handle(UserRegistered $event)
    {
        dispatch(new SendRegistrationEmail($event));
        dispatch(new CreateUserForum($event));
    }
}
