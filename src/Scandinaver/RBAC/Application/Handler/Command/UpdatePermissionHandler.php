<?php


namespace Scandinaver\RBAC\Application\Handler\Command;

use Scandinaver\RBAC\UI\Command\UpdatePermissionCommand;
use Scandinaver\RBAC\Domain\Contract\Command\UpdatePermissionHandlerInterface;

/**
 * Class UpdatePermissionHandler
 *
 * @package Scandinaver\RBAC\Application\Handler\Command
 */
class UpdatePermissionHandler implements UpdatePermissionHandlerInterface
{
    public function __construct()
    {

    }

    /**
     * @param UpdatePermissionCommand $command
     */
    public function handle($command): void
    {
        // TODO: Implement handle() method.
    }
} 