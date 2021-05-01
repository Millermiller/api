<?php


namespace Scandinaver\RBAC\UI\Command;

use Scandinaver\Shared\Contract\CommandInterface;

/**
 * Class UpdateRoleCommand
 *
 * @package Scandinaver\RBAC\UI\Command
 *
 * @see     \Scandinaver\RBAC\Application\Handler\Command\UpdateRoleCommandHandler
 */
class UpdateRoleCommand implements CommandInterface
{
    private int $id;

    private array $data;

    public function __construct(int $id, array $data)
    {
        $this->id   = $id;
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