<?php


namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Scandinaver\User\Domain\Model\User;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class UserRegistered
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    /**
     * @var array
     */
    public $data;

    /**
     * @var User
     */
    public $user;

    /**
     * Create a new event instance.
     *
     * @param $user
     * @param $data
     */
    public function __construct(User $user, Array $data)
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
