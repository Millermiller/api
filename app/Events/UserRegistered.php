<?php


namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Scandinaver\Common\Domain\Contract\UserInterface;

/**
 * Class UserRegistered
 *
 * @package App\Events
 */
class UserRegistered
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    public array $data;

    public UserInterface $user;

    /**
     * Create a new event instance.
     *
     * @param $user
     * @param $data
     */
    public function __construct(UserInterface $user, array $data)
    {
        $this->user = $user;
        $this->data = $data;
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
