<?php


namespace Scandinaver\Translate\Application\Handler\Command;

use Scandinaver\Translate\UI\Command\UpdateDescriptionCommand;
use Scandinaver\Translate\Domain\Contract\Command\UpdateDescriptionHandlerInterface;

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
     * @param $command UpdateDescriptionCommand
     *
     * @inheritDoc
     */
    public function handle($command): void
    {
        // TODO: Implement handle() method.
    }
} 