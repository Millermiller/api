<?php


namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

/**
 * Class Welcome
 *
 * @package App\Mail
 */
class Welcome extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    /**
     * Create a new message instance.
     *
     * @param $data
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return Message
     */
    public function build(): Message
    {
        return $this->from('support@scandinaver.org', "Scandinaver")
                    ->subject("Регистрация на сайте Scandinaver.org")
                    ->markdown('emails.welcome');
    }
}
