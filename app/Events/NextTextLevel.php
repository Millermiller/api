<?php

namespace App\Events;

use App\Models\TextResult;
use App\User;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class NextTextLevel
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var User
     */
    public $user;

    /**
     * @var TextResult
     */
    public $result;

    /**
     * Create a new event instance.
     *
     * @param User $user
     * @param TextResult $result
     */
    public function __construct(User $user, TextResult $result)
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
