<?php


namespace Scandinaver\Translate\Application\Handler\Command;

use Scandinaver\Translate\UI\Command\CreateTextCommand;
use Scandinaver\Translate\Domain\Contract\Command\CreateTextHandlerInterface;

/**
 * Class CreateTextHandler
 *
 * @package Scandinaver\Translate\Application\Handler\Command
 */
class CreateTextHandler implements CreateTextHandlerInterface
{
    public function __construct()
    {

    }

    /**
     * @param $command CreateTextCommand
     *
     * @inheritDoc
     */
    public function handle($command): void
    {
        // TODO: Implement handle() method.
    }
} 