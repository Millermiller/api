<?php


namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

/**
 * Class Message
 *
 * @package App\Mail
 */
class Message extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    /**
     * Message constructor.
     *
     * @param \Scandinaver\Common\Domain\Message $message
     */
    public function __construct(\Scandinaver\Common\Domain\Message $message)
    {
        $this->data = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): Message
    {
        return $this->from('support@scandinaver.org', "Scandinaver")
                    ->to('john@scandinaver.org')
                    ->subject("Получено сообщение")
                    ->markdown('emails.message');
    }
}
