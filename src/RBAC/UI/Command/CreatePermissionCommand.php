<?php


namespace Scandinaver\RBAC\UI\Command;

use Scandinaver\RBAC\Domain\DTO\PermissionDTO;
use Scandinaver\Shared\Contract\CommandInterface;
use Scandinaver\Shared\DTO;

/**
 * Class CreatePermissionCommand
 *
 * @package Scandinaver\RBAC\UI\Command
 *
 * @see     \Scandinaver\RBAC\Application\Handler\Command\CreatePermissionCommandHandler
 */
class CreatePermissionCommand implements CommandInterface
{

    private array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function buildDTO(): DTO
    {
        return PermissionDTO::fromArray($this->data);
    }
}