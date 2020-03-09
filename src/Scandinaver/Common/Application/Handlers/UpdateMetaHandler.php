<?php


namespace Scandinaver\Common\Application\Handlers;

use Scandinaver\Common\Application\Commands\UpdateMetaCommand;

/**
 * Class UpdateMetaHandler
 * @package Scandinaver\Common\Application\Handlers
 */
class UpdateMetaHandler implements UpdateMetaHandlerInterface
{
    public function __construct()
    {

    }

    /**
     * @param UpdateMetaCommand
     * @inheritDoc
     */
    public function handle($command): void
    {
        // TODO: Implement handle() method.
    }
} 