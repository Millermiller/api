<?php


namespace Scandinaver\RBAC\UI\Command;

use Scandinaver\Shared\Contract\CommandInterface;

/**
 * Class DeletePermissionCommand
 *
 * @package Scandinaver\RBAC\UI\Command
 *
 * @see     \Scandinaver\RBAC\Application\Handler\Command\DeletePermissionCommandHandler
 */
class DeletePermissionCommand implements CommandInterface
{
    private int $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }
}