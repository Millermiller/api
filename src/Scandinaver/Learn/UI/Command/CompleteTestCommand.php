<?php


namespace Scandinaver\Learn\UI\Command;

use Scandinaver\Common\Domain\Contract\UserInterface;
use Scandinaver\Shared\Contract\CommandInterface;

/**
 * Class SaveTestResultCommand
 *
 * @package Scandinaver\Learn\UI\Command
 *
 * @see     \Scandinaver\Learn\Application\Handler\Command\CompleteTestCommandHandler
 */
class CompleteTestCommand implements CommandInterface
{
    private UserInterface $user;

    private int $asset;

    private array $data;

    public function __construct(UserInterface $user, int $asset, array $data)
    {
        $this->user  = $user;
        $this->asset = $asset;
        $this->data  = $data;
    }

    public function getUser(): UserInterface
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