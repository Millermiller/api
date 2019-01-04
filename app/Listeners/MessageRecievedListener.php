<?php

namespace App\Listeners;

use App\Events\MessageRecieved;

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
        activity('admin')->causedBy($event->user)->performedOn($event->message)->log('Получено сообщение');
    }
}
