<?php


namespace App\Listeners;

use App\Events\MessageEvent;
use App\Mail\Message;
use Mail;

/**
 * Class MessageEventListener
 *
 * @package App\Listeners
 */
class MessageEventListener
{
    public function __construct()
    {
        //
    }

    public function handle(MessageEvent $event): void
    {
        //  activity('admin')->performedOn($event->message)->log('Получено сообщение');

        Mail::send(new Message($event->message));
    }
}
