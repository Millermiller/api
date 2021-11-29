<?php


namespace Scandinaver\Billing\UI\Command;

use Scandinaver\Billing\Application\Handler\Command\UpdateOrderCommandHandler;
use Scandinaver\Billing\Domain\DTO\OrderDTO;
use Scandinaver\Core\Domain\Attribute\Command;
use Scandinaver\Core\Domain\Contract\CommandInterface;

/**
 * Class UpdateOrderCommand
 *
 * @package Scandinaver\Billing\UI\Command
 */
#[Command(UpdateOrderCommandHandler::class)]
class UpdateOrderCommand implements CommandInterface
{

    public function __construct(private int $id, private array $data)
    {

    }

    public function getId(): int
    {
        return $this->id;
    }

    public function buildDTO(): OrderDTO
    {
        return OrderDTO::fromArray($this->data);
    }
}