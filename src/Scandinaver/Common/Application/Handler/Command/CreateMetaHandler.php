<?php


namespace Scandinaver\Common\Application\Handler\Command;

use Scandinaver\Common\Domain\Contract\Command\CreateMetaHandlerInterface;
use Scandinaver\Common\UI\Command\CreateMetaCommand;

/**
 * Class CreateMetaHandler
 *
 * @package Scandinaver\Common\Application\Handler\Command
 */
class CreateMetaHandler implements CreateMetaHandlerInterface
{
    public function __construct()
    {
    }

    /**
     * @param  CreateMetaCommand
     *
     * @inheritDoc
     */
    public function handle($command): void
    {
        // TODO: Implement handle() method.
    }
} 