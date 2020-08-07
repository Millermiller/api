<?php


namespace App\Events;

use Scandinaver\User\Domain\Model\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\{PrivateChannel, InteractsWithSockets, Channel};
use Illuminate\Foundation\Events\Dispatchable;
use Scandinaver\Learn\Domain\Model\Asset;

/**
 * Class NextLevel
 *
 * @package App\Events
 */
class NextLevel
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
    public $nextAsset;

    /**
     * Create a new event instance.
     *
     * @param Authenticatable $user
     * @param Asset           $nextAsset
     */
    public function __construct(Authenticatable $user, Asset $nextAsset)
    {
        $this->user      = $user;
        $this->nextAsset = $nextAsset;
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
