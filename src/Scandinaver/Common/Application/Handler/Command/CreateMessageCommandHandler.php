<?php


namespace Scandinaver\Common\Application\Handler\Command;

use Scandinaver\Common\UI\Command\CreateMessageCommand;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\CommandInterface;

/**
 * Class CreateMessageCommandHandler
 *
 * @package Scandinaver\Common\Application\Handler\Command
 */
class CreateMessageCommandHandler extends AbstractHandler
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param  CreateMessageCommand|CommandInterface  $command
     */
    public function handle(CommandInterface $command): void
    {
        // TODO: Implement handle() method.
    }
} 