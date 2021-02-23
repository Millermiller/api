<?php


namespace Scandinaver\Learn\UI\Command;

use Scandinaver\Shared\Contract\Command;
use Scandinaver\User\Domain\Model\User;

/**
 * Class SaveTestResultCommand
 *
 * @package Scandinaver\Learn\UI\Command
 *
 * @see     \Scandinaver\Learn\Application\Handler\Command\CompleteTestHandler
 */
class CompleteTestCommand implements Command
{
    private User $user;

    private int $asset;

    private array $data;

    public function __construct(User $user, int $asset, array $data)
    {
        $this->user  = $user;
        $this->asset = $asset;
        $this->data  = $data;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function getAsset(): int
    {
        return $this->asset;
    }

    public function getData(): array
    {
        return $this->data;
    }
}