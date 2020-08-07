<?php


namespace Scandinaver\Common\Application\Handler\Command;

use Scandinaver\Common\Domain\Contract\Command\CreateMessageHandlerInterface;
use Scandinaver\Common\UI\Command\CreateMessageCommand;

/**
 * Class CreateMessageHandler
 *
 * @package Scandinaver\Common\Application\Handler\Command
 */
class CreateMessageHandler implements CreateMessageHandlerInterface
{
    public function __construct()
    {

    }

    /**
     * @param  CreateMessageCommand  $command
     */
    public function handle($command): void
    {
        // TODO: Implement handle() method.
    }
} 