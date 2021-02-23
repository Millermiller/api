<?php


namespace Scandinaver\Common\Application\Handler\Command;

use Scandinaver\Common\Domain\Contract\Command\UpdateMetaHandlerInterface;
use Scandinaver\Common\UI\Command\UpdateMetaCommand;
use Scandinaver\Shared\Contract\Command;

/**
 * Class UpdateMetaHandler
 *
 * @package Scandinaver\Common\Application\Handler\Command
 */
class UpdateMetaHandler implements UpdateMetaHandlerInterface
{
    public function __construct()
    {
    }

    /**
     * @param  UpdateMetaCommand|Command  $command
     */
    public function handle($command): void
    {
        // TODO: Implement handle() method.
    }
} 