<?php


namespace Scandinaver\RBAC\UI\Command;

use Scandinaver\RBAC\Domain\DTO\PermissionGroupDTO;
use Scandinaver\Shared\Contract\CommandInterface;

/**
 * Class CreatePermissionGroupCommand
 *
 * @package Scandinaver\RBAC\UI\Command
 *
 * @see     \Scandinaver\RBAC\Application\Handler\Command\CreatePermissionGroupCommandHandler
 */
class CreatePermissionGroupCommand implements CommandInterface
{

    private array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function buildDTO(): PermissionGroupDTO
    {
        return PermissionGroupDTO::fromArray($this->data);
    }
}