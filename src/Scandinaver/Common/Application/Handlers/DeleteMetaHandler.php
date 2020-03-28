<?php


namespace Scandinaver\Common\Application\Handlers;

use Scandinaver\Common\Application\Commands\DeleteMetaCommand;

/**
 * Class DeleteMetaHandler
 *
 * @package Scandinaver\Common\Application\Handlers
 */
class DeleteMetaHandler implements DeleteMetaHandlerInterface
{
    public function __construct()
    {

    }

    /**
     * @param DeleteMetaCommand
     *
     * @inheritDoc
     */
    public function handle($command): void
    {
        // TODO: Implement handle() method.
    }
} 