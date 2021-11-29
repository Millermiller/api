<?php


namespace Scandinaver\Common\Application\Handler\Command;

use Scandinaver\Common\UI\Command\DeleteMetaCommand;
use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Core\Domain\Contract\BaseCommandInterface;
use Scandinaver\Core\Domain\Contract\CommandInterface;

/**
 * Class DeleteMetaCommandHandler
 *
 * @package Scandinaver\Common\Application\Handler\Command
 */
class DeleteMetaCommandHandler extends AbstractHandler
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param  DeleteMetaCommand|BaseCommandInterface  $command
     */
    public function handle(CommandInterface $command): void
    {
        // TODO: Implement handle() method.
    }
} 