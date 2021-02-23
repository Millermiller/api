<?php


namespace Scandinaver\Translate\Application\Handler\Command;

use Scandinaver\Shared\Contract\Command;
use Scandinaver\Translate\Domain\Contract\Command\DeleteSynonymHandlerInterface;
use Scandinaver\Translate\UI\Command\DeleteSynonymCommand;

/**
 * Class DeleteSynonymHandler
 *
 * @package Scandinaver\Translate\Application\Handler\Command
 */
class DeleteSynonymHandler implements DeleteSynonymHandlerInterface
{
    public function __construct()
    {
    }

    /**
     * @param  DeleteSynonymCommand|Command  $command
     */
    public function handle($command): void
    {
        // TODO: Implement handle() method.
    }
} 