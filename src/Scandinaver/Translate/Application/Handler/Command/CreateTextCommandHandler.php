<?php


namespace Scandinaver\Translate\Application\Handler\Command;

use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\CommandInterface;
use Scandinaver\Translate\UI\Command\CreateTextCommand;

/**
 * Class CreateTextCommandHandler
 *
 * @package Scandinaver\Translate\Application\Handler\Command
 */
class CreateTextCommandHandler extends AbstractHandler
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param  CreateTextCommand|CommandInterface  $command
     */
    public function handle(CommandInterface $command): void
    {
        // TODO: Implement handle() method.
    }
} 