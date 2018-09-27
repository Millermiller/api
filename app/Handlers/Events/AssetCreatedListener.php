<?php

namespace App\Handlers\Events;

use App\Events\AssetCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

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
        //
    }
}
