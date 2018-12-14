<?php

namespace App\Listeners;

use App\Events\NextTextLevel;

class NextTextLevelListener
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
     * @param  NextTextLevel  $event
     * @return void
     */
    public function handle(NextTextLevel $event)
    {
        activity()->causedBy($event->user)->performedOn($event->result)->log('Новый уровень');
    }
}
