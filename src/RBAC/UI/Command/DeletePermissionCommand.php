<?php


namespace Scandinaver\RBAC\UI\Command;

use Scandinaver\Core\Domain\Attribute\Command;
use Scandinaver\Core\Domain\Contract\CommandInterface;
use Scandinaver\Core\Domain\DTO;
use Scandinaver\RBAC\Application\Handler\Command\DeletePermissionCommandHandler;

/**
 * Class DeletePermissionCommand
 *
 * @package Scandinaver\RBAC\UI\Command
 */
#[Command(DeletePermissionCommandHandler::class)]
class DeletePermissionCommand implements CommandInterface
{

    public function __construct(private int $id)
    {
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