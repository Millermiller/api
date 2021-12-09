<?php


namespace Scandinaver\Common\Application\Handler\Command;

use Scandinaver\Common\UI\Command\UpdateMessageCommand;
use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Core\Domain\Contract\CommandInterface;

/**
 * Class UpdateMessageCommandHandler
 *
 * @package Scandinaver\Common\Application\Handler\Command
 */
class UpdateMessageCommandHandler extends AbstractHandler
{
    public function __construct()
    {
        parent::__construct();
    }

    public function handle(CommandInterface|UpdateMessageCommand $command): void
    {
        // TODO: Implement handle() method.
    }
} 