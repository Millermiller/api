<?php


namespace Scandinaver\Common\Application\Handlers;

use Scandinaver\Common\Application\Commands\CreateMetaCommand;

/**
 * Class CreateMetaHandler
 * @package Scandinaver\Common\Application\Handlers
 */
class CreateMetaHandler implements CreateMetaHandlerInterface
{
    public function __construct()
    {

    }

    /**
     * @param CreateMetaCommand
     * @inheritDoc
     */
    public function handle($command): void
    {
        // TODO: Implement handle() method.
    }
} 