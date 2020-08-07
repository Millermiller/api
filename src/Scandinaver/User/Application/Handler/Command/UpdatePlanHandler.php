<?php


namespace Scandinaver\User\Application\Handler\Command;

use Scandinaver\User\Domain\Contract\Command\UpdatePlanHandlerInterface;
use Scandinaver\User\UI\Command\UpdatePlanCommand;

/**
 * Class UpdatePlanHandler
 *
 * @package Scandinaver\User\Application\Handler\Command
 */
class UpdatePlanHandler implements UpdatePlanHandlerInterface
{
    public function __construct()
    {

    }

    /**
     * @param  UpdatePlanCommand
     *
     * @inheritDoc
     */
    public function handle($command): void
    {
        // TODO: Implement handle() method.
    }
} 