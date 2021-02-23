<?php


namespace Scandinaver\Translate\Application\Handler\Command;

use Scandinaver\Shared\Contract\Command;
use Scandinaver\Translate\Domain\Contract\Command\DeleteTextHandlerInterface;
use Scandinaver\Translate\UI\Command\DeleteTextCommand;

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
     * @param  DeleteTextCommand|Command  $command
     */
    public function handle($command): void
    {
        // TODO: Implement handle() method.
    }
} 