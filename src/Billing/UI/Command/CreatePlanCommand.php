<?php


namespace Scandinaver\Billing\UI\Command;

use Scandinaver\Billing\Application\Handler\Command\CreatePlanCommandHandler;
use Scandinaver\Core\Domain\Attribute\Command;
use Scandinaver\Core\Domain\Contract\CommandInterface;
use Scandinaver\Core\Domain\DTO;

/**
 * Class CreatePlanCommand
 *
 * @package Scandinaver\Billing\UI\Command
 */
#[Command(CreatePlanCommandHandler::class)]
class CreatePlanCommand implements CommandInterface
{

    public function __construct(private array $data)
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
}