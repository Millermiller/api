<?php


namespace Scandinaver\Common\Application\Handlers;

use Scandinaver\Common\Application\Commands\UpdateMessageCommand;

/**
 * Class UpdateMessageHandler
 * @package Scandinaver\Common\Application\Handlers
 */
class UpdateMessageHandler implements UpdateMessageHandlerInterface
{
    public function __construct()
    {

    }

    /**
     * @param UpdateMessageCommand
     * @inheritDoc
     */
    public function handle($command): void
    {
        // TODO: Implement handle() method.
    }
} 