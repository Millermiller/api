<?php

namespace App\Listeners;

use App\Events\MessageRecieved;
use App\Helpers\EloquentHelper;

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
        $user = EloquentHelper::getEloquentModel($event->user);
        $message = EloquentHelper::getEloquentModel($event->message);

        activity('admin')->causedBy($user)->performedOn($message)->log('Получено сообщение');
    }
}
