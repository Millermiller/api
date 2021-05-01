<?php


namespace Scandinaver\Common\Application\Handler\Command;

use Scandinaver\Common\UI\Command\DeleteMetaCommand;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\CommandInterface;

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
     * @param  DeleteMetaCommand|CommandInterface  $command
     */
    public function handle(CommandInterface $command): void
    {
        // TODO: Implement handle() method.
    }
} 