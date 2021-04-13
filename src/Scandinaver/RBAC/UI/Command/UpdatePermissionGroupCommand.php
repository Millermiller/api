<?php


namespace Scandinaver\RBAC\UI\Command;

use Scandinaver\Shared\Contract\Command;

/**
 * Class UpdatePermissionGroupCommand
 *
 * @package Scandinaver\RBAC\UI\Command
 *
 * @see     \Scandinaver\RBAC\Application\Handler\Command\UpdatePermissionGroupHandler
 */
class UpdatePermissionGroupCommand implements Command
{
    private int $id;

    private array $data;

    public function __construct(int $id, array $data)
    {
        $this->id   = $id;
        $this->data = $data;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getData(): array
    {
        return $this->data;
    }
}