<?php


namespace Scandinaver\Common\Application\Handlers;

use Scandinaver\Common\Application\Commands\DeleteMessageCommand;

/**
 * Class DeleteMessageHandler
 * @package Scandinaver\Common\Application\Handlers
 */
class DeleteMessageHandler implements DeleteMessageHandlerInterface
{
    public function __construct()
    {

    }

    /**
     * @param DeleteMessageCommand
     * @inheritDoc
     */
    public function handle($command): void
    {
        // TODO: Implement handle() method.
    }
} 