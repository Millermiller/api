<?php


namespace Scandinaver\Common\Application\Handler\Command;

use Scandinaver\Common\Domain\Contract\Command\UpdateMessageHandlerInterface;
use Scandinaver\Common\UI\Command\UpdateMessageCommand;
use Scandinaver\Shared\Contract\Command;

/**
 * Class UpdateMessageHandler
 *
 * @package Scandinaver\Common\Application\Handler\Command
 */
class UpdateMessageHandler implements UpdateMessageHandlerInterface
{
    public function __construct()
    {
    }

    /**
     * @param  UpdateMessageCommand|Command  $command
     */
    public function handle($command): void
    {
        // TODO: Implement handle() method.
    }
} 