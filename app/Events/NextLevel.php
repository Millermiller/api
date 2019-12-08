<?php

namespace App\Events;

use App\Entities\{Result, User};
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class NextLevel
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var User
     */
    public $user;

    /**
     * @var Result
     */
    public $result;

    /**
     * Create a new event instance.
     *
     * @param Authenticatable $user
     * @param Result $result
     */
    public function __construct(Authenticatable $user, Result $result)
    {
        $this->user = $user;
        $this->result = $result;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
