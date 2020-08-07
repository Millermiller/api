<?php


namespace Scandinaver\Common\Application\Handler\Command;

use Scandinaver\Common\Domain\Contract\Command\DeleteMetaHandlerInterface;
use Scandinaver\Common\UI\Command\DeleteMetaCommand;

/**
 * Class DeleteMetaHandler
 *
 * @package Scandinaver\Common\Application\Handler\Command
 */
class DeleteMetaHandler implements DeleteMetaHandlerInterface
{
    public function __construct()
    {

    }

    /**
     * @param  DeleteMetaCommand
     *
     * @inheritDoc
     */
    public function handle($command): void
    {
        // TODO: Implement handle() method.
    }
} 