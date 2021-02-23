<?php


namespace Scandinaver\Translate\Application\Handler\Command;

use Scandinaver\Shared\Contract\Command;
use Scandinaver\Translate\Domain\Contract\Command\CreateTextHandlerInterface;
use Scandinaver\Translate\UI\Command\CreateTextCommand;

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
     * @param  CreateTextCommand|Command  $command
     */
    public function handle($command): void
    {
        // TODO: Implement handle() method.
    }
} 