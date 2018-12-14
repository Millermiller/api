<?php

namespace App\Listeners;

use App\Events\NextLevel;

class NextLevelListener
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
     * @param  NextLevel  $event
     * @return void
     */
    public function handle(NextLevel $event)
    {
        activity()->causedBy($event->user)->performedOn($event->result)->log('Новый уровень');
    }
}
