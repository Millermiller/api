<?php


namespace Scandinaver\Common\Application\Handler\Command;

use Scandinaver\Common\Domain\Contract\Command\CreateMetaHandlerInterface;
use Scandinaver\Common\UI\Command\CreateMetaCommand;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\Command;

/**
 * Class CreateMetaHandler
 *
 * @package Scandinaver\Common\Application\Handler\Command
 */
class CreateMetaHandler extends AbstractHandler implements CreateMetaHandlerInterface
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param  CreateMetaCommand|Command  $command
     */
    public function handle($command): void
    {
        // TODO: Implement handle() method.
    }
} 