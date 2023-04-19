<?php


namespace Scandinaver\RBAC\UI\Command;

use Scandinaver\Core\Domain\Attribute\Handler;
use Scandinaver\Core\Domain\Contract\CommandInterface;
use Scandinaver\Core\Domain\DTO;
use Scandinaver\RBAC\Application\Handler\Command\UpdatePermissionCommandHandler;

/**
 * Class UpdatePermissionCommand
 *
 * @package Scandinaver\RBAC\UI\Command
 */
#[Handler(UpdatePermissionCommandHandler::class)]
class UpdatePermissionCommand implements CommandInterface
{

    public function __construct(private int $id, private array $data)
    {
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function buildDTO(): DTO
    {
        // TODO: Implement buildDTO() method.
    }
}