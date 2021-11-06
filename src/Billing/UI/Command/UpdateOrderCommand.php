<?php


namespace Scandinaver\Billing\UI\Command;

use Scandinaver\Billing\Domain\DTO\OrderDTO;
use Scandinaver\Shared\Contract\CommandInterface;

/**
 * Class UpdateOrderCommand
 *
 * @package Scandinaver\Billing\UI\Command
 *
 * @see \Scandinaver\Billing\Application\Handler\Command\UpdateOrderCommandHandler
 */
class UpdateOrderCommand implements CommandInterface
{

    private int $id;
    private array $data;

    public function __construct(int $id, array $data)
    {

        $this->id = $id;
        $this->data = $data;
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