<?php


namespace Scandinaver\RBAC\Application\Handler\Command;

use Scandinaver\RBAC\UI\Command\DetachPermissionFromRoleCommand;
use Scandinaver\RBAC\Domain\Contract\Command\DetachPermissionFromRoleHandlerInterface;

/**
 * Class DetachPermissionFromRoleHandler
 *
 * @package Scandinaver\RBAC\Application\Handler\Command
 */
class DetachPermissionFromRoleHandler implements DetachPermissionFromRoleHandlerInterface
{
    public function __construct()
    {

    }

    /**
     * @param DetachPermissionFromRoleCommand $command
     */
    public function handle($command): void
    {
        // TODO: Implement handle() method.
    }
} 