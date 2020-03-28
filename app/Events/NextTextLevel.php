<?php


namespace App\Events;

use Scandinaver\Text\Infrastructure\Persistence\Eloquent\TextResult;
use Scandinaver\User\Domain\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

/**
 * Class NextTextLevel
 *
 * @package App\Events
 */
class NextTextLevel
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

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
     * @param User       $user
     * @param TextResult $result
     */
    public function __construct(User $user, TextResult $result)
    {
        $this->user   = $user;
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
