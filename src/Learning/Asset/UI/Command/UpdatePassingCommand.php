<?php


namespace Scandinaver\Learning\Asset\UI\Command;

use Scandinaver\Core\Domain\Attribute\Handler;
use Scandinaver\Core\Domain\Contract\CommandInterface;
use Scandinaver\Core\Domain\DTO;
use Scandinaver\Learning\Asset\Application\Handler\Command\UpdatePassingCommandHandler;

/**
 * Class UpdatePassingCommand
 *
 * @package Scandinaver\Learn\UI\Command
 */
#[Handler(UpdatePassingCommandHandler::class)]
class UpdatePassingCommand implements CommandInterface
{

    public function __construct(private int $id, private array $data)
    {
    }

    public function getId(): int
    {
        return $this->id;
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