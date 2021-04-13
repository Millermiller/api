<?php


namespace Scandinaver\Common\Application\Handler\Command;

use Scandinaver\Common\Domain\Contract\Command\UpdateMessageHandlerInterface;
use Scandinaver\Common\UI\Command\UpdateMessageCommand;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\Command;

/**
 * Class UpdateMessageHandler
 *
 * @package Scandinaver\Common\Application\Handler\Command
 */
class UpdateMessageHandler extends AbstractHandler implements UpdateMessageHandlerInterface
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param  UpdateMessageCommand|Command  $command
     */
    public function handle($command): void
    {
        // TODO: Implement handle() method.
    }
} 