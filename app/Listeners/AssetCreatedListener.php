<?php

namespace App\Listeners;

use App\Events\AssetCreated;
use App\Helpers\EloquentHelper;

class AssetCreatedListener
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
     * @param  AssetCreated  $event
     * @return void
     */
    public function handle(AssetCreated $event)
    {
        $user = EloquentHelper::getEloquentModel($event->user);
        $asset = EloquentHelper::getEloquentModel($event->asset);

        activity('public')
            ->causedBy($user)
            ->withProperties(['lang' => config('app.lang')])
            ->performedOn($asset)
            ->log('Создан словарь');
    }
}
