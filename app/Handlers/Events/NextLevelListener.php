<?php

namespace App\Handlers\Events;

use App\Events\NextLevel;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

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
        //
    }
}
