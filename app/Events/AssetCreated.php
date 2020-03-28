<?php


namespace App\Events;

use Scandinaver\Learn\Domain\Asset;
use Scandinaver\User\Domain\User;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

/**
 * Class AssetCreated
 *
 * @package App\Events
 */
class AssetCreated
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
     * @return PrivateChannel
     */
    public function broadcastOn(): PrivateChannel
    {
        return new PrivateChannel('channel-name');
    }
}
