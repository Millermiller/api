<?php


namespace Scandinaver\Translate\Application\Handler\Command;

use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\CommandInterface;
use Scandinaver\Translate\UI\Command\UpdateDescriptionCommand;

/**
 * Class UpdateDescriptionCommandHandler
 *
 * @package Scandinaver\Translate\Application\Handler\Command
 */
class UpdateDescriptionCommandHandler extends AbstractHandler
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param  UpdateDescriptionCommand|CommandInterface  $command
     */
    public function handle(CommandInterface $command): void
    {
        // TODO: Implement handle() method.
    }
} 