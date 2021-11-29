<?php


namespace Scandinaver\Learning\Asset\UI\Command;

use Scandinaver\Core\Domain\Attribute\Command;
use Scandinaver\Core\Domain\Contract\CommandInterface;
use Scandinaver\Core\Domain\Contract\UserInterface;
use Scandinaver\Core\Domain\DTO;
use Scandinaver\Learning\Asset\Application\Handler\Command\CompleteTestCommandHandler;

/**
 * Class SaveTestResultCommand
 *
 * @package Scandinaver\Learn\UI\Command
 */
#[Command(CompleteTestCommandHandler::class)]
class CompleteTestCommand implements CommandInterface
{

    public function __construct(
        private UserInterface $user,
        private int $asset,
        private array $data
    ) {
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

    public function buildDTO(): DTO
    {
        // TODO: Implement buildDTO() method.
    }
}