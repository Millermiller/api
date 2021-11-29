<?php


namespace Scandinaver\Billing\UI\Command;

use Scandinaver\Billing\Application\Handler\Command\CreateOrderCommandHandler;
use Scandinaver\Core\Domain\Attribute\Command;
use Scandinaver\Core\Domain\Contract\UserInterface;
use Scandinaver\Billing\Domain\DTO\OrderDTO;
use Scandinaver\Core\Domain\Contract\CommandInterface;
use Scandinaver\Core\Domain\DTO;

/**
 * Class CreateOrderCommand
 *
 * @package Scandinaver\Billing\UI\Command
 */
#[Command(CreateOrderCommandHandler::class)]
class CreateOrderCommand implements CommandInterface
{

    private array $data;

    private UserInterface $user;

    public function __construct(array $data, UserInterface $user)
    {
        $this->data = $data;
        $this->user = $user;
    }

    public function buildDTO(): DTO
    {
        $this->data['user'] = $this->user;

        return OrderDTO::fromArray($this->data);
    }
}