<?php


namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Scandinaver\User\Infrastructure\Persistence\Eloquent\User;

/**
 * Class ResetPassword
 *
 * @package App\Mail
 */
class ResetPassword extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The password reset token.
     *
     * @var string
     */
    public $token;

    /**
     * @var User
     */
    public $user;

    /**
     * Create a new message instance.
     *
     * @param User $user
     * @param      $token
     */
    public function __construct(User $user, $token)
    {
        $this->token = $token;

        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return Message
     */
    public function build(): Message
    {
        return $this->from('support@scandinaver.org', "Scandinaver")
                    ->subject("Сброс пароля на сайте Scandinaver.org")
                    ->markdown('emails.reset');
    }
}
