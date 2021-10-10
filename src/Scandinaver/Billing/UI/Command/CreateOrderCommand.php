<?php


namespace Scandinaver\Billing\UI\Command;

use Scandinaver\Common\Domain\Contract\UserInterface;
use Scandinaver\Billing\Domain\DTO\OrderDTO;
use Scandinaver\Shared\Contract\CommandInterface;
use Scandinaver\Shared\DTO;

/**
 * Class CreateOrderCommand
 *
 * @package Scandinaver\Billing\UI\Command
 *
 * @see \Scandinaver\Billing\Application\Handler\Command\CreateOrderCommandHandler
 */
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