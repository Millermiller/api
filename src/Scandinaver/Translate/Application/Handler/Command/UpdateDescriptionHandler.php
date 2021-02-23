<?php


namespace Scandinaver\Translate\Application\Handler\Command;

use Scandinaver\Shared\Contract\Command;
use Scandinaver\Translate\Domain\Contract\Command\UpdateDescriptionHandlerInterface;
use Scandinaver\Translate\UI\Command\UpdateDescriptionCommand;

/**
 * Class UpdateDescriptionHandler
 *
 * @package Scandinaver\Translate\Application\Handler\Command
 */
class UpdateDescriptionHandler implements UpdateDescriptionHandlerInterface
{
    public function __construct()
    {
    }

    /**
     * @param  UpdateDescriptionCommand|Command  $command
     */
    public function handle($command): void
    {
        // TODO: Implement handle() method.
    }
} 