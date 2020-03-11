<?php


namespace Scandinaver\Common\Application\Handlers;

use Scandinaver\Common\Application\Commands\CreateMessageCommand;

/**
 * Class CreateMessageHandler
 * @package Scandinaver\Common\Application\Handlers
 */
class CreateMessageHandler implements CreateMessageHandlerInterface
{
    public function __construct()
    {

    }

    /**
     * @param CreateMessageCommand
     * @inheritDoc
     */
    public function handle($command): void
    {
        // TODO: Implement handle() method.
    }
} 