<?php


namespace Scandinaver\Translate\Application\Handler\Command;

use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\CommandInterface;
use Scandinaver\Translate\UI\Command\PublishTextCommand;

/**
 * Class PublishTextCommandHandler
 *
 * @package Scandinaver\Translate\Application\Handler\Command
 */
class PublishTextCommandHandler extends AbstractHandler
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param  PublishTextCommand|CommandInterface  $command
     */
    public function handle(CommandInterface $command): void
    {
        // TODO: Implement handle() method.
    }
} 