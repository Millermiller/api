<?php


namespace App\Events;

use Scandinaver\Learn\Domain\Model\Asset;
use Scandinaver\User\Domain\Model\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

/**
 * Class AssetUpdated
 *
 * @package App\Events
 */
class AssetUpdated
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
    public $asset;

    /**
     * Create a new event instance.
     *
     * @param User  $user
     * @param Asset $asset
     */
    public function __construct(User $user, Asset $asset)
    {
        $this->user  = $user;
        $this->asset = $asset;
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
