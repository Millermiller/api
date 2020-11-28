<?php


namespace Scandinaver\RBAC\UI\Command;

use Scandinaver\Shared\Contract\Command;

/**
 * Class DeletePermissionCommand
 *
 * @package Scandinaver\RBAC\UI\Command
 *
 * @see \Scandinaver\RBAC\Application\Handler\Command\DeletePermissionHandler
 */
class DeletePermissionCommand implements Command
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