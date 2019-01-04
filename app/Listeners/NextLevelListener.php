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
        $event->user->increment('assets_opened');

        activity('public')
            ->causedBy($event->user)
            ->performedOn($event->result)
            ->withProperties(['lang' => config('app.lang')])
            ->log('Получен новый уровень');
    }
}
