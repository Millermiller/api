<?php


namespace Scandinaver\RBAC\Application\Handler\Command;

use Scandinaver\RBAC\UI\Command\DeleteRoleCommand;
use Scandinaver\RBAC\Domain\Contract\Command\DeleteRoleHandlerInterface;

/**
 * Class DeleteRoleHandler
 *
 * @package Scandinaver\RBAC\Application\Handler\Command
 */
class DeleteRoleHandler implements DeleteRoleHandlerInterface
{
    public function __construct()
    {

    }

    /**
     * @param DeleteRoleCommand $command
     */
    public function handle($command): void
    {
        // TODO: Implement handle() method.
    }
} 