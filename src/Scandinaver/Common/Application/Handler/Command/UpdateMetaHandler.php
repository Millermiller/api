<?php


namespace Scandinaver\Common\Application\Handler\Command;

use Scandinaver\Common\Domain\Contract\Command\UpdateMetaHandlerInterface;
use Scandinaver\Common\UI\Command\UpdateMetaCommand;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\Command;

/**
 * Class UpdateMetaHandler
 *
 * @package Scandinaver\Common\Application\Handler\Command
 */
class UpdateMetaHandler extends AbstractHandler implements UpdateMetaHandlerInterface
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param  UpdateMetaCommand|Command  $command
     */
    public function handle($command): void
    {
        // TODO: Implement handle() method.
    }
} 