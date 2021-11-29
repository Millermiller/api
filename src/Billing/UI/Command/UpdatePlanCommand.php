<?php


namespace Scandinaver\Billing\UI\Command;

use Scandinaver\Billing\Application\Handler\Command\UpdatePlanCommandHandler;
use Scandinaver\Core\Domain\Attribute\Command;
use Scandinaver\Core\Domain\Contract\CommandInterface;
use Scandinaver\Core\Domain\DTO;

/**
 * Class UpdatePlanCommand
 *
 * @package Scandinaver\Billing\UI\Command
 */
#[Command(UpdatePlanCommandHandler::class)]
class UpdatePlanCommand implements CommandInterface
{

    public function __construct(private int $id, private array $data)
    {
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function buildDTO(): DTO
    {
        // TODO: Implement buildDTO() method.
    }

    public function getId(): int
    {
        return $this->id;
    }
}