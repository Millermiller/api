<?php


namespace Scandinaver\Translate\Application\Handler\Command;

use Scandinaver\Translate\UI\Command\DeleteTextCommand;
use Scandinaver\Translate\Domain\Contract\Command\DeleteTextHandlerInterface;

/**
 * Class DeleteTextHandler
 *
 * @package Scandinaver\Translate\Application\Handler\Command
 */
class DeleteTextHandler implements DeleteTextHandlerInterface
{
    public function __construct()
    {

    }

    /**
     * @param $command DeleteTextCommand
     *
     * @inheritDoc
     */
    public function handle($command): void
    {
        // TODO: Implement handle() method.
    }
} 