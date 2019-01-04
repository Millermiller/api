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
        activity('public')
            ->causedBy($event->user)
            ->withProperties(['lang' => config('app.lang')])
            ->performedOn($event->result)
            ->log('Получен новый уровень');
    }
}
