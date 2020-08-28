<?php


namespace App\Listeners;

use App\Events\NextTextLevel;
use App\Helpers\EloquentHelper;

/**
 * Class NextTextLevelListener
 *
 * @package App\Listeners
 */
class NextTextLevelListener
{
    public function __construct()
    {
        //
    }

    public function handle(NextTextLevel $event): void
    {
        $user   = EloquentHelper::getEloquentModel($event->user);
        $result = EloquentHelper::getEloquentModel($event->result);

        activity('public')
            ->causedBy($user)
            ->withProperties(['lang' => config('app.lang')])
            ->performedOn($result)
            ->log('Получен новый уровень');
    }
}
