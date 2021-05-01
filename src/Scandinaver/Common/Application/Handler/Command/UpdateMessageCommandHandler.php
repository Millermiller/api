<?php


namespace Scandinaver\Common\Application\Handler\Command;

use Scandinaver\Common\UI\Command\UpdateMessageCommand;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\CommandInterface;

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

    /**
     * @param  UpdateMessageCommand|CommandInterface  $command
     */
    public function handle(CommandInterface $command): void
    {
        // TODO: Implement handle() method.
    }
} 