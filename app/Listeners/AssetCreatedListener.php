<?php

namespace App\Listeners;

use App\Events\AssetCreated;

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
        activity()->causedBy($event->user)->performedOn($event->asset)->log('Создан словарь');
    }
}
