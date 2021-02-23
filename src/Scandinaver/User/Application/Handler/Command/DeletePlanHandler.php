<?php


namespace Scandinaver\User\Application\Handler\Command;

use Scandinaver\Shared\Contract\Command;
use Scandinaver\User\Domain\Contract\Command\DeletePlanHandlerInterface;
use Scandinaver\User\UI\Command\DeletePlanCommand;

/**
 * Class DeletePlanHandler
 *
 * @package Scandinaver\User\Application\Handler\Command
 */
class DeletePlanHandler implements DeletePlanHandlerInterface
{
    public function __construct()
    {
    }

    /**
     * @param  DeletePlanCommand|Command  $command
     */
    public function handle($command): void
    {
        // TODO: Implement handle() method.
    }
} 