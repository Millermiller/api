<?php


namespace Scandinaver\RBAC\UI\Command;

use Scandinaver\Shared\Contract\Command;

/**
 * Class UpdatePermissionCommand
 *
 * @package Scandinaver\RBAC\UI\Command
 *
 * @see \Scandinaver\RBAC\Application\Handler\Command\UpdatePermissionHandler
 */
class UpdatePermissionCommand implements Command
{
    private int $id;

    private array $data;

    public function __construct(int $id, array $data)
    {
        $this->id = $id;
        $this->data = $data;
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function getId(): int
    {
        return $this->id;
    }
}