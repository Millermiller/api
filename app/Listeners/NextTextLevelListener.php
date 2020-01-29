<?php

namespace App\Listeners;

use App\Events\NextTextLevel;
use App\Helpers\EloquentHelper;

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
        $user = EloquentHelper::getEloquentModel($event->user);
        $result = EloquentHelper::getEloquentModel($event->result);

        activity('public')
            ->causedBy($user)
            ->withProperties(['lang' => config('app.lang')])
            ->performedOn($result)
            ->log('Получен новый уровень');
    }
}
