<?php


namespace Scandinaver\RBAC\Application\Handler\Command;

use Scandinaver\RBAC\UI\Command\CreateRoleCommand;
use Scandinaver\RBAC\Domain\Contract\Command\CreateRoleHandlerInterface;

/**
 * Class CreateRoleHandler
 *
 * @package Scandinaver\RBAC\Application\Handler\Command
 */
class CreateRoleHandler implements CreateRoleHandlerInterface
{
    public function __construct()
    {

    }

    /**
     * @param CreateRoleCommand $command
     */
    public function handle($command): void
    {
        // TODO: Implement handle() method.
    }
} 