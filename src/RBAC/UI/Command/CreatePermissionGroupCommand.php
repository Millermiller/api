<?php


namespace Scandinaver\RBAC\UI\Command;

use Scandinaver\Core\Domain\Attribute\Handler;
use Scandinaver\Core\Domain\Contract\CommandInterface;
use Scandinaver\RBAC\Application\Handler\Command\CreatePermissionGroupCommandHandler;
use Scandinaver\RBAC\Domain\DTO\PermissionGroupDTO;

/**
 * Class CreatePermissionGroupCommand
 *
 * @package Scandinaver\RBAC\UI\Command
 */
#[Handler(CreatePermissionGroupCommandHandler::class)]
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