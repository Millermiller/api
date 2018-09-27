<?php

namespace App\Handlers\Events;

use App\Events\NextTextLevel;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

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
        //
    }
}
