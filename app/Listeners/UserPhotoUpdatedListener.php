<?php

namespace App\Listeners;

use App\Events\UserPhotoUpdated;
use App\Services\Requester;

class UserPhotoUpdatedListener
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
     * @param  UserPhotoUpdated  $event
     * @return void
     */
    public function handle(UserPhotoUpdated $event)
    {
        Requester::updateForumUserAvatar($event->user);
    }
}
