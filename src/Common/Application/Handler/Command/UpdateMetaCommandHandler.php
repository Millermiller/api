<?php


namespace Scandinaver\Common\Application\Handler\Command;

use Scandinaver\Common\UI\Command\UpdateMetaCommand;
use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Core\Domain\Contract\CommandInterface;

/**
 * Class UpdateMetaCommandHandler
 *
 * @package Scandinaver\Common\Application\Handler\Command
 */
class UpdateMetaCommandHandler extends AbstractHandler
{
    public function __construct()
    {
        parent::__construct();
    }

    public function handle(CommandInterface|UpdateMetaCommand $command): void
    {
        // TODO: Implement handle() method.
    }
} 