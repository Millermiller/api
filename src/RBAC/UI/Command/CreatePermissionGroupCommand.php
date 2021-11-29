<?php


namespace Scandinaver\RBAC\UI\Command;

use Scandinaver\Core\Domain\Attribute\Command;
use Scandinaver\Core\Domain\Contract\CommandInterface;
use Scandinaver\RBAC\Application\Handler\Command\CreatePermissionCommandHandler;
use Scandinaver\RBAC\Domain\DTO\PermissionGroupDTO;

/**
 * Class CreatePermissionGroupCommand
 *
 * @package Scandinaver\RBAC\UI\Command
 */
#[Command(CreatePermissionCommandHandler::class)]
class CreatePermissionGroupCommand implements CommandInterface
{

    public function __construct(private array $data)
    {
    }

    public function buildDTO(): PermissionGroupDTO
    {
        return PermissionGroupDTO::fromArray($this->data);
    }
}