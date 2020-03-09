<?php


namespace Scandinaver\User\Application\Handlers;

use Scandinaver\User\Application\Commands\CreatePlanCommand;

/**
 * Class CreatePlanHandler
 * @package Scandinaver\User\Application\Handlers
 */
class CreatePlanHandler implements CreatePlanHandlerInterface
{
    public function __construct()
    {

    }

    /**
     * @param CreatePlanCommand
     * @inheritDoc
     */
    public function handle($command): void
    {
        // TODO: Implement handle() method.
    }
} 