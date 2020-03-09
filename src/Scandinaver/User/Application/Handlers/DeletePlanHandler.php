<?php


namespace Scandinaver\User\Application\Handlers;

use Scandinaver\User\Application\Commands\DeletePlanCommand;

/**
 * Class DeletePlanHandler
 * @package Scandinaver\User\Application\Handlers
 */
class DeletePlanHandler implements DeletePlanHandlerInterface
{
    public function __construct()
    {

    }

    /**
     * @param DeletePlanCommand
     * @inheritDoc
     */
    public function handle($command): void
    {
        // TODO: Implement handle() method.
    }
} 