<?php


namespace Scandinaver\Common\Application\Handler\Command;

use Scandinaver\Common\Domain\Contract\Command\DeleteMessageHandlerInterface;
use Scandinaver\Common\UI\Command\DeleteMessageCommand;

/**
 * Class DeleteMessageHandler
 *
 * @package Scandinaver\Common\Application\Handler\Command
 */
class DeleteMessageHandler implements DeleteMessageHandlerInterface
{
    public function __construct()
    {

    }

    /**
     * @param  DeleteMessageCommand
     *
     * @inheritDoc
     */
    public function handle($command): void
    {
        // TODO: Implement handle() method.
    }
} 