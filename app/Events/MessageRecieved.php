<?php


namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Scandinaver\Common\Domain\Message;
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

    /**
     * @var User
     */
    public $user;

    /**
     * @var Message
     */
    public $message;

    /**
     * Create a new event instance.
     *
     * @param User    $user
     * @param Message $message
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
