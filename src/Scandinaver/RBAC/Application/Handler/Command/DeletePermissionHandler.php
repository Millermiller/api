<?php


namespace Scandinaver\RBAC\Application\Handler\Command;

use Scandinaver\RBAC\UI\Command\DeletePermissionCommand;
use Scandinaver\RBAC\Domain\Contract\Command\DeletePermissionHandlerInterface;

/**
 * Class DeletePermissionHandler
 *
 * @package Scandinaver\RBAC\Application\Handler\Command
 */
class DeletePermissionHandler implements DeletePermissionHandlerInterface
{
    public function __construct()
    {

    }

    /**
     * @param DeletePermissionCommand $command
     */
    public function handle($command): void
    {
        // TODO: Implement handle() method.
    }
} 