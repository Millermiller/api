<?php


namespace Scandinaver\RBAC\Application\Handler\Command;

use Scandinaver\RBAC\UI\Command\CreatePermissionCommand;
use Scandinaver\RBAC\Domain\Contract\Command\CreatePermissionHandlerInterface;

/**
 * Class CreatePermissionHandler
 *
 * @package Scandinaver\RBAC\Application\Handler\Command
 */
class CreatePermissionHandler implements CreatePermissionHandlerInterface
{
    public function __construct()
    {

    }

    /**
     * @param CreatePermissionCommand $command
     */
    public function handle($command): void
    {
        // TODO: Implement handle() method.
    }
} 