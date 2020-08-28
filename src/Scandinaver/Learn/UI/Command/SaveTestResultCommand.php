<?php


namespace Scandinaver\Learn\UI\Command;

use Scandinaver\Learn\Domain\Model\Asset;
use Scandinaver\Shared\Contract\Command;
use Scandinaver\User\Domain\Model\User;

/**
 * Class SaveTestResultCommand
 *
 * @see     \Scandinaver\Learn\Application\Handler\Command\SaveTestResultHandler
 * @package Scandinaver\Learn\UI\Command
 */
class SaveTestResultCommand implements Command
{
    private User $user;

    private Asset $asset;

    private int $resultValue;

    public function __construct(User $user, Asset $asset, int $resultValue)
    {
        $this->user = $user;
        $this->asset = $asset;
        $this->resultValue = $resultValue;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function getAsset(): Asset
    {
        return $this->asset;
    }

    public function getResultValue(): int
    {
        return $this->resultValue;
    }
}