<?php

namespace App\Listeners;

use App\Events\NextLevel;

/**
 * Class NextLevelListener
 *
 * @package App\Listeners
 */
class NextLevelListener
{
    public function __construct()
    {
        //
    }

    public function handle(NextLevel $event): void
    {
        /*
        $event->user->increment('assets_opened');

        activity('public')
            ->causedBy($event->user)
            ->performedOn($event->result)
            ->withProperties(['lang' => config('app.lang')])
            ->log('Получен новый уровень');
        */
    }
}
