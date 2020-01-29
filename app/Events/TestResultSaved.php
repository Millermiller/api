<?php

namespace App\Events;

use Scandinaver\User\Domain\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\{PrivateChannel, InteractsWithSockets};
use Scandinaver\Learn\Domain\{Asset, Result};

/**
 * Class TestResultSaved
 * @package App\Events
 */
class TestResultSaved
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    /**
     * @var User
     */
    public $user;

    /**
     * @var Asset
     */
    public $result;

    /**
     * Create a new event instance.
     *
     * @param User $user
     * @param Result $result
     */
    public function __construct(User $user, Result $result)
    {
        $this->user = $user;
        $this->result = $result;
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
