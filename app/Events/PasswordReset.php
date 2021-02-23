<?php


namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Scandinaver\User\Domain\Model\User;

/**
 * Class PasswordReset
 *
 * @package App\Events
 */
class PasswordReset
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    /**
     * @var User
     */
    public $user;

    /**
     * @var string
     */
    public $password;

    /**
     * Create a new event instance.
     *
     * @param  User  $user
     * @param        $password
     */
    public function __construct(User $user, $password)
    {
        $this->user = $user;

        $this->password = $password;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}