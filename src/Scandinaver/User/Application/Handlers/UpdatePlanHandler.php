<?php


namespace Scandinaver\User\Application\Handlers;

use Scandinaver\User\Application\Commands\UpdatePlanCommand;

/**
 * Class UpdatePlanHandler
 * @package Scandinaver\User\Application\Handlers
 */
class UpdatePlanHandler implements UpdatePlanHandlerInterface
{
    public function __construct()
    {

    }

    /**
     * @param UpdatePlanCommand
     * @inheritDoc
     */
    public function handle($command): void
    {
        // TODO: Implement handle() method.
    }
} 