<?php


namespace App\Listeners;

use App\Events\MessageEvent;
use App\Mail\Message;
use Mail;

class MessageEventListener
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
     * @param MessageEvent $event
     *
     * @return void
     */
    public function handle(MessageEvent $event): void
    {
        //  activity('admin')->performedOn($event->message)->log('Получено сообщение');

        Mail::send(new Message($event->message));
    }
}
