<?php


namespace Scandinaver\Translate\Application\Handler\Command;

use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\Command;
use Scandinaver\Translate\Domain\Contract\Command\DeleteSynonymHandlerInterface;
use Scandinaver\Translate\UI\Command\DeleteSynonymCommand;

/**
 * Class DeleteSynonymHandler
 *
 * @package Scandinaver\Translate\Application\Handler\Command
 */
class DeleteSynonymHandler extends AbstractHandler implements DeleteSynonymHandlerInterface
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param  DeleteSynonymCommand|Command  $command
     */
    public function handle($command): void
    {
        // TODO: Implement handle() method.
    }
} 