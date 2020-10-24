<?php


namespace Scandinaver\Learn\UI\Command;

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

    private int $asset;

    private int $resultValue;

    public function __construct(User $user, int $asset, int $resultValue)
    {
        $this->user = $user;
        $this->asset = $asset;
        $this->resultValue = $resultValue;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function getAsset(): int
    {
        return $this->asset;
    }

    public function getResultValue(): int
    {
        return $this->resultValue;
    }
}