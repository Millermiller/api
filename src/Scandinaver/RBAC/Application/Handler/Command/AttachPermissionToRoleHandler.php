<?php


namespace Scandinaver\RBAC\Application\Handler\Command;

use Scandinaver\RBAC\UI\Command\AttachPermissionToRoleCommand;
use Scandinaver\RBAC\Domain\Contract\Command\AttachPermissionToRoleHandlerInterface;

/**
 * Class AttachPermissionToRoleHandler
 *
 * @package Scandinaver\RBAC\Application\Handler\Command
 */
class AttachPermissionToRoleHandler implements AttachPermissionToRoleHandlerInterface
{
    public function __construct()
    {

    }

    /**
     * @param AttachPermissionToRoleCommand $command
     */
    public function handle($command): void
    {
        // TODO: Implement handle() method.
    }
} 