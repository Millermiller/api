<?php

namespace App\Handlers\Events;

use App\Events\MessageRecieved;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class MessageRecievedListener
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
     * @param  MessageRecieved  $event
     * @return void
     */
    public function handle(MessageRecieved $event)
    {
        //
    }
}
