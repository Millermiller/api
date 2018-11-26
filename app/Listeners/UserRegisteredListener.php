<?php

namespace App\Listeners;

use App\Events\UserRegistered;
use App\Mail\Welcome;
use App\Services\Requester;
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
     * @param  UserRegistered  $event
     * @return void
     */
    public function handle(UserRegistered $event)
    {
        Mail::to($event->user)->send(new Welcome($event->data));

        Requester::createForumUser($event->data);
    }
}
