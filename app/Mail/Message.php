<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Message extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    /**
     * Create a new message instance.
     *
     * @param \App\Models\Message $message
     */
    public function __construct(\App\Models\Message $message)
    {
        $this->data = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('support@scandinaver.org', "Scandinaver")
            ->to('john@scandinaver.org')
            ->subject("Получено сообщение")
            ->markdown('emails.message');
    }
}
