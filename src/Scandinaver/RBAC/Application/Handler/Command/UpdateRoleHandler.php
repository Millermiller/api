<?php


namespace Scandinaver\RBAC\Application\Handler\Command;

use Scandinaver\RBAC\UI\Command\UpdateRoleCommand;
use Scandinaver\RBAC\Domain\Contract\Command\UpdateRoleHandlerInterface;

/**
 * Class UpdateRoleHandler
 *
 * @package Scandinaver\RBAC\Application\Handler\Command
 */
class UpdateRoleHandler implements UpdateRoleHandlerInterface
{
    public function __construct()
    {

    }

    /**
     * @param UpdateRoleCommand $command
     */
    public function handle($command): void
    {
        // TODO: Implement handle() method.
    }
} 