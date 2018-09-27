<?php

namespace App\Handlers\Events;

use App\Events\AssetDelete;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

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
        //
    }
}
