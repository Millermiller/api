<?php

namespace App\Listeners;

use App\Events\AssetDelete;

class AssetDeleteListener
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
     * @param  AssetDelete  $event
     * @return void
     */
    public function handle(AssetDelete $event)
    {
        activity()->causedBy($event->user)->performedOn($event->asset)->log('Словарь удален');
    }
}
