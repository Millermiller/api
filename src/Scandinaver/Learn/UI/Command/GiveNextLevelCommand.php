<?php


namespace Scandinaver\Learn\UI\Command;

use Scandinaver\Shared\Contract\Command;
use Scandinaver\User\Domain\Model\User;

/**
 * Class GiveNextLevelCommand
 *
 * @see     \Scandinaver\Learn\Application\Handler\Command\GiveNextLevelHandler
 * @package Scandinaver\Learn\UI\Command
 */
class GiveNextLevelCommand implements Command
{
    private User $user;

    private int $asset;

    public function __construct(User $user, int $asset)
    {
        $this->user = $user;
        $this->asset = $asset;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function getAsset(): int
    {
        return $this->asset;
    }
}