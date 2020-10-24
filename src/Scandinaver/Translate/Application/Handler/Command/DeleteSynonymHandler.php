<?php


namespace Scandinaver\Translate\Application\Handler\Command;

use Scandinaver\Translate\UI\Command\DeleteSynonymCommand;
use Scandinaver\Translate\Domain\Contract\Command\DeleteSynonymHandlerInterface;

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
     * @param  DeleteSynonymCommand  $command
     *
     */
    public function handle($command): void
    {
        // TODO: Implement handle() method.
    }
} 