<?php


namespace Scandinaver\RBAC\UI\Command;

use Scandinaver\Core\Domain\Attribute\Command;
use Scandinaver\Core\Domain\Contract\CommandInterface;
use Scandinaver\Core\Domain\DTO;
use Scandinaver\RBAC\Application\Handler\Command\UpdateRoleCommandHandler;

/**
 * Class UpdateRoleCommand
 *
 * @package Scandinaver\RBAC\UI\Command
 */
#[Command(UpdateRoleCommandHandler::class)]
class UpdateRoleCommand implements CommandInterface
{

    public function __construct(private int $id, private array $data)
    {
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function buildDTO(): DTO
    {
        // TODO: Implement buildDTO() method.
    }
}