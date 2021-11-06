<?php


namespace Scandinaver\RBAC\UI\Command;

use Scandinaver\RBAC\Domain\DTO\RoleDTO;
use Scandinaver\Shared\Contract\CommandInterface;
use Scandinaver\Shared\DTO;

/**
 * Class CreateRoleCommand
 *
 * @package Scandinaver\RBAC\UI\Command
 *
 * @see     \Scandinaver\RBAC\Application\Handler\Command\CreateRoleCommandHandler
 */
class CreateRoleCommand implements CommandInterface
{

    private array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function buildDTO(): RoleDTO
    {
        return RoleDTO::fromArray($this->data);
    }
}