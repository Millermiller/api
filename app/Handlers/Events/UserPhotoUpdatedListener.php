<?php

namespace App\Handlers\Events;

use App\Events\UserPhotoUpdated;
use App\Services\Requester;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

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
