<?php


namespace Scandinaver\RBAC\UI\Command;

use Scandinaver\Shared\Contract\CommandInterface;

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

    public function getData(): array
    {
        return $this->data;
    }
}