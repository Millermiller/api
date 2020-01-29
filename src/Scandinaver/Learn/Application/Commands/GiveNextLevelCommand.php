<?php


namespace Scandinaver\Learn\Application\Commands;

use Scandinaver\User\Domain\User;
use Scandinaver\Learn\Domain\Asset;
use Scandinaver\Shared\Contracts\Command;

/**
 * Class GiveNextLevelCommand
 * @package Scandinaver\Learn\Application\Commands
 */
class GiveNextLevelCommand implements Command
{
    /**
     * @var User
     */
    private $user;

    /**
     * @var Asset
     */
    private $asset;

    /**
     * GiveNextLevelCommand constructor.
     * @param User $user
     * @param Asset $asset
     */
    public function __construct(User $user, Asset $asset)
    {
        $this->user = $user;
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
}