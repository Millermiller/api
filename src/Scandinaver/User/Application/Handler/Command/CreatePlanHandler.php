<?php


namespace Scandinaver\User\Application\Handler\Command;

use Scandinaver\Shared\Contract\Command;
use Scandinaver\User\Domain\Contract\Command\CreatePlanHandlerInterface;
use Scandinaver\User\UI\Command\CreatePlanCommand;

/**
 * Class CreatePlanHandler
 *
 * @package Scandinaver\User\Application\Handler\Command
 */
class CreatePlanHandler implements CreatePlanHandlerInterface
{
    public function __construct()
    {
    }

    /**
     * @param  CreatePlanCommand|Command  $command
     */
    public function handle($command): void
    {
        // TODO: Implement handle() method.
    }
} 