<?php


namespace Scandinaver\Billing\UI\Command;

use Scandinaver\Billing\Application\Handler\Command\DeleteOrderCommandHandler;
use Scandinaver\Core\Domain\Attribute\Handler;
use Scandinaver\Core\Domain\Contract\CommandInterface;
use Scandinaver\Core\Domain\DTO;

/**
 * Class DeleteOrderCommand
 *
 * @package Scandinaver\Billing\UI\Command
 */
#[Handler(DeleteOrderCommandHandler::class)]
class DeleteOrderCommand implements CommandInterface
{

    public function __construct(private int $id)
    {

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