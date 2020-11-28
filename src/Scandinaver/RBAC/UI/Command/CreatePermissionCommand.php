<?php


namespace Scandinaver\RBAC\UI\Command;

use Scandinaver\Shared\Contract\Command;

/**
 * Class CreatePermissionCommand
 *
 * @package Scandinaver\RBAC\UI\Command
 *
 * @see \Scandinaver\RBAC\Application\Handler\Command\CreatePermissionHandler
 */
class CreatePermissionCommand implements Command
{
    private array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function getData(): array
    {
        return $this->data;
    }
}