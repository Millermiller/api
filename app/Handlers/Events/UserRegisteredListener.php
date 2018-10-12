<?php

namespace App\Handlers\Events;

use App\Events\UserRegistered;
use App\Services\Requester;
use GuzzleHttp\Client;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Mail;

class UserRegisteredListener
{
    /**
     * Create the event listener.
     *
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UserRegistered  $event
     * @return void
     */
    public function handle(UserRegistered $event)
    {
        Mail::send('mails.registration', $event->data, function($message) use ($event)
        {
            /** @var \Illuminate\Mail\Message $message */
            $message->from('support@scandinaver.org', "Scandinaver");
            $message->subject("Регистрация на сайте Scandinaver.org");
            $message->to($event->data['email']);
        });

        Requester::createForumUser($event->data);
    }
}
