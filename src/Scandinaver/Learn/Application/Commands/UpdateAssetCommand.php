<?php


namespace Scandinaver\Learn\Application\Commands;

use App\Entities\User;
use Scandinaver\Learn\Domain\Asset;
use Scandinaver\Shared\Command;

/**
 * Class CreateAssetCommand
 * @package Scandinaver\Learn\Application\Commands
 */
class UpdateAssetCommand implements Command
{
    /**
     * @var User
     */
    private $user;
    /**
     * @var string
     */
    private $title;
    /**
     * @var Asset
     */
    private $asset;

    /**
     * CreateAssetCommand constructor.
     * @param User $user
     * @param Asset $asset
     * @param string $title
     */
    public function __construct(User $user, Asset $asset, string $title)
    {
        $this->user = $user;
        $this->title = $title;
        $this->asset = $asset;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @return Asset
     */
    public function getAsset(): Asset
    {
        return $this->asset;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }
}