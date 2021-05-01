<?php


namespace Scandinaver\Translate\Application\Handler\Command;

use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\CommandInterface;
use Scandinaver\Translate\UI\Command\DeleteSynonymCommand;

/**
 * Class DeleteSynonymCommandHandler
 *
 * @package Scandinaver\Translate\Application\Handler\Command
 */
class DeleteSynonymCommandHandler extends AbstractHandler
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param  DeleteSynonymCommand|CommandInterface  $command
     */
    public function handle(CommandInterface $command): void
    {
        // TODO: Implement handle() method.
    }
} 