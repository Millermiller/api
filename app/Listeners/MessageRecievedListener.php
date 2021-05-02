<?php


namespace App\Listeners;

use App\Events\MessageRecieved;
use App\Helpers\EloquentHelper;

/**
 * Class MessageRecievedListener
 *
 * @package App\Listener
 */
class MessageRecievedListener
{
    public function __construct()
    {
        //
    }

    public function handle(MessageRecieved $event): void
    {
        $user    = EloquentHelper::getEloquentModel($event->user);
        $message = EloquentHelper::getEloquentModel($event->message);

        activity('admin')->causedBy($user)->performedOn($message)->log('Получено сообщение');
    }
}
