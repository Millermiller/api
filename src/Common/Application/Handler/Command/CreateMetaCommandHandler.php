<?php


namespace Scandinaver\Common\Application\Handler\Command;

use Scandinaver\Common\UI\Command\CreateMetaCommand;
use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Core\Domain\Contract\CommandInterface;

/**
 * Class CreateMetaCommandHandler
 *
 * @package Scandinaver\Common\Application\Handler\Command
 */
class CreateMetaCommandHandler extends AbstractHandler
{
    public function __construct()
    {
        parent::__construct();
    }

    public function handle(CommandInterface|CreateMetaCommand $command): void
    {
        // TODO: Implement handle() method.
    }
} 