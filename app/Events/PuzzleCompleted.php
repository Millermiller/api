<?php


namespace App\Events;

use Scandinaver\User\Domain\User;
use Illuminate\Broadcasting\{Channel, PrivateChannel, InteractsWithSockets};
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Scandinaver\Puzzle\Domain\Puzzle;

/**
 * Class PuzzleCompleted
 *
 * @package App\Events
 */
class PuzzleCompleted
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    /**
     * @var User
     */
    private $user;

    /**
     * @var Puzzle
     */
    private $puzzle;

    /**
     * Create a new event instance.
     *
     * @param User   $user
     * @param Puzzle $puzzle
     */
    public function __construct(User $user, Puzzle $puzzle)
    {
        $this->user   = $user;
        $this->puzzle = $puzzle;
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
