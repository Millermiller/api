<?php


namespace Scandinaver\RBAC\UI\Command;

use Scandinaver\Core\Domain\Attribute\Command;
use Scandinaver\Core\Domain\Contract\CommandInterface;
use Scandinaver\RBAC\Application\Handler\Command\CreateRoleCommandHandler;
use Scandinaver\RBAC\Domain\DTO\RoleDTO;

/**
 * Class CreateRoleCommand
 *
 * @package Scandinaver\RBAC\UI\Command
 */
#[Command(CreateRoleCommandHandler::class)]
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