<?php

namespace App\Listeners;

use App\Events\UserUpdated;

class UserDeletedListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UserUpdated  $event
     * @return void
     */
    public function handle(UserUpdated $event)
    {
        activity()->causedBy($event->user)->performedOn($event->asset)->log('Создан словарь');
    }
}
