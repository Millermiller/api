<?php


namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Scandinaver\Common\Domain\Contract\UserInterface;
use Scandinaver\Common\Domain\Model\Message;
use Scandinaver\User\Domain\Model\User;

/**
 * Class MessageRecieved
 *
 * @package App\Events
 */
class MessageRecieved extends Event
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    public UserInterface $user;

    public Message $message;

    /**
     * Create a new event instance.
     *
     * @param  User     $user
     * @param  Message  $message
     */
    public function __construct(User $user, Message $message)
    {
        $this->user    = $user;
        $this->message = $message;
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
