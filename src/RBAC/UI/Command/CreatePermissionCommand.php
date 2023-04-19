<?php


namespace Scandinaver\RBAC\UI\Command;

use Scandinaver\Core\Domain\Attribute\Handler;
use Scandinaver\Core\Domain\Contract\CommandInterface;
use Scandinaver\RBAC\Application\Handler\Command\CreatePermissionCommandHandler;
use Scandinaver\RBAC\Domain\DTO\PermissionDTO;

/**
 * Class CreatePermissionCommand
 *
 * @package Scandinaver\RBAC\UI\Command
 */
#[Handler(CreatePermissionCommandHandler::class)]
class CreatePermissionCommand implements CommandInterface
{

    public function __construct(private array $data)
    {
    }

    public function buildDTO(): PermissionDTO
    {
        return PermissionDTO::fromArray($this->data);
    }
}